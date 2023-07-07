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
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-C852PQ3T9T"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-C852PQ3T9T');
  </script>
  </body>
</html>
