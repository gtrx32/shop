<?php
class ProductList
{
	public function render($products)
	{
		$html = "";
		$counter = 0;

		foreach ($products as $product) {
			$lazyLoad = ($counter >= 8) ? "loading='lazy'" : "";
			$html .= "
            <div class='col-md-3 mb-4'>
                <div class='card'>
                    <img src='{$product['image']}' class='card-img-top' $lazyLoad alt='{$product['name']}' />
                    <div class='card-body'>
                        <h5 class='card-title'>{$product['name']}</h5>
                        <p class='card-text'>{$product['price']} руб.</p>
                        <button class='btn btn-outline-primary order-button' data-id='{$product['id']}'>Заказать</button>
                    </div>
                </div>
            </div>
            ";
			$counter++;
		}

		return $html;
	}
}
