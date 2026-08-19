<?php
$pageTitle = 'Tienda - Cascos importados de Paraguay';
require_once 'includes/header.php';
?>

<link rel="stylesheet" href="<?php echo getUrl('css/shop.css'); ?>">

<div class="container shop-container">
    <section class="shop-hero">
        <h2>Cascos importados desde Paraguay</h2>
        <p>Selección exclusiva de cascos importados. Calidad y seguridad certificada.</p>
        <a href="#catalog" class="btn btn-primary">Ver Productos</a>
    </section>

    <section id="catalog" class="catalog">
        <div id="products" class="products-grid"></div>
    </section>

    <aside class="cart" id="cart">
        <h3>Carrito</h3>
        <div id="cart-items">No hay productos en el carrito.</div>
        <p>Total: <strong id="cart-total">$0.00</strong></p>
        <button id="checkout-btn" class="btn btn-primary">Finalizar compra</button>
    </aside>
</div>

<script>const PRODUCTS_URL = "<?php echo getUrl('products.json'); ?>"; const CHECKOUT_URL = "<?php echo getUrl('checkout.php'); ?>";</script>
<script src="<?php echo getUrl('js/shop.js'); ?>"></script>

<?php require_once 'includes/footer.php'; ?>
