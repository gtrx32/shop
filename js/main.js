import { loadProducts } from "./products.js";
import {
  loadCart,
  addProductToCart,
  removeProductFromCart,
  updateCartCount,
} from "./cart.js";

$(document).ready(function () {
  loadProducts();
  updateCartCount();

  $(document).on("click", ".order-button", function () {
    const productId = $(this).data("id");
    addProductToCart(productId);
  });

  $(document).on("click", ".remove-button", function () {
    const productId = $(this).data("id");
    removeProductFromCart(productId, false);
  });

  $(document).on("click", ".remove-all-button", function () {
    const productId = $(this).data("id");
    removeProductFromCart(productId, true);
  });

  $("#load-more").on("click", loadProducts);

  $("#cart-button").on("click", loadCart);
});
