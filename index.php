<?php

define('SERVER_ROOT', $_SERVER['DOCUMENT_ROOT'].'/');
// define('SITE_ROOT', 'http://localhost/');
$isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
	|| (isset($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443)
	|| (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
$scheme = $isHttps ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
define('SITE_ROOT', $scheme . '://' . $host . '/');

require_once SERVER_ROOT.'controllers/'.'router.php';
?>