<?php
require_once "../db.php";
require_once "../api/CartApi.php";
require_once "../components/Cart.php";

header("Content-Type: text/html");

$cartApi = new CartApi($pdo);
$cart = new Cart();

try {
	$cartProducts = $cartApi->getCartProducts();
	echo $cart->render($cartProducts);
} catch (Exception $e) {
	echo "<p>Произошла ошибка: " . $e->getMessage() . "</p>";
}
