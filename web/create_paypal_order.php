<?php
require_once 'includes/config.php';
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$cart = $input['cart'] ?? [];
$buyer = $input['buyer'] ?? [];

// Load products to validate SKUs/prices
$productsFile = __DIR__ . '/products.json';
$productsIndex = [];
if (file_exists($productsFile)) {
    $pdata = json_decode(file_get_contents($productsFile), true);
    foreach (($pdata['products'] ?? []) as $p) $productsIndex[$p['id']] = $p;
}

// validate cart items and compute total
$total = 0.0;
$itemsForPayPal = [];
foreach ($cart as $it) {
    $sku = $it['id'] ?? '';
    $qty = isset($it['qty']) ? intval($it['qty']) : 0;
    $price = isset($it['price']) ? floatval($it['price']) : 0.0;
    if (!$sku || $qty <= 0) { echo json_encode(['error'=>'Invalid cart item']); exit; }
    if (!isset($productsIndex[$sku])) { echo json_encode(['error'=>'Unknown product SKU: ' . $sku]); exit; }
    $prod = $productsIndex[$sku];
    // price must match product price
    if (abs(floatval($prod['price']) - $price) > 0.01) { echo json_encode(['error'=>'Price mismatch for SKU: ' . $sku]); exit; }
    $total += $price * $qty;
    $itemsForPayPal[] = [
        'name' => $prod['name'],
        'unit_amount' => [ 'currency_code' => ($prod['currency'] ?? 'ARS'), 'value' => number_format($price,0,'.','') ],
        'quantity' => (string)$qty,
        'sku' => $sku
    ];
}

$client = PAYPAL_CLIENT_ID;
$secret = PAYPAL_SECRET;
if (!$client || !$secret) {
    echo json_encode(['error' => 'PayPal credentials not configured']);
    exit;
}

// Determine PayPal base URL (sandbox or live)
$paypalBase = (defined('PAYPAL_MODE') && PAYPAL_MODE === 'live') ? 'https://api-m.paypal.com' : 'https://api-m.sandbox.paypal.com';

// Get access token
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $paypalBase . '/v1/oauth2/token');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $client . ':' . $secret);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json', 'Accept-Language: en_US']);
$resp = curl_exec($ch);
if (curl_errno($ch)) { echo json_encode(['error' => curl_error($ch)]); exit; }
$data = json_decode($resp, true);
curl_close($ch);
if (empty($data['access_token'])) { echo json_encode(['error' => 'Failed to obtain access token']); exit; }
$token = $data['access_token'];

// Create order
$currency = 'ARS';
if (!empty($itemsForPayPal[0]['unit_amount']['currency_code'])) $currency = $itemsForPayPal[0]['unit_amount']['currency_code'];
$orderPayload = [
    'intent' => 'CAPTURE',
    'purchase_units' => [[
        'amount' => [ 'currency_code' => $currency, 'value' => number_format($total,0,'.','') ],
        'items' => $itemsForPayPal
    ]]
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $paypalBase . '/v2/checkout/orders');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderPayload));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $token
]);
$resp = curl_exec($ch);
if (curl_errno($ch)) { echo json_encode(['error' => curl_error($ch)]); exit; }
$created = json_decode($resp, true);
curl_close($ch);

if (isset($created['id'])) {
    echo json_encode(['id' => $created['id']]);
} else {
    echo json_encode(['error' => $created]);
}
