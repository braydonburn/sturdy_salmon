<?php
    $errors = array();
    if (!empty($_POST)) {
        require 'assets/php/validation.php';
        formValidate($errors, $_POST['email'], $_POST['day'],$_POST['month'], $_POST['year'], $_POST['fullName'], $_POST['username'], $_POST['password'], $_POST['confirmPassword']);
        if (count($errors)>0) {
            echo "<h3>Error1.</h3>";
            include 'registrationPage.php';
        } else {
          #This ugly code is here because I forgot to set the option values to
          #be equal to months, one I update some more code I'll remove this
            switch($_POST['month']) {
              case 'January':
              $monthNumber = 1;
              break;
              case 'February':
              $monthNumber = 2;
              break;
              case 'March':
              $monthNumber = 3;
              break;
              case 'April':
              $monthNumber = 4;
              break;
              case 'May':
              $monthNumber = 5;
              break;
              case 'June':
              $monthNumber = 6;
              break;
              case 'July':
              $monthNumber = 7;
              break;
              case 'August':
              $monthNumber = 8;
              break;
              case 'September':
              $monthNumber = 9;
              break;
              case 'October':
              $monthNumber = 10;
              break;
              case 'November':
              $monthNumber = 11;
              break;
              case 'December':
              $monthNumber = 12;
              break;
            }
            $fullname = $_POST['fullName'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $date = $_POST['year'].'-'.$monthNumber.'-'.$_POST['day'];
            #This function should be enough to store the password safely
            $password = password_Hash($_POST['password'], PASSWORD_DEFAULT);

            $pdo = new PDO('mysql:host=localhost;dbname=cab230', 'root1', 'password');
            $query = $pdo->prepare('INSERT into `Members` (fullname, username, email, password, birthday) VALUES (:fullname, :username, :email, :password, :date)');
            $query->bindvalue(':fullname', $fullname);
            $query->bindvalue(':username', $username);
            $query->bindvalue(':email', $email);
            $query->bindvalue(':password', $password);
            $query->bindvalue(':date', $date);
            $query->execute();
            #This code is currently just for error checking, I'll update it
            #later so that it only shows errors users need, like having the same
            #username as someone else and needing to choose a different one
            if ($query) {
              echo $query->rowCount();
              echo "\nPDO::errorInfo():\n";
              print_r($query->errorInfo());
            } else {
              echo "\nPDO::errorInfo():\n";
              print_r($query->errorInfo());
            }
        }
    } else {
        echo "<h3>Error2.</h3>";
        include 'registrationPage.php';
    }
