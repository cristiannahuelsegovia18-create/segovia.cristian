<?php
require_once 'includes/config.php';

$raw = isset($_POST['cart']) ? $_POST['cart'] : null;
$buyer_name = isset($_POST['buyer_name']) ? sanitizeInput($_POST['buyer_name']) : '';
$buyer_email = isset($_POST['buyer_email']) ? sanitizeInput($_POST['buyer_email']) : '';
$buyer_phone = isset($_POST['buyer_phone']) ? sanitizeInput($_POST['buyer_phone']) : '';
$payment_method = isset($_POST['payment_method']) ? sanitizeInput($_POST['payment_method']) : 'mail';
$order = null;
if ($raw) {
    $items = json_decode($raw, true);
    if (!is_array($items)) {
        showError('Formato de carrito inválido');
        $items = [];
    }
    $total = array_reduce($items, function($s,$i){ return $s + ($i['price']*$i['qty']); }, 0);
    $order = [
        'id' => 'ORD-' . time(),
        'date' => date('c'),
        'buyer' => ['name'=>$buyer_name, 'email'=>$buyer_email, 'phone'=>$buyer_phone],
        'items' => $items,
        'total' => $total,
        'status' => 'pending',
        'payment_method' => $payment_method
    ];

    $ordersFile = __DIR__ . '/orders.json';
    if (!file_exists($ordersFile)) {
        file_put_contents($ordersFile, json_encode(['orders'=>[]], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
    $data = json_decode(file_get_contents($ordersFile), true);
    if (!isset($data['orders']) || !is_array($data['orders'])) $data['orders'] = [];
    $data['orders'][] = $order;
    file_put_contents($ordersFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);

    // Here you could trigger payment creation for Stripe/PayPal using API keys from config.
}

$pageTitle = 'Confirmación de pedido';
require_once 'includes/header.php';
?>

<div class="container">
    <?php if ($order): ?>
        <section class="order-confirm">
            <h2>Gracias por tu pedido</h2>
            <p>Pedido: <strong><?php echo htmlspecialchars($order['id']); ?></strong></p>
            <p>Fecha: <?php echo htmlspecialchars($order['date']); ?></p>
            <h3>Resumen</h3>
            <ul>
                <?php foreach($order['items'] as $it): ?>
                    <li><?php echo htmlspecialchars($it['qty'] . ' x ' . $it['name'] . ' — $' . number_format($it['price']*$it['qty'],2)); ?></li>
                <?php endforeach; ?>
            </ul>
            <p>Total: <strong>$<?php echo number_format($order['total'],2); ?></strong></p>
            <p>Hemos registrado tu pedido. Nos pondremos en contacto para coordinar pago y envío.</p>
            <a class="btn btn-primary" href="<?php echo getUrl('tienda.php'); ?>">Volver a la tienda</a>
        </section>
    <?php else: ?>
        <section class="order-empty">
            <h2>No se recibió ningún pedido</h2>
            <a class="btn btn-primary" href="<?php echo getUrl('tienda.php'); ?>">Ir a la tienda</a>
        </section>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>
