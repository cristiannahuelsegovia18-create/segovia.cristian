<?php
require_once __DIR__ . '/../includes/config.php';
if (session_status() === PHP_SESSION_NONE) session_start();
$usersFile = __DIR__ . '/users.json';
$users = [];
if (file_exists($usersFile)) $users = json_decode(file_get_contents($usersFile), true)['users'] ?? [];
// If no users, create default admin with password 'admin123' (hashed)
if (empty($users)) {
    $defaultPass = 'admin123';
    $hash = password_hash($defaultPass, PASSWORD_DEFAULT);
    $users = [['username'=>'admin','password'=>$hash]];
    file_put_contents($usersFile, json_encode(['users'=>$users], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    $createdDefault = true;
}
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = $_POST['username'] ?? '';
    $p = $_POST['password'] ?? '';
    foreach ($users as $user) {
        if ($user['username'] === $u && password_verify($p, $user['password'])) {
            $_SESSION['admin_user'] = $u;
            header('Location: orders.php'); exit;
        }
    }
    $error = 'Credenciales inválidas';
}
require_once __DIR__ . '/../includes/header.php';
?>
<div class="container">
  <h2>Admin - Iniciar sesión</h2>
  <?php if(!empty($createdDefault)) echo '<p>Se creó usuario por defecto: <strong>admin</strong> con contraseña <strong>admin123</strong>. Cámbiala después.</p>'; ?>
  <?php if($error) echo '<p style="color:red">'.htmlspecialchars($error).'</p>'; ?>
  <form method="POST">
    <label>Usuario:<br><input name="username" required></label><br>
    <label>Contraseña:<br><input type="password" name="password" required></label><br>
    <button class="btn" type="submit">Entrar</button>
  </form>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
