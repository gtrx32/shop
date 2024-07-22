<?php
class ProductsApi
{
	private $pdo;

	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function getProducts($limit, $offset)
	{
		$query = $this->pdo->prepare("SELECT * FROM product LIMIT :limit OFFSET :offset");
		$query->bindValue(":limit", $limit, PDO::PARAM_INT);
		$query->bindValue(":offset", $offset, PDO::PARAM_INT);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
}
