<?php
require_once 'includes/config.php';
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$orderID = $input['orderID'] ?? '';
$cart = $input['cart'] ?? [];
$buyer = $input['buyer'] ?? [];

if (!$orderID) { echo json_encode(['success'=>false,'error'=>'orderID required']); exit; }

$client = PAYPAL_CLIENT_ID;
$secret = PAYPAL_SECRET;
if (!$client || !$secret) { echo json_encode(['success'=>false,'error'=>'PayPal credentials not configured']); exit; }

// Determine PayPal base URL
$paypalBase = (defined('PAYPAL_MODE') && PAYPAL_MODE === 'live') ? 'https://api-m.paypal.com' : 'https://api-m.sandbox.paypal.com';

// get access token
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $paypalBase . '/v1/oauth2/token');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $client . ':' . $secret);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json', 'Accept-Language: en_US']);
$resp = curl_exec($ch);
if (curl_errno($ch)) { echo json_encode(['success'=>false,'error'=>curl_error($ch)]); exit; }
$data = json_decode($resp, true);
curl_close($ch);
if (empty($data['access_token'])) { echo json_encode(['success'=>false,'error'=>'Failed to obtain access token']); exit; }
$token = $data['access_token'];

// capture
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $paypalBase . '/v2/checkout/orders/' . urlencode($orderID) . '/capture');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $token
]);
$resp = curl_exec($ch);
if (curl_errno($ch)) { echo json_encode(['success'=>false,'error'=>curl_error($ch)]); exit; }
$capture = json_decode($resp, true);
curl_close($ch);

// Verify order details by retrieving the order from PayPal
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $paypalBase . '/v2/checkout/orders/' . urlencode($orderID));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [ 'Content-Type: application/json', 'Authorization: Bearer ' . $token ]);
$resp = curl_exec($ch);
if (curl_errno($ch)) { echo json_encode(['success'=>false,'error'=>curl_error($ch)]); exit; }
$orderDetails = json_decode($resp, true);
curl_close($ch);

// compute local total
$localTotal = array_reduce($cart, function($s,$i){ return $s + ($i['price']*$i['qty']); }, 0);

// basic validations
$ppStatus = strtolower($capture['status'] ?? '');
$ppAmount = null;
if (!empty($orderDetails['purchase_units'][0]['amount']['value'])) {
    $ppAmount = floatval($orderDetails['purchase_units'][0]['amount']['value']);
}

if ($ppStatus !== 'completed' && $ppStatus !== 'succeeded' && $ppStatus !== 'approved') {
    echo json_encode(['success'=>false,'error'=>'Payment not completed','capture'=>$capture,'orderDetails'=>$orderDetails]);
    exit;
}
if ($ppAmount === null) {
    echo json_encode(['success'=>false,'error'=>'Unable to read PayPal order amount','orderDetails'=>$orderDetails]);
    exit;
}
// Validate amounts (allow minor rounding differences)
if (abs($ppAmount - $localTotal) > 0.01) {
    echo json_encode(['success'=>false,'error'=>'Amount mismatch','paypal_amount'=>$ppAmount,'local_total'=>$localTotal]);
    exit;
}

// All good: persist order
$order = [
    'id' => 'ORD-' . time(),
    'date' => date('c'),
    'buyer' => ['name'=>sanitizeInput($buyer['name'] ?? ''), 'email'=>sanitizeInput($buyer['email'] ?? ''), 'phone'=>sanitizeInput($buyer['phone'] ?? '')],
    'items' => $cart,
    'total' => $localTotal,
    'status' => 'completed',
    'payment' => ['provider'=>'paypal','orderID'=>$orderID,'capture'=>$capture,'orderDetails'=>$orderDetails]
];
$ordersFile = __DIR__ . '/orders.json';
if (!file_exists($ordersFile)) file_put_contents($ordersFile, json_encode(['orders'=>[]], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
$data = json_decode(file_get_contents($ordersFile), true);
$data['orders'][] = $order;
file_put_contents($ordersFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
echo json_encode(['success'=>true,'order_id'=>$order['id']]);
