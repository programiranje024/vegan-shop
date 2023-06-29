 <?php
$logged_in = Session::isLoggedIn();
?>
  <footer class="text-center">
    <p id="time">...</p>
  </footer>
  <script src="/js/time.js"></script>
  <?php if ($logged_in) { 
    echo "<script> var userId = '" . Session::getSessionUser()['id'] . "'; </script>";
    echo "<script src='/js/cart.js'></script>";
  }
  ?>
  </body>
</html>
