
<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Search</title>
  <?php
  include('assets/php/functions.php');
  genMeta();
   ?>
</head>

<body>
  <!-- Header template -->
  <?php
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
  if (preg_match('/^[+-]?\d+\.\d+\s[+-]?\d+\.\d+$/', $search)) {
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
      # This searches by the name that is input by the user
      $search = '%'.$_GET['search_input'].'%';
      if ($rating===0) {
          $query = $pdo->prepare('SELECT id, hotspotName, address, suburb, latitude,
        longitude FROM Items
        WHERE (hotspotName LIKE :search OR suburb LIKE :search) AND
        (suburb LIKE :suburb)');
      } else {
          $query = $pdo->prepare('SELECT id, hotspotName, address, suburb, latitude,
        longitude FROM Items
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
      $mapArray = [];
      foreach ($query as $row){
          $id = $row['id'];
          $hotspotName = $row['hotspotName'];
          $address = $row['address'];
          $suburb = $row['suburb'];
          $latitude = $row['longitude'];
          $longitude = $row['latitude'];
          $output .= '<tr><td><a href=\'individualResults.php?id='.$id.'\'>'.
          $hotspotName.'</a></td><td>'.$address.'</td><td>'.$suburb.'</tr>';
          $arrayContents = [$hotspotName, $latitude, $longitude, $address, $suburb, $id];
          array_push($mapArray, $arrayContents);
      }
  }
  ?>
  <!-- End Header template -->
  <!-- Map -->
  				<!-- Script to intialise map and markers -->
          <script type='text/javascript'>
          function initMap() {
              var locations = <?php echo json_encode($mapArray); ?>;

              window.map = new google.maps.Map(document.getElementById('map'), {
              });

              var infowindow = new google.maps.InfoWindow();

              var bounds = new google.maps.LatLngBounds();

              for (i = 0; i < locations.length; i++) {
                  marker = new google.maps.Marker({
                      position: new google.maps.LatLng(locations[i][2], locations[i][1]),
                      map: map
                  });

                  bounds.extend(marker.position);

                  google.maps.event.addListener(marker, 'click', (function (marker, i) {
                      return function () {
                          infowindow.setContent('<p><a href=\'individualResults.php?id='
                          +locations[i][5]+'\'>'+locations[i][0]+'</a></p><p>'+
                          locations[i][3]+', '+locations[i][4]+'</p>');
                          infowindow.open(map, marker);
                      }
                  })(marker, i));
              }
              map.fitBounds(bounds);

              var listener = google.maps.event.addListener(map, "idle", function () {
                  map.setZoom(12);
                  google.maps.event.removeListener(listener);
              });
              var markerBounds = new GLatLngBounds();
          }
          </script>
          <script type = 'text/javascript' sync defer
          src='https://maps.googleapis.com/maps/api/js?key=AIzaSyC0n5agCie-72j_C-hrl8ByvMjDv5J23zk&callback=initMap';>
          </script>

          <div id="map"></div>

  				<!-- Google Maps API script -->

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
  <?php
    genFooter();
   ?>
  <!-- End Footer template -->
</body>

</html>
