document.addEventListener("DOMContentLoaded", () => {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  const cartList = document.querySelector("#cart");
  const checkoutButton = document.querySelector("#checkout");

  if (cart.length === 0) {
    cartList.innerHTML = "<li>Cart is empty</li>";
  } else {
    cartList.innerHTML = cart
      .map((item) => {
        return `<li>${item.name} x ${item.quantity}</li>`;
      })
      .join("");
  }

  checkoutButton.addEventListener("click", () => {
    localStorage.removeItem("cart");
    alert("Thank you for your purchase!");
    window.location.reload();
  });
});
