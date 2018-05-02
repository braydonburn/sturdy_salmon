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

  <!-- Using a center-aligned table to produce the sample results page. -->
  <div class="table form font">
    <table class="table">
      <thead>
        <tr>
          <th>Hotspot Name</th>
          <th>Address</th>
          <th>Star Rating</th>
        </tr>
      </thead>
      <!-- href for link to individual results. -->
      <tbody>
        <tr>
          <td><a href="#">Annerley Library Wifi</a></td>
          <td>450 Ipswich Road, Annerley, 4103</td>
          <td>★ ☆ ☆ ☆ ☆ </td>
        </tr>
        <tr>
          <td><a href="#">Booker Place Park</a></td>
          <td>Birkin Rd & Sugarwood St, Bellbowrie</td>
          <td>★ ★ ★ ☆ ☆ </td>
        </tr>
        <tr>
          <td><a href="individualResults.php">Brisbane Square Library Wifi</a></td>
          <td>Brisbane Square, 266 George Street, Brisbane, 4000</td>
          <td>★ ★ ★ ★ ☆ </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Footer template -->
  <footer class="footer font">
    <a>© 2018 Braydon Burn & Bertrand Dungan</a>
  </footer>
  <!-- End Footer template -->
</body>

</html>