<?php
// require all libs
require_once('../lib/lib.php');

user_guard();

// include header
include_once('../views/header.php');
?>

<h1>Cart</h1>
<div id="cart"></div>
<button id="checkout">Checkout</button>
<script src="/js/cart.js"></script>

