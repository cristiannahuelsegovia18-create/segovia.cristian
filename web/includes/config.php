<?php
/**
 * Configuración global de la aplicación web
 */

// Definir constantes
define('SITE_URL', 'http://localhost:8000');
define('SITE_NAME', 'MotoHelm - Cascos para Motocicleta');
define('SITE_VERSION', '1.0.0');
define('CHARSET', 'UTF-8');
define('STORE_SLOGAN', 'Protege tu vida, elige MotoHelm');

// Configurar zona horaria
date_default_timezone_set('America/Bogota');

// Modo debug
define('DEBUG', true);

// Integración de pagos (configurar con variables de entorno)
define('STRIPE_SECRET', getenv('STRIPE_SECRET') ?: '');
define('STRIPE_PUBLISHABLE', getenv('STRIPE_PUBLISHABLE') ?: '');
define('PAYPAL_CLIENT_ID', getenv('PAYPAL_CLIENT_ID') ?: '');
define('PAYPAL_SECRET', getenv('PAYPAL_SECRET') ?: '');

// PayPal mode: 'sandbox' or 'live'
define('PAYPAL_MODE', getenv('PAYPAL_MODE') ?: 'sandbox');
define('PAYPAL_WEBHOOK_ID', getenv('PAYPAL_WEBHOOK_ID') ?: '');

// Administrador
define('ADMIN_PASSWORD', getenv('ADMIN_PASSWORD') ?: 'admin123');

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Función para mostrar mensajes de error
function showError($message) {
    if (DEBUG) {
        echo "<!-- Error: " . htmlspecialchars($message) . " -->";
    }
}

// Función para obtener URL
function getUrl($path = '') {
    return SITE_URL . '/' . ltrim($path, '/');
}

// Función de seguridad: limpiar entrada
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, CHARSET);
}

// Función para validar email
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Configurar headers de seguridad
header('X-UA-Compatible: ie=edge');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('Content-Type: text/html; charset=' . CHARSET);
