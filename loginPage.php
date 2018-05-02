<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Braydon Burn & Bertrand Dungan">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/main.css">
  <script src="assets/js/main.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,600,700" rel="stylesheet">

  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
  <link rel="manifest" href="assets/favicon/site.webmanifest">
  <link rel="mask-icon" href="assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
</head>

<body>
  <!-- Header template -->

  <?php
  include 'assets/php/functions.php';
  require('server.php');
  genHead();

  session_start();

  // If form submitted, insert values into the database.
  if (isset($_POST['email'])){
          // removes backslashes
  	$email = stripslashes($_REQUEST['email']);
          //escapes special characters in a string
  	$email = mysqli_real_escape_string($con,$email);
  	$password = stripslashes($_REQUEST['password']);
  	$password = mysqli_real_escape_string($con,$password);
  	//Checking is user existing in the database or not
          $query = "SELECT * FROM `users` WHERE email='$email'
  and password='".md5($password)."'";
  	$result = mysqli_query($con,$query) or die(mysql_error());
  	$rows = mysqli_num_rows($result);
          if($rows==1){
  	    $_SESSION['$email'] = $email;
              // Redirect user to index.php
  	    header("Location: searchPage.php");
           }else{
  	echo "<div class='form'>
  <h3>Username/password is incorrect.</h3>
  </div>";
  	}
    }else{
  ?>

  <!-- End Header template -->

  <!-- Login form content -->
  <div id="login" class="font form">
    <h2>Login to your account</h2>
    <form id="myForm" onsubmit="return validateLogin()" method="post" action="searchPage.php">
      <input type="text" name="email" placeholder="email" required/>
      <span id="emailMissing" class="error-message">Valid email is required</span>
      <input type="password" name="password" placeholder="password" required/>
      <span id="passwordMissing" class="error-message">Valid password is required</span>
      <br><br>
      <input type="submit" onclick="validateLogin()" value="Login" />
    </form>
  </div>

  <!-- Footer template -->
  <footer class="footer font">
    <a>© 2018 Braydon Burn & Bertrand Dungan</a>
  </footer>
  <!-- End Footer template -->
<?php } ?>

</body>

</html>
