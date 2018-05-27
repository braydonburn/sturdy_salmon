
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

  $resultsArray = $query->fetch(PDO::FETCH_ASSOC);
  $PHPtoJSON = json_encode($resultsArray);

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
          $latitude = $row['longitude'];
          $longitude = $row['latitude'];
          $output .= '<tr><td><a href=\'individualResults.php?id='.$id.'\'>'.
          $hotspotName.'</a></td><td>'.$address.'</td><td>'.$suburb.'</tr>';
      }
  }

  ?>
  <!-- End Header template -->

  <!-- Map -->
  			<div id="map">
  				<!-- Script to intialise map and markers -->
  				<script>
  				/* Function for adding markers using search parameters */
  				function initMap() {
  					<?php try {
  						echo "var markersJSON = $PHPtoJSON;";
  					} catch (Exception $e) {} ?>
  					var bounds = new google.maps.LatLngBounds();
  					var parksMap = new google.maps.Map(document.getElementById('map'), {
  						zoom: 1
  					});
  					// Add markers from data
  					for (var i = 0; i < markersJSON.length; i++) {
  					 var star = "&#9733;".repeat(parseInt(markersJSON[i]["Rating"])) + "&#9734;".repeat(parseInt(5 - markersJSON[i]["Rating"]))
  						var parkInfo = new google.maps.InfoWindow({
  							content: "<a href='park.php?id=" + markersJSON[i]["id"] + "'><p class='park-name'>" + markersJSON[i]["Name"] + "</p></a>" +
  							"<p class='location'>" + markersJSON[i]["Suburb"] + "</p>" +
  							"<p class='rating'>" + star + "</p>" +
  							"</div>"
  						});
  						var markerObject = new google.maps.Marker({
  							position: new google.maps.LatLng(parseFloat(markersJSON[i]["Latitude"]), parseFloat(markersJSON[i]["Longitude"])),
  							map: parksMap,
  							title: markersJSON[i]["Name"],
  							infowindow: parkInfo
  						});
  						// Add click listener to display info window
  						google.maps.event.addListener(markerObject, 'click', function() {
  								this.infowindow.open(map, this);
  						});
  						bounds.extend(markerObject.position);
  					}
  					parksMap.fitBounds(bounds);
  				}
  				</script>

  				<!-- Google Maps API script -->
  				<script async defer
  				src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0n5agCie-72j_C-hrl8ByvMjDv5J23zk&callback=initMap&sensor=false">
  				</script>
  			</div>

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

  <div id="map">

  </div>
  <!-- Footer template -->
  <?php
    genFooter();
   ?>
  <!-- End Footer template -->
</body>

</html>
