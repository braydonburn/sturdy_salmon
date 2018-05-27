<?php
    $errors = array();
    if (!empty($_POST)) {
        require 'assets/php/validation.php';
        formValidate($errors, $_POST['email'], $_POST['day'],$_POST['month'], $_POST['year'], $_POST['fullName'], $_POST['username'], $_POST['password'], $_POST['confirmPassword']);
        if (count($errors)>0) {
            echo "<h3>Error1.</h3>";
            echo var_dump($errors);
            include 'registrationPage.php';
        } else {
            # This gets all of the needed values from the post
            $monthNumber = $_POST['month'];
            $fullname = $_POST['fullName'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $date = $_POST['year'].'-'.$monthNumber.'-'.$_POST['day'];
            #This function should be enough to store the password safely
            $password = password_Hash($_POST['password'], PASSWORD_DEFAULT);

            require('assets/php/pdoConnection.php');
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
            if (($query->rowCount())>0) {
              include 'loginPage.php';
              echo "<h1>You are successfully registered</h1>";
            } else {
              $errors['usernameMissing'] = 'Please choose a different username';
              include 'registrationPage.php';
              echo "<h1>Please choose a different username</h1>";
            }
        }
    } else {
        echo "<h3>Error2.</h3>";
        include 'registrationPage.php';
    }
