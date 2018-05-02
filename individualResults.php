<!DOCTYPE HTML>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Braydon Burn & Bertrand Dungan">
  <title>Search</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/main.css">
  <script src="assets/js/main.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,600,700" rel="stylesheet">

  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
  <link rel="manifest" href="assets/favicon/site.webmanifest">
  <link rel="mask-icon" href="assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
</head>

<body>
  <!-- Header template -->
  <?php
  include 'assets/php/functions.php';
  genHead();
  ?>
  <!-- End Header template -->

  <!-- Individual results form with reviews -->
  <div class="font resultName">
    <h2>Brisbane Square Library Wifi</h2>
    <div id="map">
    </div>

    <div class="font">
      <h2>Reviews</h2>
    </div>
    <div class="review">
      <h3>David: ★ ★ ★ ★ ☆</h3>
      <p>Easy to connect to and decent speed.</p>
    </div>
    <div class="review">
      <h3>Lauren: ★ ★ ★ ☆ ☆</h3>
      <p>Speed could be better.</p>
    </div>
    <div class="review">
      <h3>Jason: ★ ★ ★ ★ ★</h3>
      <p>Easy connection and fast speed.</p>
    </div>
    <div class="review">
      <h3>Libby: ★ ★ ☆ ☆ ☆</h3>
      <p>Terrible speed but easy to connect to.</p>
    </div>
  </div>

  <!-- Footer template -->
  <footer class="footer font">
    <a>© 2018 Braydon Burn & Bertrand Dungan</a>
  </footer>
  <!-- End Footer template -->

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0n5agCie-72j_C-hrl8ByvMjDv5J23zk&callback=myMap"></script>
</body>

</html>