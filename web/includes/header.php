<?php
/**
 * Encabezado HTML5 y navegación
 */
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="<?php echo CHARSET; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MotoHelm - Cascos para motocicleta premium.">
    <meta name="author" content="MotoHelm">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' | ' . SITE_NAME : SITE_NAME; ?></title>

    <link rel="icon" type="image/x-icon" href="<?php echo getUrl('images/favicon.ico'); ?>">
    <link rel="stylesheet" href="<?php echo getUrl('css/styles.css'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <div class="container nav-shell">
                <a href="<?php echo getUrl(); ?>" class="logo" aria-label="MotoHelm inicio">
                    <span class="logo-mark">MH</span>
                    <span class="logo-text">MotoHelm</span>
                </a>

                <ul class="nav-menu">
                    <li><a href="<?php echo getUrl(); ?>" class="nav-link active">Inicio</a></li>
                    <li><a href="<?php echo getUrl('products.php'); ?>" class="nav-link">Catálogo</a></li>
                    <li><a href="<?php echo getUrl('services.php'); ?>" class="nav-link">Servicios</a></li>
                    <li><a href="<?php echo getUrl('about.php'); ?>" class="nav-link">Acerca de</a></li>
                    <li><a href="<?php echo getUrl('contact.php'); ?>" class="nav-link">Contacto</a></li>
                </ul>

                <a href="<?php echo getUrl('tienda.php'); ?>" class="nav-cta">Comprar ahora</a>
            </div>
        </nav>
    </header>

    <main class="main-content">
