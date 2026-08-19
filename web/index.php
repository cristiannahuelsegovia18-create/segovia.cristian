<?php
$pageTitle = 'Inicio';
require_once 'includes/header.php';
?>

<div class="container">
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h2>🏍️ MotoHelm - Cascos de Calidad</h2>
            <p><?php echo STORE_SLOGAN; ?></p>
            <a href="<?php echo getUrl('tienda.php'); ?>" class="btn btn-primary">Ir a la Tienda</a>
        </div>
    </section>

    <!-- Sección de productos destacados -->
    <section class="featured-products">
        <h2>🏆 Nuestros Cascos Destacados</h2>
        <div class="products-grid">
            <div class="product-card">
                <div class="product-image">🎯</div>
                <h3>MotoHelm Pro Racing</h3>
                <p class="price">$299.99</p>
                <p>Casco integral de máxima protección. Perfecto para carreras y alta velocidad.</p>
                <ul class="features-list">
                    <li>✓ Certificado ECE 22.05</li>
                    <li>✓ Peso: 1.4 kg</li>
                    <li>✓ 5 colores disponibles</li>
                </ul>
                <button class="btn btn-secondary">Agregar al carrito</button>
            </div>
            
            <div class="product-card">
                <div class="product-image">🛵</div>
                <h3>MotoHelm Urban</h3>
                <p class="price">$149.99</p>
                <p>Casco modular ideal para uso urbano y viajes ocasionales.</p>
                <ul class="features-list">
                    <li>✓ Visera abatible</li>
                    <li>✓ Ventilación óptima</li>
                    <li>✓ Forro removible</li>
                </ul>
                <button class="btn btn-secondary">Agregar al carrito</button>
            </div>
            
            <div class="product-card">
                <div class="product-image">🏁</div>
                <h3>MotoHelm Off-Road</h3>
                <p class="price">$189.99</p>
                <p>Casco de motocross con máxima ventilación y protección facial.</p>
                <ul class="features-list">
                    <li>✓ Diseño deportivo</li>
                    <li>✓ Visera anti-impacto</li>
                    <li>✓ Peso ligero</li>
                </ul>
                <button class="btn btn-secondary">Agregar al carrito</button>
            </div>
        </div>
    </section>

    <!-- Sección de garantía -->
    <section class="guarantees">
        <h2>✨ ¿Por qué elegir MotoHelm?</h2>
        <div class="guarantees-grid">
            <div class="guarantee-card">
                <h3>🛡️ Seguridad Certificada</h3>
                <p>Todos nuestros cascos cumplen con normas internacionales ECE y DOT.</p>
            </div>
            <div class="guarantee-card">
                <h3>🚚 Envío Gratis</h3>
                <p>Envío gratuito en compras mayores a $150 en todo el país.</p>
            </div>
            <div class="guarantee-card">
                <h3>💳 Garantía 2 Años</h3>
                <p>Garantía de fabricación por 2 años contra defectos de fábrica.</p>
            </div>
            <div class="guarantee-card">
                <h3>📞 Soporte Especializado</h3>
                <p>Equipo experto disponible para ayudarte a elegir tu casco ideal.</p>
            </div>
        </div>
    </section>
</div>

<?php require_once 'includes/footer.php'; ?>

