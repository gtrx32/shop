<?php
class CartApi
{
	private $pdo;

	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function addProduct($productId)
	{
		$query = $this->pdo->prepare("SELECT quantity FROM cart WHERE product_id = :product_id");
		$query->bindValue(":product_id", $productId, PDO::PARAM_INT);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);

		if ($result) {
			$quantity = $result["quantity"] + 1;
			$query = $this->pdo->prepare("UPDATE cart SET quantity = :quantity WHERE product_id = :product_id");
			$query->bindValue(":quantity", $quantity, PDO::PARAM_INT);
			$query->bindValue(":product_id", $productId, PDO::PARAM_INT);
			$query->execute();
		} else {
			$query = $this->pdo->prepare("INSERT INTO cart (product_id, quantity) VALUES (:product_id, 1)");
			$query->bindValue(":product_id", $productId, PDO::PARAM_INT);
			$query->execute();
		}
	}

	public function removeProduct($productId, $removeAll)
	{
		if ($removeAll) {
			$query = $this->pdo->prepare("DELETE FROM cart WHERE product_id = :product_id");
			$query->bindValue(":product_id", $productId, PDO::PARAM_INT);
			$query->execute();
		} else {
			$query = $this->pdo->prepare("SELECT quantity FROM cart WHERE product_id = :product_id");
			$query->bindValue(":product_id", $productId, PDO::PARAM_INT);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_ASSOC);

			if ($result["quantity"] > 1) {
				$quantity = $result["quantity"] - 1;
				$query = $this->pdo->prepare("UPDATE cart SET quantity = :quantity WHERE product_id = :product_id");
				$query->bindValue(":quantity", $quantity, PDO::PARAM_INT);
				$query->bindValue(":product_id", $productId, PDO::PARAM_INT);
				$query->execute();
			} else if ($result["quantity"] === 1) {
				$query = $this->pdo->prepare("DELETE FROM cart WHERE product_id = :product_id");
				$query->bindValue(":product_id", $productId, PDO::PARAM_INT);
				$query->execute();
			}
		}
	}

	public function getCartProducts()
	{
		$query = $this->pdo->prepare("SELECT p.id, p.name, p.image, p.price, c.quantity FROM cart c JOIN product p ON c.product_id = p.id");
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
}
