<?php
$id = isset($_GET['id']) ? trim($_GET['id']) : '';
require_once 'includes/config.php';
$productsFile = __DIR__ . '/products.json';
$product = null;
if (file_exists($productsFile)) {
    $data = json_decode(file_get_contents($productsFile), true);
    foreach (($data['products'] ?? []) as $p) {
        if ($p['id'] === $id) { $product = $p; break; }
    }
}
$pageTitle = $product ? $product['name'] : 'Producto';
require_once 'includes/header.php';
?>

<div class="container">
    <?php if ($product): ?>
        <div class="product-detail">
            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
            <img src="<?php echo htmlspecialchars($product['img']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="max-width:400px; display:block;">
            <p class="price">$<?php echo number_format($product['price'],2); ?></p>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
            <button id="add-product" class="btn btn-secondary">Agregar al carrito</button>
            <a class="btn btn-primary" href="<?php echo getUrl('tienda.php'); ?>">Volver al catálogo</a>
        </div>
        <script>
            document.getElementById('add-product').addEventListener('click', function(){
                const p = { id: <?php echo json_encode($product['id']); ?>, name: <?php echo json_encode($product['name']); ?>, price: <?php echo json_encode($product['price']); ?>, qty: 1 };
                const cart = JSON.parse(localStorage.getItem('mh_cart') || '[]');
                const existing = cart.find(x=>x.id===p.id);
                if(existing) existing.qty += 1; else cart.push(p);
                localStorage.setItem('mh_cart', JSON.stringify(cart));
                alert('Producto agregado al carrito');
            });
        </script>
    <?php else: ?>
        <p>Producto no encontrado.</p>
        <a class="btn btn-primary" href="<?php echo getUrl('tienda.php'); ?>">Volver</a>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>
