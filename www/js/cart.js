async function getCartItemCount() {
  const data = await fetch(`/user/get_cart.php?uid=${userId}`);
  const json = await data.json();

  return json.count;
}

async function clearCart() {
  const data = await fetch(`/user/clear_cart.php?uid=${userId}`);

  window.location.reload();
}

getCartItemCount().then((count) => {
  document.getElementById("cart-link").textContent = `Cart (${count})`;
});
