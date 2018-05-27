<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <meta name='author' content='Braydon Burn & Bertrand Dungan'>
  <title>Register</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel='stylesheet' href='assets/css/main.css'>
  <script src='assets/js/main.js'></script>
  <link href='https://fonts.googleapis.com/css?family=Work+Sans:400,600,700' rel='stylesheet'>

  <!-- Favicon -->
  <link rel='apple-touch-icon' sizes='180x180' href='assets/favicon/apple-touch-icon.png'>
  <link rel='icon' type='image/png' sizes='32x32' href='assets/favicon/favicon-32x32.png'>
  <link rel='icon' type='image/png' sizes='16x16' href='assets/favicon/favicon-16x16.png'>
  <link rel='manifest' href='assets/favicon/site.webmanifest'>
  <link rel='mask-icon' href='assets/favicon/safari-pinned-tab.svg' color='#5bbad5'>
  <meta name='msapplication-TileColor' content='#da532c'>
  <meta name='theme-color' content='#ffffff'>
</head>

<body>
  <!-- Header template -->
  <?php
  require 'assets/php/functions.php';
  genHead();
  if (empty($_POST)) {
    $errors = array();
  }
  ?>
  <!-- End Header template -->

  <!-- Registration form content -->
  <div id='regoForm' class='font form registration'>
    <form id='myForm' onchange='formChange()' onsubmit='return validateRegistration()'  method='post' action='registerConfirm.php' novalidate>

      <h2>User registration</h2>
      <?php
      formGen('text', 'fullName', 'Full Name', 'nameMissing', $errors, '','');
      ?>
      <?php
      formGen('text', 'username', 'Username', 'usernameMissing', $errors, '', '');
      ?>
      <?php
      formGen('email', 'email', 'example@email.com', 'emailMissing', $errors, '', '');
      ?>
      <br>
      <h4>Birth Date</h4>
      <?php
      formGen('text', 'day', 'Day', '', '', '2', '[0-9]{1,2}');
      ?>
      <?php
      dropdownList();
       ?>
      <?php
      formGen('text', 'year', 'Year', 'dateMissing', $errors, '4', '\d{4}');
      ?>
      <br>
      <?php
      formGen('password', 'password', 'Password', 'passwordMissing', $errors, '','');
       ?>
      <?php
      formGen('password', 'confirmPassword', 'Confirm Password', 'confirmPass', $errors, '', '');
       ?>
      <br>
      <input id='termsAndCond' type='checkbox' name='agree' title='Please agree to the terms and conditions' required>
      <label for='termsAndCond'>I agree to the terms and conditions</label>
      <br>
      <input type='submit' value='Submit' onclick='validateRegistration()'>
    </form>
  </div>

  <!-- Footer template -->
  <?php
    genFooter();
   ?>
  <!-- End Footer template -->
</body>
</html>
