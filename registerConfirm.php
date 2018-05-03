<?php
    $errors = array();
    if (isset($_POST['email'])) {
        #require 'assets/php/validate.php';
        #validateEmail($errors, $_POST, 'email');
        if ($errors) {
            include 'registrationPage.php';
        } else {
            #echo 'Form submitted successfully with no errors';
            include 'registrationPage.php';
        }
    } else {
        include 'registrationPage.php';
    }
