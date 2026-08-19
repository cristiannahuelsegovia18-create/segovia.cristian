<?php
$pageTitle = 'Catálogo de Cascos';
require_once 'includes/header.php';

// Datos de productos
$products = [
    [
        'id' => 1,
        'name' => 'MotoHelm Pro Racing',
        'price' => 299.99,
        'emoji' => '🏎️',
        'type' => 'Integral',
        'description' => 'Casco de máxima protección para carreras y alta velocidad',
        'features' => ['ECE 22.05 Certificado', 'Peso: 1.4 kg', '5 colores', 'Visor anti-vaho', 'Forro removible'],
        'colors' => ['Negro', 'Rojo', 'Azul', 'Verde', 'Plateado']
    ],
    [
        'id' => 2,
        'name' => 'MotoHelm Urban',
        'price' => 149.99,
        'emoji' => '🏙️',
        'type' => 'Modular',
        'description' => 'Casco modular ideal para uso urbano y viajes',
        'features' => ['Visera abatible', 'Ventilación óptima', 'Forro removible', 'Ligero', 'Cómodo'],
        'colors' => ['Negro', 'Gris', 'Blanco']
    ],
    [
        'id' => 3,
        'name' => 'MotoHelm Off-Road',
        'price' => 189.99,
        'emoji' => '🏁',
        'type' => 'Motocross',
        'description' => 'Casco de motocross con máxima ventilación',
        'features' => ['Diseño deportivo', 'Visera anti-impacto', 'Peso ligero', 'Ventilación superior', 'Protección facial'],
        'colors' => ['Naranja', 'Amarillo', 'Verde']
    ],
    [
        'id' => 4,
        'name' => 'MotoHelm Classic',
        'price' => 179.99,
        'emoji' => '🎩',
        'type' => 'Jet',
        'description' => 'Casco estilo abierto clásico para scooters',
        'features' => ['Estilo vintage', 'Visera incluida', 'Peso ultraligero', 'Cómodo', 'ECE certificado'],
        'colors' => ['Marrón', 'Negro', 'Crema']
    ],
    [
        'id' => 5,
        'name' => 'MotoHelm Cruiser',
        'price' => 219.99,
        'emoji' => '🏍️',
        'type' => 'Abierto',
        'description' => 'Casco abierto para cruisers y touring',
        'features' => ['Máxima visibilidad', 'Buen flujo de aire', 'Cómodo para viajes largos', 'Protección lateral', 'Ruido reducido'],
        'colors' => ['Negro', 'Rojo', 'Plata']
    ],
    [
        'id' => 6,
        'name' => 'MotoHelm Adventure',
        'price' => 259.99,
        'emoji' => '🧗',
        'type' => 'Modular Adventure',
        'description' => 'Casco para motos adventure con máxima versatilidad',
        'features' => ['Visera grande', 'Muy ventilado', 'Forro térmica', 'Peso equilibrado', 'DOT/ECE'],
        'colors' => ['Rojo', 'Negro', 'Blanco', 'Gris']
    ]
];
?>

<div class="container">
    <section class="products-section">
        <h2>🏍️ Catálogo de Cascos MotoHelm</h2>
        <p class="subtitle">Elige el casco perfecto para ti. Todos nuestros productos están certificados internacionalmente.</p>
        
        <div class="catalog-filters">
            <button class="filter-btn active" onclick="filterProducts('all')">Todos</button>
            <button class="filter-btn" onclick="filterProducts('Integral')">Integral</button>
            <button class="filter-btn" onclick="filterProducts('Modular')">Modular</button>
            <button class="filter-btn" onclick="filterProducts('Motocross')">Motocross</button>
            <button class="filter-btn" onclick="filterProducts('Jet')">Jet</button>
        </div>

        <div class="products-display">
            <?php foreach ($products as $product): ?>
                <div class="product-item" data-type="<?php echo $product['type']; ?>">
                    <div class="product-header">
                        <span class="product-emoji"><?php echo $product['emoji']; ?></span>
                        <span class="product-type"><?php echo $product['type']; ?></span>
                    </div>
                    
                    <h3><?php echo $product['name']; ?></h3>
                    
                    <p class="product-description"><?php echo $product['description']; ?></p>
                    
                    <div class="product-features">
                        <strong>Características:</strong>
                        <ul>
                            <?php foreach ($product['features'] as $feature): ?>
                                <li>✓ <?php echo $feature; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="product-colors">
                        <strong>Colores:</strong>
                        <div class="colors-list">
                            <?php foreach ($product['colors'] as $color): ?>
                                <span class="color-option"><?php echo $color; ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="product-footer">
                        <div class="price">
                            <span class="currency">$</span>
                            <span class="amount"><?php echo number_format($product['price'], 2); ?></span>
                        </div>
                        <button class="btn btn-secondary" onclick="addToCart(<?php echo $product['id']; ?>, '<?php echo addslashes($product['name']); ?>')">
                            🛒 Agregar al carrito
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Sección de garantía -->
    <section class="guarantee-info">
        <h2>✨ Por qué Comprar en MotoHelm</h2>
        <div class="guarantee-items">
            <div class="guarantee-item">
                <h4>🛡️ Garantía 2 Años</h4>
                <p>Cobertura completa contra defectos de fabricación</p>
            </div>
            <div class="guarantee-item">
                <h4>🚚 Envío Gratis</h4>
                <p>En compras mayores a $150 en todo el país</p>
            </div>
            <div class="guarantee-item">
                <h4>🔄 Cambio 30 Días</h4>
                <p>No estás satisfecho? Te lo cambiamos sin preguntas</p>
            </div>
            <div class="guarantee-item">
                <h4>📞 Soporte Experto</h4>
                <p>Equipo especializado disponible para ayudarte</p>
            </div>
        </div>
    </section>
</div>

<script>
function filterProducts(type) {
    const products = document.querySelectorAll('.product-item');
    const buttons = document.querySelectorAll('.filter-btn');
    
    // Actualizar botones activos
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
    
    // Filtrar productos
    products.forEach(product => {
        if (type === 'all' || product.dataset.type === type) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });
}

function addToCart(id, name) {
    alert('✅ ' + name + ' agregado al carrito!\n\nTotal: 1 artículo\n\nProc ede al checkout para completar tu compra.');
}
</script>

<?php require_once 'includes/footer.php'; ?>
