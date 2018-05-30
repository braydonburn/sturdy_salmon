<?php
// This is a sanity check to start a session if it doesn't already exist
if (!isset($_SESSION['username']) && !empty($_SESSION['username'])) {
  session_start();
}
// Checks if the user entered a username, if they did then the check will
//happen. This is also used for if users have just registed as they will be
//taken here to begin their session. This also provides a sanity check for if
//the data the user entered matches that which was entered into the database
if (isset($_POST['username'])) {
    $username = ($_POST['username']);
    $password = ($_POST['password']);
    // This query checks if the user exists or not and fetches their password
    //in hash form, if they exist. If the user does not exist then both will be,
    //empty.
    require('assets/php/pdoConnection.php');
    $query = $pdo->prepare('SELECT username, password FROM `Members` WHERE username=:username');
    $query->bindvalue(':username', $username);
    $query->execute();
    $passwordHash = $query->fetchColumn(1);

    // If the query did not execute successfully, then there must be a DB error,
    //so the user is shown an appropriate error. Then the password is checked
    //against the hash, if it matches then the user is logged in, otherwise an
    //error is shown.
    if ($query) {
      if (password_verify($password, $passwordHash)) {
        $_SESSION['username'] = $username;
        header('Location: searchPage.php');
      } else {
          $errors = 'Username or password is incorrect.';
          require 'loginFroms.php';
      }
    } else {
      $errors = 'There was a database error, please try again.';
      require 'loginForms.php';
    }
} else {
  require 'loginForms.php';
}
?>
