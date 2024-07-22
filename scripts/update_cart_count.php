<?php
require_once "../db.php";
require_once "../api/CartApi.php";

header("Content-Type: application/json");

$cartApi = new CartApi($pdo);

try {
	$cartProducts = $cartApi->getCartProducts();
	$totalQuantity = array_sum(array_column($cartProducts, "quantity"));
	echo json_encode(["count" => $totalQuantity]);
} catch (Exception $e) {
	echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
