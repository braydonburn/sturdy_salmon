<!DOCTYPE HTML>
<html lang='en'>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <meta name='author' content='Braydon Burn & Bertrand Dungan'>
  <title>Search</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel='stylesheet' href='assets/css/main.css'>
  <script src='assets/js/main.js'></script>
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
  require('assets/php/validation.php');
  genHead();

  if (isset($_GET['id'])) {
      $id = $_GET['id'];
  }

  # This querys the database for the location details relating to the hotspot
  require('assets/php/pdoConnection.php');
  $query = $pdo->prepare('SELECT * FROM Items WHERE id = :id');
  $query->bindvalue(':id',$id);
  $query->execute();
  $count = $query->rowCount();

  # If there is no result for that id, either due to a databse error or the user
  #entering an id that does not exist, the page will redirect back to the search
  if ($count == 0) {
    header('location: searchPage.php');
  } else {
    # This gets the location data from the database to then pass onto the JS map
      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $hotspotName = $row['hotspotName'];
          $address = $row['address'];
          $suburb = $row['suburb'];
          $latitude = $row['latitude'];
          $longitude = $row['longitude'];
      }
  }
  ?>
  <!-- End Header template -->

  <script type='text/javascript'>
  // This function creates the Google map to show wifi locations
  //Pass php lat/long variables to js
  var latitude = '<?php echo $latitude; ?>';
  var longitude = '<?php echo $longitude; ?>';

  function myMap() {
    var myCenter = new google.maps.LatLng(latitude, longitude);
    var mapCanvas = document.getElementById('map');
    var mapOptions = {
      center: myCenter,
      zoom: 18
    };
    var map = new google.maps.Map(mapCanvas, mapOptions);
    var marker = new google.maps.Marker({
      position: myCenter
    });
    marker.setMap(map);
  }
  </script>

  <!-- Individual results form with reviews -->
    <div class='font resultName'>
      <h2><?php print("$hotspotName"); ?></h2>
      <div id='map'>
      </div>
      <div class='grid-container'>
        <div class='review-left'>
          <!-- This  shows the user the address of the wifi with the suburb and
        the GeoCoordinates. It also has microdata for all of these items-->
          <div class='font' itemscope itemtype='http://schema.org/Place'>
            <h2>Address</h2>
            <span itemprop="streetAddress"><p><?php print("$address"); ?></p></span>
            <span itemprop="addressLocality"><p><?php print("$suburb"); ?></p></span>
            <div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
              <p>Latitude: <?php print("$latitude"); ?></p>
              <p>Longitude: <?php print("$longitude"); ?></p>
              <meta itemprop="latitude" content=<?php print("$latitude"); ?>/>
              <meta itemprop="longitude" content=<?php print("$longitude"); ?>/>
            </div>
          </div>
          <h2>Reviews</h2>

          <?php
          # This shows the reviews that other people have posted with their
          #username, comment, star rating, and the date of their review
          $query = $pdo->prepare('SELECT username, date, comment, rating
            FROM Reviews WHERE hotspotID = :hotspotID');
          $query->bindvalue(':hotspotID', $id);
          $query->execute();
          $count = $query->rowCount();

          # This checks if there are any reviews yet, if there aren't it shows a
          #message, otherwise it will show each review with its star rating, the
          #author, and the date it was published. These all have microdata.
          if ($count == 0) {
            echo '<h2>There are no reviews for this wifi yet</h2>';
          } else {
            $reviewContents = '';
              while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                  $username = sanitise($row['username']);
                  $rating = $row['rating'];
                  $ratingStar = '';
                  for ($x = 0; $x<$rating; $x++) {
                    $ratingStar .= '★ ';
                  }
                  for ($y=0; $y<=(4-$rating); $y++) {
                    $ratingStar .= '☆ ';
                  }
                  $comment = sanitise($row['comment']);
                  $date = $row['date'];
                  $reviewContents .= '<div class=\'review\' itemscope
                  itemtype=\'http://schema.org/Review\'><h3><span
                  itemprop=\'author\'>'.$username.'</span>: <span
                  itemprop=\'reviewRating\'>'.$ratingStar.'</span></h3>'.
                  '<p><span itemprop=\'description\'>'.$comment.'</span></p><p>
                  <span itemprop=\'datePublished\'>'.$date.'</span></p></div>';
              }
              print("$reviewContents");
          }
           ?>
        </div>
        <!-- This shows an box where users can add reviews, but it is only
        visible if the user is logged in -->
      <form method='post' action='reviewPost.php'>
        <?php showReviewBox() ?>
      </form>

    </div>
  </div>

  <!-- Footer template -->
  <footer class='footer font'>
    <a>© 2018 Braydon Burn & Bertrand Dungan</a>
  </footer>
  <!-- End Footer template -->
  <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyC0n5agCie-72j_C-hrl8ByvMjDv5J23zk&callback=myMap'></script>
</body>
</html>
