<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <meta name='author' content='Braydon Burn & Bertrand Dungan'>
  <title>Search</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel='stylesheet' href='assets/css/main.css'>
  <link href='https://fonts.googleapis.com/css?family=Work+Sans:400,600,700' rel='stylesheet'>
  <script defer src='https://use.fontawesome.com/releases/v5.0.9/js/all.js' integrity='sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl' crossorigin='anonymous'></script>
  <script src='assets/js/main.js'></script>

  <!-- Favicon -->
  <link rel='apple-touch-icon' sizes='180x180' href='assets/favicon/apple-touch-icon.png'>
  <link rel='icon' type='image/png' sizes='32x32' href='assets/favicon/favicon-32x32.png'>
  <link rel='icon' type='image/png' sizes='16x16' href='assets/favicon/favicon-16x16.png'>
  <link rel='manifest' href='assets/favicon/site.webmanifest'>
  <link rel='mask-icon' href='assets/favicon/safari-pinned-tab.svg' color='#5bbad5'>
  <meta name='msapplication-TileColor' content='#da532c'>
  <meta name='theme-color' content='#ffffff'>
</head>

<body>
  <!-- Header template -->
  <?php
  include('assets/php/functions.php');
  genHead();
  ?>
  <!-- End Header template -->

  <form id='content' action='resultsPage.php' method='GET' class='font form'>

    <h3>Text Search</h3>
    <input type='search' name='search_input' id='addressSearch' placeholder='Enter address'>
    <input type='submit' value='Search'>

    <!-- This PHP is used to generate the suburb list so that it changes if
    suburbs are added or removed from the database  -->
    <?php
    require('assets/php/pdoConnection.php');
    $query= $pdo->prepare('SELECT DISTINCT suburb FROM Items ORDER BY
      suburb ASC');
    $query->execute();
    $count = $query->rowCount();
    $suburbSelection = '';
    if ($count == 0) {
        $suburbSelection = 'There is a database error.';
    } else {
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          preg_match_all('/^[A-Za-z\s]*/', $row['suburb'],
          $suburbs, PREG_SET_ORDER);
          $suburbs = implode($suburbs[0]);
          $suburbSelection .= '<option value='.$suburbs.'>'.$suburbs.'</option>';
        }
    }
    ?>
    <h3>Suburb Selection</h3>
    <select name='suburbSelection'>
      <option value=''>All suburbs</option>
      <?php print("$suburbSelection"); ?>
    </select>

    <!-- Checkbox to search by rating -->
    <h3>Minimum Rating Search</h3>
    <select name='minimumRating'>
        <option value='0'>Any Rating</option>
        <option value='5'>Minimum 5 stars</option>
        <option value='4'>Minimum 4 stars</option>
        <option value='3'>Minimum 3 stars</option>
        <option value='2'>Minimum 2 stars</option>
        <option value='1'>Minimum 1 stars</option>
    </select>

    <!-- Geolocation div to grab current users location -->
    <h3>Use your location to search</h3>
    <div id='geoLocateDiv' onclick='getLocation()'>
      <span id='geoLocateIcon' class='fas fa-map-marker-alt'></span>
      <div id='geoLocateButton'>Click here for your coordinates</div>
      <p id='status'></p>
    </div>
  </form>

  <!-- Footer template -->
  <footer class='footer font'>
    <a>© 2018 Braydon Burn & Bertrand Dungan</a>
  </footer>
  <!-- End Footer template -->
</body>

</html>
