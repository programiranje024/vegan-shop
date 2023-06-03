document.addEventListener("DOMContentLoaded", () => {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  // Create a Buy Button
  const buyButton = document.createElement("button");
  buyButton.textContent = "Buy";
  buyButton.addEventListener("click", () => {
    // Add the item to the cart
    const exists = cart.find((item) => item.id === product.id);
    if (exists) {
      // Modify the quantity
      cart = cart.map((ci) => {
        if (ci.id === product.id) {
          ci.quantity += 1;
        }
        return ci;
      });
    } else {
      // Add the item to the cart
      cart.push({
        ...product,
        quantity: 1,
      });
    }

    // Save the cart to localStorage
    localStorage.setItem("cart", JSON.stringify(cart));
  });

  // Add the Buy Button to the page
  document.body.appendChild(buyButton);
});
