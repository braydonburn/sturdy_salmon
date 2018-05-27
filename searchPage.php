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
  <?php
    genFooter();
   ?>
  <!-- End Footer template -->
</body>

</html>
