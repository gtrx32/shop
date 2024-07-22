<?php
require_once "../db.php";
require_once "../api/CartApi.php";

header("Content-Type: application/json");

if (!isset($_GET["id"])) {
	echo json_encode(["success" => false, "message" => "Не указан ID товара"]);
	exit;
}

$productId = $_GET["id"];
$removeAll = isset($_GET["removeAll"]) ? filter_var($_GET["removeAll"], FILTER_VALIDATE_BOOLEAN) : false;

$cartApi = new CartApi($pdo);

try {
	$cartApi->removeProduct($productId, $removeAll);
	echo json_encode(["success" => true, "message" => null]);
} catch (Exception $e) {
	echo json_encode(["success" => false, "message" => "Ошибка при удалении товара: " . $e->getMessage()]);
}
