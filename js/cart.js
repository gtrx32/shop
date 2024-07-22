export function loadCart() {
  $.ajax({
    url: "/scripts/load_cart.php",
    dataType: "html",
    success: function (html) {
      $("#cart-items").empty().append(html);
      $("#cartModal").modal("show");
    },
    error: function (xhr, status, error) {
      console.error("Ошибка загрузки товаров в корзине:", error);
    },
  });
}

export function addProductToCart(productId) {
  $.ajax({
    url: "/scripts/add_product_to_cart.php",
    data: { id: productId },
    dataType: "json",
    success: function (data) {
      if (data.success) {
        updateCartCount();
        alert("Товар добавлен в корзину");
      } else {
        alert("Ошибка добавления товара в корзину");
      }
    },
    error: function (xhr, status, error) {
      console.error("Ошибка добавления товара в корзину:", error);
    },
  });
}

export function removeProductFromCart(productId, removeAll) {
  $.ajax({
    url: "/scripts/remove_product_from_cart.php",
    data: { id: productId, removeAll },
    dataType: "json",
    success: function (data) {
      if (data.success) {
        updateCartCount();
        loadCart();
        alert("Товар удален из корзины");
      } else {
        alert("Ошибка удаления товара из корзины");
      }
    },
    error: function (xhr, status, error) {
      console.error("Ошибка добавления товара в корзину:", error);
    },
  });
}

export function updateCartCount() {
  $.ajax({
    url: "/scripts/update_cart_count.php",
    dataType: "json",
    success: function (data) {
      $("#cart-count").text(data.count);
    },
    error: function (xhr, status, error) {
      console.error("Ошибка обновления количества товаров в корзине:", error);
    },
  });
}
