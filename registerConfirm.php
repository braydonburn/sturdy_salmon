<?php
    # This establishes an array that will be used to keep the errors that are in
    #the user's inputs and will then be reported back to them
    $errors = array();

    # This will validate the form and display errors, only if the user has
    #submitted anything, this is to stop errors appearing on loading the page
    if (!empty($_POST)) {

        # This validates the form to ensure only valid inputs are entered
        require 'assets/php/validation.php';
        formValidate($errors, $_POST['email'], $_POST['day'],$_POST['month'],
        $_POST['year'], $_POST['fullName'], $_POST['username'],
        $_POST['password'], $_POST['confirmPassword']);

        # If there are no errors then the user's data will be put into the
        #database, otherwise the form will be shown again.
        if (count($errors)>0) {
            include 'registrationPage.php';
        } else {
            # This gets all of the needed values from the post
            $monthNumber = $_POST['month'];
            $fullname = $_POST['fullName'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $date = $_POST['year'].'-'.$monthNumber.'-'.$_POST['day'];

            # This function stores the password as a hash, with the salt as part
            #of the hash.
            $password = password_Hash($_POST['password'], PASSWORD_DEFAULT);
            require('assets/php/pdoConnection.php');

            # This will insert the users values into the database
            $query = $pdo->prepare('INSERT into `Members` (fullname, username,
              email, password, birthday) VALUES (:fullname, :username, :email,
                :password, :date)');
            $query->bindvalue(':fullname', $fullname);
            $query->bindvalue(':username', $username);
            $query->bindvalue(':email', $email);
            $query->bindvalue(':password', $password);
            $query->bindvalue(':date', $date);
            $query->execute();

            # This checks whether users need to choose a differnt username
            #either because it is already in use or there was an error in adding
            #it to the database. If there are no errors the user will register
            if (($query->rowCount())>0) {
              include 'loginPage.php';
            } else {
              $errors['usernameMissing'] = 'There was a database error, please try again';
              include 'registrationPage.php';
            }
        }
    } else {
        include 'registrationPage.php';
    }
?>
