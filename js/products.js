let offset = 0;
const limit = 12;

export function loadProducts() {
  $.ajax({
    url: "/scripts/load_products.php",
    data: { limit: limit, offset: offset },
    dataType: "json",
    success: function (data) {
      $("#products").append(data.html);
      offset += limit;
      if (!data.hasMore) {
        $("#load-more").hide();
      }
    },
    error: function (xhr, status, error) {
      console.error("Ошибка загрузки товаров:", error);
    },
  });
}
