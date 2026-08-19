    </main>

    <!-- Pie de página -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3><?php echo SITE_NAME; ?></h3>
                    <p>Sitio web profesional desarrollado con HTML5 y PHP.</p>
                </div>
                <div class="footer-section">
                    <h4>Enlaces rápidos</h4>
                    <ul>
                        <li><a href="<?php echo getUrl(); ?>">Inicio</a></li>
                        <li><a href="<?php echo getUrl('about.php'); ?>">Acerca de</a></li>
                        <li><a href="<?php echo getUrl('contact.php'); ?>">Contacto</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Redes sociales</h4>
                    <ul>
                        <li><a href="#" target="_blank">Facebook</a></li>
                        <li><a href="#" target="_blank">Twitter</a></li>
                        <li><a href="#" target="_blank">LinkedIn</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. Todos los derechos reservados.</p>
                <p>Versión <?php echo SITE_VERSION; ?></p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="<?php echo getUrl('js/main.js'); ?>"></script>
</body>
</html>
