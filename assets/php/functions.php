<?php
session_start();
#This function generates the headers that appear on each page and changes which
#one looks liked it is selected based on which page the user is on
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
        <!-- NavLinks -->';
    if (isset($_SESSION['username'])) {
      echo '<li><a href="logout.php">Logout</a></li>';
      echo '<li>The user currently logged in is: '.$_SESSION['username'].'</li>';
    } else {echo 'You are not currently logged in';}
    echo '</ul>
    </div>';
}

function showReviewBox() {
  if (isset($_SESSION['username'])) {
    echo "<div class='review-right'>
      <div class='font review'>
        <h3>Leave a review</h3>
        <select name='rating'>
          <option value='1'>1 Star</option>
          <option value='2'>2 Stars</option>
          <option value='3'>3 Stars</option>
          <option value='4'>4 Stars</option>
          <option value='5'>5 Stars</option>
        </select>
        <input name='id' type='hidden' value=".$_GET['id']."/>
        <textarea name='comment' cols='40' rows='10'></textarea>
        <input type='submit' value='Submit'>
      </div>
    </div>";
  } else {echo '';}
}

# This sanitises data imputs to avoid cross scripting attacks
function getFormValue($name) {
  if(isset($_POST[$name])) {
    return htmlspecialchars(stripslashes($_POST[$name]));
  }
}

# This generates appropriate forms based on the input and the error messages if set
function formGen($type, $name, $placeholderText, $errorID,
$errors, $maxLength, $pattern) {
  $value = getFormValue($name);
  echo '<input type="'.$type.'" name="'.$name.'" placeholder="'.$placeholderText
  .'" value="'.$value;
  # This checks if the max length or pattern variables are set, it will only
  #echo them if they are given in the input
  if(strlen($maxLength)>0) {
    echo '" maxlength="'.$maxLength;
  }
  if(strlen($pattern)>0) {
    echo '" pattern="'.$pattern;
  }
  echo '" required>';
  if(strlen($errorID)>0 && isset($errors[$errorID])) {
    echo '<span id="'.$errorID.'" class="error-message">'.$errors[$errorID].'</span>';
  }
}

# This function creates the dropdown list and echoes the last set value
function dropdownList(){
  $value = getFormValue('month');
  $monthList = array('January', 'February', 'March', 'April',
  'May', 'June', 'July', 'August', 'September', 'October', 'Nobember', 'December');
  echo '<select name="month" required>';
  if (!isset($value)) {
    echo '<option value="-1" disabled hidden>Select Month</option>';
  }
  foreach ($monthList as $monthName) {
    if ($monthName === $value) {
      echo '<option value="'.$monthName.'" selected>'.$monthName.'</option>';
    } else {
      echo '<option value="'.$monthName.'">'.$monthName.'</option>';
    }
  }
  echo '</select>';
}
?>
