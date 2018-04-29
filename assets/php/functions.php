<?php
function genHead() {
  echo '<div id="header" class="header font">
      <ul>
        <!-- NavLinks -->
        <li><a class="';
  if (basename($_SERVER['PHP_SELF']) === "index.php") {
    echo 'active';
  }
  echo '" href="index.php">Home</a></li>
        <li><a class="';
  if (basename($_SERVER['PHP_SELF']) === "registrationPage.php") {
    echo 'active';
  }
  echo '" href="registrationPage.php">Register</a></li>
        <li><a class="';
  if (basename($_SERVER['PHP_SELF']) === "loginPage.php") {
    echo 'active';
  }
    echo '" href="loginPage.php">Login</a></li>
        <li><a class="';
  if (basename($_SERVER['PHP_SELF']) === "searchPage.php" ||
   basename($_SERVER['PHP_SELF']) === "individualResults.php" ||
    basename($_SERVER['PHP_SELF']) === "resultsPage.php") {
    echo 'active';
  }
    echo '" href="searchPage.php">Search</a></li>
        <!-- NavLinks -->
      </ul>
    </div>';
}
?>
