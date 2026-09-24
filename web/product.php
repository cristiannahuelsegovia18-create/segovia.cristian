<?php
header('Location: /web/product.html' . ($_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : ''), true, 302);
exit;
?>
