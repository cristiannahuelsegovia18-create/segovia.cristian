<?php
require_once __DIR__ . '/../includes/config.php';
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['admin_user'])) { header('Location: login.php'); exit; }

$usersFile = __DIR__ . '/users.json';
$data = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : ['users'=>[]];
$users = $data['users'] ?? [];
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create user
    if (isset($_POST['create_user'])) {
        $u = trim($_POST['username'] ?? '');
        $p = $_POST['password'] ?? '';
        // validate username: letters, numbers, underscore, dash; 3-32 chars
        if (!preg_match('/^[a-zA-Z0-9_-]{3,32}$/', $u)) { $msg = 'Nombre de usuario inválido (solo letras, números, _ y -; 3-32 caracteres)'; }
        elseif ($u === '' || $p === '') { $msg = 'Usuario y contraseña requeridos'; }
        else {
            foreach ($users as $ex) if ($ex['username'] === $u) { $msg = 'Usuario ya existe'; break; }
            if (!$msg) {
                $users[] = ['username'=>$u, 'password'=>password_hash($p, PASSWORD_DEFAULT)];
                $data['users'] = $users;
                file_put_contents($usersFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
                $msg = 'Usuario creado';
            }
        }
    }

    // Change password
    if (isset($_POST['change_pass'])) {
        $u = $_POST['username'] ?? '';
        $new = $_POST['new_password'] ?? '';
        if ($u === '' || $new === '') { $msg = 'Datos incompletos'; }
        else {
            foreach ($users as $i=>$ex) {
                if ($ex['username'] === $u) {
                    $users[$i]['password'] = password_hash($new, PASSWORD_DEFAULT);
                    $data['users'] = $users;
                    file_put_contents($usersFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
                    $msg = 'Contraseña actualizada';
                    break;
                }
            }
        }
    }

    // Change my password (current admin)
    if (isset($_POST['change_my_pass'])) {
        $current = $_POST['current_password'] ?? '';
        $new = $_POST['new_password_me'] ?? '';
        $user = $_SESSION['admin_user'] ?? '';
        if (!$user) { $msg = 'No autenticado'; }
        else {
            foreach ($users as $i=>$ex) {
                if ($ex['username'] === $user) {
                    if (!password_verify($current, $ex['password'])) { $msg = 'Contraseña actual incorrecta'; break; }
                    if ($new === '') { $msg = 'Nueva contraseña vacía'; break; }
                    $users[$i]['password'] = password_hash($new, PASSWORD_DEFAULT);
                    $data['users'] = $users;
                    file_put_contents($usersFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
                    $msg = 'Tu contraseña fue actualizada';
                    break;
                }
            }
        }
    }

    // Delete user
    if (isset($_POST['delete_user'])) {
        $u = $_POST['username'] ?? '';
        if ($u === '') { $msg = 'Usuario no especificado'; }
        else {
            // prevent deleting last admin or self
            if ($u === $_SESSION['admin_user']) { $msg = 'No puedes eliminar tu propio usuario'; }
            else {
                foreach ($users as $i=>$ex) {
                    if ($ex['username'] === $u) { array_splice($users,$i,1); $data['users'] = $users; file_put_contents($usersFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX); $msg = 'Usuario eliminado'; break; }
                }
            }
        }
    }

    // reload users after changes
    $data = json_decode(file_get_contents($usersFile), true);
    $users = $data['users'] ?? [];
}

// export CSV
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="users.csv"');
    $out = fopen('php://output', 'w');
    fputcsv($out, ['username']);
    foreach ($users as $u) fputcsv($out, [$u['username']]);
    fclose($out);
    exit;
}

require_once __DIR__ . '/../includes/header.php';
?>
<div class="container">
  <h2>Gestionar usuarios</h2>
  <?php if($msg) echo '<p>' . htmlspecialchars($msg) . '</p>'; ?>
  <h3>Usuarios actuales</h3>
  <ul>
    <?php foreach($users as $u): ?><li><?php echo htmlspecialchars($u['username']); ?></li><?php endforeach; ?>
  </ul>

    <h3>Crear usuario</h3>
    <form method="POST"><input name="username" placeholder="usuario (3-32, letras/números/_/-)" required> <input type="password" name="password" placeholder="contraseña" required> <button class="btn" name="create_user">Crear</button></form>

    <h3>Cambiar contraseña (otro usuario)</h3>
    <form method="POST"><input name="username" placeholder="usuario" required> <input type="password" name="new_password" placeholder="nueva contraseña" required> <button class="btn" name="change_pass">Cambiar</button></form>

    <h3>Cambiar mi contraseña</h3>
    <form method="POST">
        <input type="password" name="current_password" placeholder="contraseña actual" required>
        <input type="password" name="new_password_me" placeholder="nueva contraseña" required>
        <button class="btn" name="change_my_pass">Cambiar mi contraseña</button>
    </form>

    <h3>Eliminar usuario</h3>
    <form method="POST" onsubmit="return confirm('Eliminar usuario?');"><input name="username" placeholder="usuario" required> <button class="btn" name="delete_user">Eliminar</button></form>

    <h3>Exportar</h3>
    <p><a class="btn" href="?export=csv">Exportar usuarios a CSV</a></p>

  <p><a class="btn" href="orders.php">Volver a pedidos</a></p>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
