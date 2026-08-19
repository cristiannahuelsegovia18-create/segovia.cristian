<?php
$require_once __DIR__ . '/../includes/config.php';
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['admin_user'])) { header('Location: login.php'); exit; }
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $targetDir = __DIR__ . '/../images/';
    if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);
    $file = $_FILES['image'];
    $name = basename($file['name']);
    $target = $targetDir . $name;
    if (move_uploaded_file($file['tmp_name'], $target)) {
        $msg = 'Imagen subida: images/' . $name;
    } else {
        $msg = 'Error al subir imagen.';
    }
}
require_once __DIR__ . '/../includes/header.php';
?>
<div class="container">
  <h2>Subir imagen de producto</h2>
  <?php if($msg) echo '<p>' . htmlspecialchars($msg) . '</p>'; ?>
  <form method="POST" enctype="multipart/form-data">
    <input type="file" name="image" accept="image/*">
    <button class="btn" type="submit">Subir</button>
  </form>
  <p>Coloca las imágenes en <strong>web/images/</strong> y actualiza `products.json` con los nombres de archivo.</p>
  <p><a class="btn" href="orders.php">Volver a pedidos</a></p>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
