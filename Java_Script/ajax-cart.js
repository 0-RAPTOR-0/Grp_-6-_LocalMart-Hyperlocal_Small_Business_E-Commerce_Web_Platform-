const addToCartBtn = document.getElementById("addToCartBtn");

if (addToCartBtn) {
  
  addToCartBtn.addEventListener("click", function (event) {

    event.preventDefault();

       const productId = addToCartBtn.getAttribute("data-product-id");
       const qtyInput = document.getElementById("qty");
       const quantity = qtyInput ? qtyInput.value : 1;

       const formData = new FormData();

       formData.append("product_id", productId);
       formData.append("quantity", quantity);

       addToCartBtn.textContent = "Adding...";
       addToCartBtn.disabled = true;

      fetch("../php/ajax/add_to_cart.php", {

      method: "POST",
      body: formData

    })

      .then(function (response) {

        return response.json(); 

      })

      .then(function (data) {

        addToCartBtn.disabled = false;

        if (data.success) {

          addToCartBtn.textContent = "Added ✓";
          showCartMessage(data.message, "success");

          const cartBadge = document.getElementById("cartCount");
          if (cartBadge) {
            cartBadge.textContent = data.cart_count;
          }

          setTimeout(function () {
            addToCartBtn.textContent = "Add to Cart";
          }, 2000);

        } else {
          addToCartBtn.textContent = "Add to Cart";
          showCartMessage(data.message, "error");
        }

      })

      .catch(function (error) {
        addToCartBtn.disabled = false;
        addToCartBtn.textContent = "Add to Cart";
        showCartMessage("Something went wrong. Please try again.", "error");

      });

  });

}

function showCartMessage(message, type) {

  const box = document.getElementById("cartMessage");

  if (box) {

    box.textContent = message;
    box.className = type === "error" ? "form-message error" : "form-message success";

  }
  
}