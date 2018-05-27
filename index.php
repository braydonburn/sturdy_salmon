<!DOCTYPE HTML>
<html lang='en'>

<head>
  <title>Brisbane Connected</title>
  <?php
  include('assets/php/functions.php');
  genMeta();
   ?>
</head>

<body>

	<!-- Adds a spinner loading animation during page load -->
  <div id='overlay' class='onLoad'>
    <h5 class='font spinnerText'>Loading</h5>
    <div class='spinner spinner-1'>
    </div>
  </div>

  <!-- Header template -->
  <?php
  genHead();
  ?>
  <!-- End Header template -->

  <!-- Background Video -->
  <video autoplay muted loop id='myVideo'>
	  <source src='assets/BrisbaneCBD.mp4' type='video/mp4'>
	</video>
  <!-- /Background Video -->

  <!-- Inner content -->
  <div class='content font'>
    <h1 id='mainPageTitle'>Brisbane Connected</h1>
    <h3>Find free wifi in your area</h3>
    <div class='search'>
      <p><a class='homepageSubmit' href='searchPage.php'>Search</a></p>
    </div>
  </div>
  <!-- /Inner content -->

  <!-- Footer template -->
  <?php
    genFooter();
   ?>
  <!-- End Footer template -->

</body>

</html>
