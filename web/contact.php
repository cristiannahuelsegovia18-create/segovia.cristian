<?php
$pageTitle = 'Contacto - Compra o Consulta';
require_once 'includes/header.php';

// Procesar formulario
$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener y limpiar datos
    $name = sanitizeInput($_POST['name'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $phone = sanitizeInput($_POST['phone'] ?? '');
    $subject = sanitizeInput($_POST['subject'] ?? '');
    $message = sanitizeInput($_POST['message'] ?? '');

    // Validar datos
    if (empty($name) || empty($email) || empty($phone) || empty($subject) || empty($message)) {
        $error = 'Por favor completa todos los campos.';
    } elseif (!isValidEmail($email)) {
        $error = 'El email no es válido.';
    } else {
        // Aquí normalmente enviarías el email
        // mail($to, $subject, $message, $headers);
        
        // Por ahora, simulamos el envío
        $success = true;
        
        // Limpiar campos
        $name = $email = $phone = $subject = $message = '';
    }
}
?>

<div class="container">
    <section class="contact-section">
        <h2>🏍️ Contacto - Consultas y Compras</h2>
        <p class="subtitle">¿Preguntas sobre nuestros cascos? ¿Necesitas asesoría? Contáctanos ahora.</p>

        <?php if ($success): ?>
            <div class="alert alert-success">
                ✅ ¡Mensaje enviado correctamente! Nos pondremos en contacto en las próximas 2 horas.
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-error">
                ❌ Error: <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <div class="contact-container">
            <!-- Formulario de contacto -->
            <form class="contact-form" method="POST" action="">
                <div class="form-group">
                    <label for="name">Nombre Completo</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="<?php echo $name ?? ''; ?>" 
                        placeholder="Tu nombre"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="<?php echo $email ?? ''; ?>" 
                        placeholder="tu@email.com"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="phone">Teléfono / WhatsApp</label>
                    <input 
                        type="tel" 
                        id="phone" 
                        name="phone" 
                        value="<?php echo $phone ?? ''; ?>" 
                        placeholder="+57 300 1234567"
                        required
                    >
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
                    <textarea 
                        id="message" 
                        name="message" 
                        rows="5" 
                        placeholder="Cuéntanos cómo podemos ayudarte..."
                        required
                    ><?php echo $message ?? ''; ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
            </form>

            <!-- Información de contacto -->
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

<?php require_once 'includes/footer.php'; ?>
