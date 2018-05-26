<?php
session_start();
    if (isset($_SESSION['username'])) {
      $errors = array();
      if (!empty($_POST)) {
        date_default_timezone_set('Australia/Brisbane');
        $hotspotID = $_POST['id'];
        $username = $_SESSION['username'];
        $date = date('Y-m-d');
        $comment = $_POST['comment'];
        $rating = $_POST['rating'];

          if (count($errors)>0) {
              echo "<h3>Error1.</h3>";
          } else {
            $pdo = new PDO('mysql:host=localhost;dbname=cab230', 'root1', 'password');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $pdo->prepare('INSERT INTO Reviews (hotspotID, username, date, comment, rating) VALUES (:hotspotID, :username, :date, :comment, :rating)');
            $query->bindvalue(':hotspotID', $hotspotID);
            $query->bindvalue(':username', $username);
            $query->bindvalue(':date', $date);
            $query->bindvalue(':comment', $comment);
            $query->bindvalue(':rating', $rating);
            $query->execute();
          }
      } else {
          echo "<h3>Error2.</h3>";
      }
    } else {
        header('location: loginPage.php');
    }
