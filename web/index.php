<?php
$pageTitle = 'Inicio';
require_once 'includes/header.php';
?>

<div class="container">
    <section class="hero">
        <div class="hero-inner">
            <div class="hero-content">
                <span class="kicker">Protección premium</span>
                <h2>Rumbo seguro. Estilo extremo.</h2>
                <p><?php echo STORE_SLOGAN; ?></p>

                <div class="hero-actions">
                    <a href="<?php echo getUrl('tienda.php'); ?>" class="btn btn-primary">Ir a la Tienda</a>
                    <a href="<?php echo getUrl('products.php'); ?>" class="btn btn-secondary">Ver catálogo</a>
                </div>

                <div class="hero-stats">
                    <div class="stat-item">
                        <strong>15k+</strong>
                        <span>clientes satisfechos</span>
                    </div>
                    <div class="stat-item">
                        <strong>2 años</strong>
                        <span>garantía</span>
                    </div>
                    <div class="stat-item">
                        <strong>ECE</strong>
                        <span>certificado</span>
                    </div>
                </div>
            </div>

            <div class="hero-visual" aria-label="Casco premium MotoHelm">
                <div class="helmet-card">
                    <div class="helmet-badge">Nuevo</div>
                    <div class="helmet-icon">🏍️</div>
                    <h3>MotoHelm Pro Race</h3>
                    <p>Protección, aerodinámica y diseño profesional.</p>
                    <div class="helmet-price">$299.99</div>
                </div>
            </div>
        </div>
    </section>

    <section class="featured-products">
        <div class="section-heading">
            <span class="eyebrow">Lo más vendido</span>
            <h2>Casco premium para cada estilo</h2>
        </div>

        <div class="products-grid">
            <article class="product-card">
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
            </article>

            <article class="product-card">
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
            </article>

            <article class="product-card">
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
            </article>
        </div>
    </section>

    <section class="guarantees">
        <div class="section-heading">
            <span class="eyebrow">Nuestra diferencia</span>
            <h2>¿Por qué elegir MotoHelm?</h2>
        </div>

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

