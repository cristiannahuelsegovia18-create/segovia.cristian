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
    <meta name="description" content="Sitio web profesional con HTML5 y PHP">
    <meta name="author" content="Tu Nombre">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' | ' . SITE_NAME : SITE_NAME; ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo getUrl('images/favicon.ico'); ?>">
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo getUrl('css/styles.css'); ?>">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Encabezado -->
    <header class="header">
        <nav class="navbar">
            <div class="container">
                <div class="logo">
                    <h1><a href="<?php echo getUrl(); ?>"><?php echo SITE_NAME; ?></a></h1>
                </div>
                <ul class="nav-menu">
                    <li><a href="<?php echo getUrl(); ?>" class="nav-link">Inicio</a></li>
                    <li><a href="<?php echo getUrl('products.php'); ?>" class="nav-link">Catálogo</a></li>
                    <li><a href="<?php echo getUrl('services.php'); ?>" class="nav-link">Servicios</a></li>
                    <li><a href="<?php echo getUrl('about.php'); ?>" class="nav-link">Acerca de</a></li>
                    <li><a href="<?php echo getUrl('contact.php'); ?>" class="nav-link">Contacto</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Contenido principal -->
    <main class="main-content">
