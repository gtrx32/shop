<?php
require_once "../db.php";
require_once "../api/ProductsApi.php";
require_once "../components/ProductList.php";

header("Content-Type: application/json");

$limit = isset($_GET["limit"]) ? intval($_GET["limit"]) : 12;
$offset = isset($_GET["offset"]) ? intval($_GET["offset"]) : 0;

$productsApi = new ProductsApi($pdo);
$productList = new ProductList();

try {
	$products = $productsApi->getProducts($limit, $offset);
	$hasMore = count($products) === $limit && count($productsApi->getProducts(1, $offset + $limit)) > 0;

	$html = $productList->render($products);

	echo json_encode([
		'html' => $html,
		'hasMore' => $hasMore
	]);
} catch (Exception $e) {
	echo json_encode([
		'error' => "Произошла ошибка: " . $e->getMessage()
	]);
}
