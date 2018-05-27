<?php
session_start();
require('assets/php/validation.php');
    # This will redirect the user back to the login page if they are not logged in
    if (isset($_SESSION['username'])) {
      $errors = array();

      # This will return users to the search page if they did not get here
      #through the review form
      if (!empty($_POST)) {
        date_default_timezone_set('Australia/Brisbane');
        $hotspotID = $_POST['id'];
        $username = ($_SESSION['username']);
        $date = date('Y-m-d');
        $comment = sanitise($_POST['comment']);
        $rating = $_POST['rating'];

          # This will insert the review into the database if there are no errors
          #and then it will redirect them to the page they just reviewed
          if (count($errors)>0) {
            header('location: individualResults.php?id='.$hotspotID);
          } else {
            require('assets/php/pdoConnection.php');
            $query = $pdo->prepare('INSERT INTO Reviews (hotspotID, username,
              date, comment, rating) VALUES (:hotspotID, :username, :date,
                :comment, :rating)');
            $query->bindvalue(':hotspotID', $hotspotID);
            $query->bindvalue(':username', $username);
            $query->bindvalue(':date', $date);
            $query->bindvalue(':comment', $comment);
            $query->bindvalue(':rating', $rating);
            $query->execute();
            header('location: individualResults.php?id='.$hotspotID);
          }
      } else {
        header('location: searchPage.php');
      }
    } else {
        header('location: loginPage.php');
    }
?>
