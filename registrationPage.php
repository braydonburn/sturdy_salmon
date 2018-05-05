<!DOCTYPE html>
<html lang="en">
<?php include('server.php') ?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Braydon Burn & Bertrand Dungan">
  <title>Register</title>
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
  require 'assets/php/functions.php';
  include 'errors.php';
  $errors = array();
  genHead();
  ?>
  <!-- End Header template -->

  <!-- Registration form content -->
  <div id="regoForm" class="font form registration">
    <form id="myForm" onchange="formChange()" onsubmit="return validateRegistration()"  method="post" action="registerConfirm.php">

      <h2>User registration</h2>
      <?php
      formGen($errors, 'text', 'fullName', 'Full Name', 'nameMissing', 'Valid name is required', '','');
      ?>
      <?php
      formGen($errors, 'text', 'username', 'Username', 'usernameMissing', 'Valid username is required', '', '');
      ?>
      <?php
      formGen($errors, 'email', 'email', 'example@email.com', 'emailMissing', 'Valid email is required', '', '');
      ?>
      <br>
      <h4>Birth Date</h4>
      <?php
      formGen($errors, 'text', 'day', 'Day', '', '', '2', '[0-9]{1,2}');
      ?>
      <?php
      dropdownList();
       ?>
      <?php
      formGen($errors, 'text', 'year', 'Year', 'dateMissing', 'Valid date is required', '4', '\d{4}');
      ?>
      <br>
      <?php
      formGen($errors, 'password', 'password', 'Password', 'passwordMissing', 'Valid password is required', '','');
       ?>
      <?php
      formGen($errors, 'password', 'confirmPassword', 'Confirm Password', 'confirmPass', 'Please confirm your passwords match', '', '');
       ?>
      <br>
      <input id="termsAndCond" type="checkbox" name="agree" title="Please agree to the terms and conditions" required>
      <label for="termsAndCond">I agree to the terms and conditions</label>
      <br>
      <input type="submit" value="Submit" onclick="validateRegistration()">
    </form>
  </div>

  <!-- Footer template -->
  <footer class="footer font">
    <a>© 2018 Braydon Burn & Bertrand Dungan</a>
  </footer>
  <!-- End Footer template -->
</body>

</html>
