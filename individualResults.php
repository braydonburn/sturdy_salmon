<!-- Header template -->
  <?php
  include('assets/php/functions.php');
  genMetaAndHeader('Search');
   ?>
<!-- End Header template -->

  <?php
  require('assets/php/validation.php');
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
  <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyC0n5agCie-72j_C-hrl8ByvMjDv5J23zk&callback=myMap'></script>

  <!-- Footer template -->
  <?php
    genFooter();
   ?>
  <!-- End Footer template -->
