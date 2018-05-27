<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Login</title>
  <?php
  include('assets/php/functions.php');
  genMeta();
   ?>
</head>

<body>
  <!-- Header template -->

  <?php
  genHead();

  // If form submitted, insert values into the database.
  if (isset($_POST['username'])) {
      $username = ($_POST['username']);
      $password = ($_POST['password']);
      //Checking is user exists in the database or not
      require('assets/php/pdoConnection.php');
      $query = $pdo->prepare('SELECT username, password FROM `Members` WHERE username=:username');
      $query->bindvalue(':username', $username);
      $query->execute();
      $passwordHash = $query->fetchColumn(1);

      if ($query) {
        if (password_verify($password, $passwordHash)) {
          $_SESSION['username'] = $username;
          header('Location: searchPage.php');
        } else {
            echo '<div class=\'form\'>
                  <h3>Username/password is incorrect.</h3>
                  </div>';
        }
      } else {
        echo '<div class=\'form\'>
              <h3>There was a database error.</h3>
              </div>';
      }
  }
  ?>

  <!-- End Header template -->

  <!-- Login form content -->
  <div id='login' class='font form'>
    <h2>Login to your account</h2>
    <form id='myForm' name='login' onsubmit='return validateLogin()' method='post' action=''>
      <input type='text' name='username' placeholder='username' required/>
      <span id='emailMissing' class='error-message'>Valid email is required</span>
      <input type='password' name='password' placeholder='password' required/>
      <span id='passwordMissing' class='error-message'>Valid password is required</span>
      <br><br>
      <input name='submit' type='submit' onclick='validateLogin()' value='Login' />
    </form>
  </div>

  <!-- Footer template -->
<?php
  genFooter();
 ?>
  <!-- End Footer template -->

</body>
</html>
