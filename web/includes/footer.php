    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <div class="footer-brand">
                    <a href="<?php echo getUrl(); ?>" class="logo logo-footer">
                        <span class="logo-mark">MH</span>
                        <span class="logo-text">MotoHelm</span>
                    </a>
                    <p>Casco de moto premium para cada ruta, estilo y necesidad.</p>
                </div>

                <div class="footer-section">
                    <h4>Explorar</h4>
                    <ul>
                        <li><a href="<?php echo getUrl(); ?>">Inicio</a></li>
                        <li><a href="<?php echo getUrl('products.php'); ?>">Catálogo</a></li>
                        <li><a href="<?php echo getUrl('services.php'); ?>">Servicios</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Compañía</h4>
                    <ul>
                        <li><a href="<?php echo getUrl('about.php'); ?>">Acerca de</a></li>
                        <li><a href="<?php echo getUrl('contact.php'); ?>">Contacto</a></li>
                        <li><a href="<?php echo getUrl('tienda.php'); ?>">Tienda</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Síguenos</h4>
                    <ul>
                        <li><a href="#" target="_blank">Instagram</a></li>
                        <li><a href="#" target="_blank">Facebook</a></li>
                        <li><a href="#" target="_blank">YouTube</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. Todos los derechos reservados.</p>
                <p>Versión <?php echo SITE_VERSION; ?></p>
            </div>
        </div>
    </footer>

    <script src="<?php echo getUrl('js/main.js'); ?>"></script>
</body>
</html>
