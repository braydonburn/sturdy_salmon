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

# This checks if forms already have data in them
function getFormValue($name) {
  if(isset($_POST[$name])) {
    return htmlspecialchars(stripslashes($_POST[$name]));
  }
}

# This generates appropriate forms based on the input and the error messages if set
function formGen($errors, $type, $name, $placeholderText, $errorID,
$errorMessage, $maxLength, $pattern) {
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
  if(strlen($errorID)>0) {
    echo '<span id="'.$errorID.'" class="error-message">'.$errorMessage.'</span>';
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
