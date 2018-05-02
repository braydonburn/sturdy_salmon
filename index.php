<!DOCTYPE HTML>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Braydon Burn">
  <title>Brisbane Connected</title>
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

	<!-- Adds a spinner loading animation during page load -->
  <div id="overlay" class="onLoad">
    <h5 class="font spinnerText" style="padding-top: 20%">Loading</h5>
    <div class="spinner spinner-1">
    </div>
  </div>

  <!-- Header template -->
  <?php
  include 'assets/php/functions.php';
  genHead();
  ?>
  <!-- End Header template -->

  <!-- End Header template -->

  <!-- Background Video -->
  <video autoplay muted loop id="myVideo">
	  <source src="assets/BrisbaneCBD.mp4" type="video/mp4">
	</video>
  <!-- /Background Video -->

  <!-- Inner content -->
  <div class="content font">
    <h1 id="mainPageTitle">Brisbane Connected</h1>
    <h3>Find free wifi in your area</h3>
    <div class="search">
      <p><a class="homepageSubmit" href="searchPage.html">Search</a></p>
    </div>
  </div>
  <!-- /Inner content -->

  <!-- Footer template -->
  <footer class="footer font">
    <a>© 2018 Braydon Burn & Bertrand Dungan</a>
  </footer>
  <!-- End Footer template -->

</body>

</html>