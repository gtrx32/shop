<?php
$host = "localhost";
$dbname = "shop_db";
$username = "root";
$password = "root";

try {
	$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Ошибка подключения: " . $e->getMessage();
	exit;
}
