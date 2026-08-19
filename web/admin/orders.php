<?php
require_once __DIR__ . '/../includes/config.php';

// Auth: use users.json and session
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['admin_user'])) {
    header('Location: login.php'); exit;
}

$ordersFile = __DIR__ . '/../orders.json';
$orders = [];
if (file_exists($ordersFile)) {
    $data = json_decode(file_get_contents($ordersFile), true);
    $orders = $data['orders'] ?? [];
}

$pageTitle = 'Admin - Pedidos';
require_once __DIR__ . '/../includes/header.php';
?>
<div class="container">
    <h2>Pedidos</h2>
    <p>Usuario: <?php echo htmlspecialchars($_SESSION['admin_user']); ?> — <a href="logout.php">Cerrar sesión</a> — <a href="upload.php">Subir imágenes</a> — <a href="users.php">Gestionar usuarios</a></p>
    <table style="width:100%; border-collapse:collapse">
        <thead><tr><th>ID</th><th>Fecha</th><th>Cliente</th><th>Items</th><th>Total</th><th>Status</th><th>Acciones</th></tr></thead>
        <tbody>
        <?php foreach($orders as $idx=>$o): ?>
            <tr style="border-top:1px solid #ddd">
                <td><?php echo htmlspecialchars($o['id']); ?></td>
                <td><?php echo htmlspecialchars($o['date']); ?></td>
                <td><?php echo htmlspecialchars($o['buyer']['name'] ?? ''); ?><br><?php echo htmlspecialchars($o['buyer']['email'] ?? ''); ?></td>
                <td><?php foreach($o['items'] as $it) echo htmlspecialchars($it['qty'].'x '.$it['name']).'<br>'; ?></td>
                <td>$<?php echo number_format($o['total'],2); ?></td>
                <td><?php echo htmlspecialchars($o['status'] ?? ''); ?></td>
                <td>
                    <form method="POST" action="action.php" style="display:inline">
                        <input type="hidden" name="index" value="<?php echo $idx; ?>">
                        <select name="status">
                            <option value="pending">pending</option>
                            <option value="processing">processing</option>
                            <option value="shipped">shipped</option>
                            <option value="completed">completed</option>
                            <option value="cancelled">cancelled</option>
                        </select>
                        <button class="btn" type="submit">Actualizar</button>
                    </form>
                    <form method="POST" action="action.php" style="display:inline; margin-left:6px">
                        <input type="hidden" name="index" value="<?php echo $idx; ?>">
                        <input type="hidden" name="delete" value="1">
                        <button class="btn" type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p><a class="btn" href="<?php echo getUrl(); ?>">Volver al sitio</a></p>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
