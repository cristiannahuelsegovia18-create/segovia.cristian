<?php
require_once __DIR__ . '/../includes/config.php';
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['admin_user'])) { header('Location: login.php'); exit; }
$ordersFile = __DIR__ . '/../orders.json';
if (!file_exists($ordersFile)) {
    header('Location: orders.php'); exit;
}
$data = json_decode(file_get_contents($ordersFile), true);
$orders = $data['orders'] ?? [];
$idx = isset($_POST['index']) ? intval($_POST['index']) : -1;
if ($idx < 0 || !isset($orders[$idx])) { header('Location: orders.php'); exit; }
if (isset($_POST['delete'])) {
    array_splice($orders, $idx, 1);
} else {
    $status = isset($_POST['status']) ? $_POST['status'] : $orders[$idx]['status'];
    $orders[$idx]['status'] = $status;
}
$data['orders'] = $orders;
file_put_contents($ordersFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
header('Location: orders.php');
exit;
