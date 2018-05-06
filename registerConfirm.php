<?php
    $errors = array();
    if (isset($_POST['email'])) {
        #require 'assets/php/validate.php';
        #validateEmail($errors, $_POST, 'email');
        if ($errors) {
            echo "<h3>Error1.</h3>";
            include 'registrationPage.php';
        } else {
            #echo 'Form submitted successfully with no errors';
            $fullname = stripslashes($_REQUEST['fullname']);
            $fullname = mysqli_real_escape_string($con, $fullname);
            $username = stripslashes($_REQUEST['username']);
            $username = mysqli_real_escape_string($con, $username);
            $email = stripslashes($_REQUEST['email']);
            $email = mysqli_real_escape_string($con, $email);
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($con, $password);

            $query = "INSERT into `users` (username, password, email, trn_date) VALUES ('$fullname', '$username', '$email', '".md5($password)."')";
            $result = mysqli_query($con, $query);
            if ($result) {
                echo "<h3>You are registered successfully.</h3>";
            }
        }
    } else {
        echo "<h3>Error2.</h3>";
        include 'registrationPage.php';
    }
