
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
  include('server.php');
  genHead();

  if (isset($_GET['search_input'])) {
      $search = $_GET['search_input'];
  } else {
      $search = '';
  }
  $output = '';

  $suburb = '%'.$_GET['suburbSelection'].'%';
  $rating = intval($_GET['minimumRating']);

  require('assets/php/pdoConnection.php');

  # This detects if the input lookd like a geolocation and then searches for
  #wifi in the radius of that location
  if(preg_match('/^[+-]?\d+\.\d+\s[+-]?\d+\.\d+$/',$search)) {
    preg_match_all('/^[+-]?\d+\.\d+\s/', $search, $latitude, PREG_SET_ORDER);
    preg_match_all('/[+-]?\d+\.\d+$/', $search, $longitude, PREG_SET_ORDER);
    $latitude = floatval(implode($latitude[0]));
    $longitude = floatval(implode($longitude[0]));
    $radius = 0.02;
    $latitudeHigh = $latitude+$radius;
    $latitudeLow = $latitude-$radius;
    $longitudeHigh = $longitude+$radius;
    $longitudeLow = $longitude-$radius;
    $query = $pdo->prepare('SELECT id, hotspotName, address, suburb, latitude,
      longitude FROM Items WHERE (latitude BETWEEN :latitudeLow AND
        :latitudeHigh) AND (longitude BETWEEN :longitudeLow AND
          :longitudeHigh)');

    if ($rating===0) {
      $query = $pdo->prepare('SELECT id, hotspotName, address, suburb, latitude,
        longitude FROM Items WHERE (latitude BETWEEN :latitudeLow AND
          :latitudeHigh) AND (longitude BETWEEN :longitudeLow AND
            :longitudeHigh)');
    } else {
      $query = $pdo->prepare('SELECT id, hotspotName, address, suburb, latitude,
        longitude FROM Items WHERE (latitude BETWEEN :latitudeLow AND
          :latitudeHigh) AND (longitude BETWEEN :longitudeLow AND
            :longitudeHigh) AND (id IN (SELECT hotspotID FROM Reviews
          GROUP BY hotspotID HAVING AVG(rating)>=:rating))');
      $query->bindvalue(':rating', $rating);
    }
    $query->bindvalue(':latitudeHigh', $latitudeHigh);
    $query->bindvalue(':latitudeLow', $latitudeLow);
    $query->bindvalue(':longitudeHigh', $longitudeHigh);
    $query->bindvalue(':longitudeLow', $longitudeLow);
    $query->execute();
  } else {
    # This is a WIP for the search by name
    $search = '%'.$_GET['search_input'].'%';
    if ($rating===0) {
      $query = $pdo->prepare('SELECT id, hotspotName, address, suburb FROM Items
        WHERE (hotspotName LIKE :search OR suburb LIKE :search) AND
        (suburb LIKE :suburb)');
    } else {
      $query = $pdo->prepare('SELECT id, hotspotName, address, suburb FROM Items
        WHERE (hotspotName LIKE :search OR suburb LIKE :search) AND
        (suburb LIKE :suburb) AND (id IN (SELECT hotspotID FROM Reviews
          GROUP BY hotspotID HAVING AVG(rating)>=:rating))');
      $query->bindvalue(':rating', $rating);
    }
    $query->bindvalue(':search', $search);
    $query->bindvalue(':suburb', $suburb);
    $query->execute();
  }
  $count = $query->rowCount();

  # This code runs if there are no results
  if ($count == 0) {
      $output = 'There were no search results, sorry.';
  # This shows the results
  } else {
      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $id = $row['id'];
          $hotspotName = $row['hotspotName'];
          $address = $row['address'];
          $suburb = $row['suburb'];
          $output .= '<tr><td><a href=\'individualResults.php?id='.$id.'\'>'.
          $hotspotName.'</a></td><td>'.$address.'</td><td>'.$suburb.'</tr>';
      }
  }
  ?>
  <!-- End Header template -->

  <!-- Using a center-aligned table to produce the sample results page. -->
  <div class='table form font'>
    <table class='table'>
      <thead>
        <tr>
          <th>Hotspot Name</th>
          <th>Address</th>
          <th>Suburb</th>
        </tr>
      </thead>
      <!-- href for link to individual results. -->
      <tbody>
        <?php print("$output"); ?>
      </tbody>
    </table>
  </div>

  <!-- Footer template -->
  <footer class='footer font'>
    <a>© 2018 Braydon Burn & Bertrand Dungan</a>
  </footer>
  <!-- End Footer template -->
</body>

</html>
