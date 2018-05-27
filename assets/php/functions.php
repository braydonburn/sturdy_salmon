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

      echo '<li>The user currently logged in is: '.
      filter_var(stripslashes($_SESSION['username']),
      FILTER_SANITIZE_FULL_SPECIAL_CHARS).'</li>';
    } else {echo 'You are not currently logged in';}
    echo '</ul>
    </div>';
}

# This function generates the box where users can leave reviews if they are
#logged in
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

# This function creates the dropdown list for months echoes the last set value
function dropdownList(){
  $value = getFormValue('month');
  $monthList = array('January', 'February', 'March', 'April',
  'May', 'June', 'July', 'August', 'September', 'October', 'Nobember', 'December');
  echo '<select name="month" required>';
  if (!isset($value)) {
    echo '<option value="-1" disabled hidden>Select Month</option>';
  }
  $count=0;
  foreach ($monthList as $monthName) {
    $count+=1;
    if ($monthName === $value) {
      echo '<option value="'.$count.'" selected>'.$monthName.'</option>';
    } else {
      echo '<option value="'.$count.'">'.$monthName.'</option>';
    }
  }
  echo '</select>';
}

# This function generates the footer that appears on every page
function genFooter() {
  echo '<footer class="footer font">
      <a>© 2018 Braydon Burn & Bertrand Dungan</a>
    </footer>';
}

# This function generates the meta tags that go on every page
function genMeta() {
  echo "<meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='author' content='Braydon Burn and Bertrand Dungan'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='assets/css/main.css'>
  	<script src='assets/js/main.js'></script>
    <script defer src='https://use.fontawesome.com/releases/v5.0.9/js/all.js' integrity='sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl' crossorigin='anonymous'></script>
    <link href='https://fonts.googleapis.com/css?family=Work+Sans:400,600,700' rel='stylesheet'>
    <!-- Favicon -->
    <link rel='apple-touch-icon' sizes='180x180' href='assets/favicon/apple-touch-icon.png'>
    <link rel='icon' type='image/png' sizes='32x32' href='assets/favicon/favicon-32x32.png'>
    <link rel='icon' type='image/png' sizes='16x16' href='assets/favicon/favicon-16x16.png'>
    <link rel='manifest' href='assets/favicon/site.webmanifest'>
    <link rel='mask-icon' href='assets/favicon/safari-pinned-tab.svg' color='#5bbad5'>
    <link rel='apple-touch-icon' href='assets/favicon/apple-touch-icon.png'>
    <meta name='msapplication-TileColor' content='#da532c'>
    <meta name='theme-color' content='#ffffff'>";
}
?>
