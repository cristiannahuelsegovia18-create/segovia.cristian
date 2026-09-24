<?php
$pageTitle = 'Contacto - Compra o Consulta';
require_once 'includes/header.php';
?>

<div class="container">
    <section class="contact-section">
        <h2>🏍️ Contacto - Consultas y Compras</h2>
        <p class="subtitle">¿Preguntas sobre nuestros cascos? ¿Necesitas asesoría? Contáctanos ahora.</p>

        <div id="contact-success" class="alert alert-success" style="display:none;">
            ✅ ¡Mensaje enviado correctamente! Nos pondremos en contacto en las próximas 2 horas.
        </div>

        <div id="contact-error" class="alert alert-error" style="display:none;"></div>

        <div class="contact-container">
            <form class="contact-form" id="contact-form" novalidate>
                <div class="form-group">
                    <label for="name">Nombre Completo</label>
                    <input type="text" id="name" name="name" placeholder="Tu nombre" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="tu@email.com" required>
                </div>

                <div class="form-group">
                    <label for="phone">Teléfono / WhatsApp</label>
                    <input type="tel" id="phone" name="phone" placeholder="+57 300 1234567" required>
                </div>

                <div class="form-group">
                    <label for="subject">Asunto</label>
                    <select id="subject" name="subject" required>
                        <option value="">-- Selecciona un tema --</option>
                        <option value="Consulta sobre un casco">Consulta sobre un casco</option>
                        <option value="Información de compra">Información de compra</option>
                        <option value="Envío y entrega">Envío y entrega</option>
                        <option value="Garantía y cambios">Garantía y cambios</option>
                        <option value="Asesoría especializada">Asesoría especializada</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="message">Mensaje</label>
                    <textarea id="message" name="message" rows="5" placeholder="Cuéntanos cómo podemos ayudarte..." required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
            </form>

            <div class="contact-info">
                <h3>📞 Información de Contacto</h3>
                <div class="info-item">
                    <strong>📧 Email:</strong>
                    <p><a href="mailto:ventas@motohelm.com">ventas@motohelm.com</a></p>
                    <p style="font-size: 0.9rem; color: #666;">Respuesta en menos de 2 horas</p>
                </div>
                <div class="info-item">
                    <strong>☎️ Teléfono:</strong>
                    <p><a href="tel:+573001234567">+57 (300) 123-4567</a></p>
                    <p style="font-size: 0.9rem; color: #666;">Disponible: Lun-Sab 8am-6pm</p>
                </div>
                <div class="info-item">
                    <strong>💬 WhatsApp:</strong>
                    <p><a href="https://wa.me/573001234567" target="_blank">Chat directo</a></p>
                    <p style="font-size: 0.9rem; color: #666;">Asesoría al instante</p>
                </div>
                <div class="info-item">
                    <strong>📍 Dirección:</strong>
                    <p>Carrera 10 #45-50<br>Medellín, Colombia</p>
                </div>
                <div class="contact-methods">
                    <h4>Formas de Compra</h4>
                    <ul>
                        <li>✓ Tienda en línea 24/7</li>
                        <li>✓ Por teléfono</li>
                        <li>✓ Por WhatsApp</li>
                        <li>✓ Visita nuestra tienda física</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
(function () {
    const form = document.getElementById('contact-form');
    const successBox = document.getElementById('contact-success');
    const errorBox = document.getElementById('contact-error');

    if (!form) return;

    const setError = (message) => {
        errorBox.textContent = message;
        errorBox.style.display = 'block';
        successBox.style.display = 'none';
    };

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const name = form.querySelector('#name').value.trim();
        const email = form.querySelector('#email').value.trim();
        const phone = form.querySelector('#phone').value.trim();
        const subject = form.querySelector('#subject').value.trim();
        const message = form.querySelector('#message').value.trim();

        if (!name || !email || !phone || !subject || !message) {
            setError('Por favor completa todos los campos.');
            return;
        }

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            setError('El email no es válido.');
            return;
        }

        errorBox.style.display = 'none';
        successBox.style.display = 'block';
        form.reset();
    });
})();
</script>

<?php require_once 'includes/footer.php'; ?>
