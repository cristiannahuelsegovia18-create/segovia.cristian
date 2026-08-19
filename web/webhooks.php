<?php
require_once 'includes/config.php';
// PayPal webhook receiver and verifier
// Expects PayPal headers for verification
header('Content-Type: application/json');
$body = file_get_contents('php://input');
$event = json_decode($body, true);

$client = PAYPAL_CLIENT_ID; $secret = PAYPAL_SECRET; $webhookId = PAYPAL_WEBHOOK_ID;
if (!$client || !$secret || !$webhookId) { http_response_code(500); echo json_encode(['error'=>'PayPal webhook not configured']); exit; }

// gather PayPal headers
$transmission_id = $_SERVER['HTTP_PAYPAL_TRANSMISSION_ID'] ?? ($_SERVER['HTTP_PAYPAL_TRANSMISSION_ID'] ?? '');
$transmission_time = $_SERVER['HTTP_PAYPAL_TRANSMISSION_TIME'] ?? '';
$cert_url = $_SERVER['HTTP_PAYPAL_CERT_URL'] ?? '';
$auth_algo = $_SERVER['HTTP_PAYPAL_AUTH_ALGO'] ?? '';
$transmission_sig = $_SERVER['HTTP_PAYPAL_TRANSMISSION_SIG'] ?? '';

// get access token
$paypalBase = (defined('PAYPAL_MODE') && PAYPAL_MODE === 'live') ? 'https://api-m.paypal.com' : 'https://api-m.sandbox.paypal.com';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $paypalBase . '/v1/oauth2/token');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $client . ':' . $secret);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
$resp = curl_exec($ch);
if (curl_errno($ch)) { http_response_code(500); echo json_encode(['error'=>curl_error($ch)]); exit; }
$tok = json_decode($resp, true);
curl_close($ch);
$access = $tok['access_token'] ?? null;
if (!$access) { http_response_code(500); echo json_encode(['error'=>'Unable to obtain access token']); exit; }

// verify signature
$verifyPayload = [
    'auth_algo' => $auth_algo,
    'cert_url' => $cert_url,
    'transmission_id' => $transmission_id,
    'transmission_sig' => $transmission_sig,
    'transmission_time' => $transmission_time,
    'webhook_id' => $webhookId,
    'webhook_event' => json_decode($body, true)
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $paypalBase . '/v1/notifications/verify-webhook-signature');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($verifyPayload));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: Bearer ' . $access]);
$resp = curl_exec($ch);
if (curl_errno($ch)) { http_response_code(500); echo json_encode(['error'=>curl_error($ch)]); exit; }
$verify = json_decode($resp, true);
curl_close($ch);

if (($verify['verification_status'] ?? '') !== 'SUCCESS') { http_response_code(400); echo json_encode(['error'=>'Webhook verification failed','detail'=>$verify]); exit; }

// process event
$eventType = $event['event_type'] ?? '';
// load orders
$ordersFile = __DIR__ . '/orders.json';
$ordersData = [];
if (file_exists($ordersFile)) $ordersData = json_decode(file_get_contents($ordersFile), true);
$orders = $ordersData['orders'] ?? [];

if ($eventType === 'PAYMENT.CAPTURE.COMPLETED' || $eventType === 'CHECKOUT.ORDER.APPROVED') {
    // find matching PayPal order id
    $resource = $event['resource'] ?? [];
    $paypalOrderId = $resource['supplementary_data']['related_ids']['order_id'] ?? ($resource['id'] ?? null);
    if ($paypalOrderId) {
        foreach ($orders as $i => $o) {
            if (!empty($o['payment']['orderID']) && $o['payment']['orderID'] === $paypalOrderId) {
                $orders[$i]['status'] = 'completed';
                $ordersData['orders'] = $orders;
                file_put_contents($ordersFile, json_encode($ordersData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
                http_response_code(200);
                echo json_encode(['success'=>true]);
                exit;
            }
        }
    }
}

// not processed
http_response_code(200);
echo json_encode(['received'=>true]);
