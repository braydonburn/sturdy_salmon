<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Braydon Burn & Bertrand Dungan">
  <title>Search</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/main.css">
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,600,700" rel="stylesheet">
  <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
  <script src="assets/js/main.js"></script>

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
  include('assets/php/functions.php');
  include('server.php');
  genHead();
  ?>
  <!-- End Header template -->

  <form id="content" action="resultsPage.php" method="GET" class="font form">

    <h3>Text Search</h3>
    <input type="search" name="search_input" id="addressSearch" placeholder="Enter address">
    <input type="submit" value="Search">

    <h3>Suburb Selection</h3>
    <select>
        <option value="Default selection">All suburbs</option>
        <option value="Chermside">Chermside</option>
        <option value="Annerley">Annerley</option>
        <option value="Ashgrove">Ashgrove</option>
    </select>

    <!-- Checkbox to search by rating -->
    <h3>Rating Search</h3>
    <div>
      <input id="5stars" name="5stars" type="checkbox" checked>
      <label for="5stars">5 stars</label>
      <br>

      <input id="4stars" name="4stars" type="checkbox" checked>
      <label for="4stars">4 stars</label>
      <br>

      <input id="3stars" name="3stars" type="checkbox" checked>
      <label for="3stars">3 stars</label>
      <br>

      <input id="2stars" name="2stars" type="checkbox" checked>
      <label for="2stars">2 stars</label>
      <br>

      <input id="1stars" name="1stars" type="checkbox" checked>
      <label for="1stars">1 stars</label>
      <br>

      <input id="0stars" name="0stars" type="checkbox" checked>
      <label for="0stars">0 stars</label>
      <br>
    </div>

    <!-- Geolocation div to grab current users location -->
    <h3>Use your location to search</h3>
    <div id="geoLocateDiv" onclick="getLocation()">
      <span id="geoLocateIcon" class="fas fa-map-marker-alt"></span>
      <button id="geoLocateButton">Click here for your coordinates</button>
      <p id="status"></p>
    </div>
  </form>

  <!-- Footer template -->
  <footer class="footer font">
    <a>© 2018 Braydon Burn & Bertrand Dungan</a>
  </footer>
  <!-- End Footer template -->
</body>

</html>
