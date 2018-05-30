<!-- Header template -->
  <?php
  include 'assets/php/functions.php';
  require 'assets/php/validation.php';
  genMetaAndHeader('Login');
   ?>
<!-- End Header template -->

  <!-- Login form content
  In this section the login forms are generated. If values have been entered
  then they will be put into the forms whenever the page is reloaded, to stop
  the user from having to refill forms
  -->
  <div id='login' class='font form'>
    <h2>Login to your account</h2>
    <form id='myForm' name='login' method='post' action=''>
      <input type='text' name='username' placeholder='username'
      <?php if (isset($username) && !empty($username)) {
        echo 'value='.sanitise($username);
      } ?>
      required/>
      <input type='password' name='password' placeholder='password'
      <?php if (isset($password) && !empty($password)) {
        echo 'value='.sanitise($password);
      }?>
      required/>
      <span id='passwordMissing' class='error-message'>
        <?php if (isset($errors) && !empty($errors)) {
          echo $errors;
        } ?>
      </span>
      <input name='submit' type='submit' value='Login' />
    </form>
  </div>

  <!-- Footer template -->
<?php
  genFooter();
 ?>
  <!-- End Footer template -->
