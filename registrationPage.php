<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Register</title>
  <?php
  include('assets/php/functions.php');
  genMeta();
   ?>
</head>

<body>
  <!-- Header template -->
  <?php
  genHead();
  if (empty($_POST)) {
    $errors = array();
  }
  ?>
  <!-- End Header template -->

  <!-- Registration form content -->
  <div id='regoForm' class='font form registration'>
    <form id='myForm' onchange='formChange()' onsubmit='return validateRegistration()'  method='post' action='registerConfirm.php'>

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
