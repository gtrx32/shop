<?php
class Cart
{
	public function render($products)
	{
		$html = "";
		$total = 0;

		foreach ($products as $product) {
			$total += $product["price"] * $product["quantity"];

			$html .= "
      <li class='list-group-item'>
        <div class='row'>
          <div class='col-md-6'>
            {$product["name"]} (x{$product["quantity"]})
          </div>
          <div class='col-md-3 text-right'>
            {$product["price"]} руб. * {$product["quantity"]}
          </div>
          <div class='col-md-3'>
            <div class='d-flex justify-content-end gap-2'>
              <button class='btn btn-outline-danger remove-button' data-id='{$product["id"]}'>-</button>
              <button class='btn btn-outline-danger remove-all-button ml-2' data-id='{$product["id"]}'>Убрать всё</button>
            </div>
          </div>
        </div>
      </li>
      ";
		}

		$total = number_format($total, 2, '.', '');

		$html .= "
    <div class='d-flex justify-content-between align-items-center mt-2 px-3 py-2'>
			<strong>Итого:</strong>
      <span class='text-primary'>{$total} руб.</span>
    </div>
    ";

		return $html;
	}
}
