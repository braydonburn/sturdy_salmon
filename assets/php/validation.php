<?php
# This function will remove special characters and prevent cross scripting attacks
function sanitise($userPost) {
  return filter_var(stripslashes($userPost), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

# This function will run all of the other validation functions
function formValidate(&$errors, $postEmail, $postDay, $postMonth, $postYear,
$postFullName, $postUsername, $postPassword, $postConfirmPassword) {
  validateEmail($errors, sanitise($postEmail));
  dateValidate($errors, sanitise($postDay), sanitise($postMonth), sanitise($postYear));
  fullNameValidate($errors, sanitise($postFullName));
  userNameValidate($errors, sanitise($postUsername));
  passwordValidate($errors, sanitise($postPassword), sanitise($postConfirmPassword));
}

# This codes validates the email by checking if the field has been filled and
#if the email is in the proper format.
function validateEmail(&$errors, $emailValue) {
  if (!isset($emailValue) || empty($emailValue)) {
    $errors['emailMissing'] = 'Please enter your email';
  } elseif (!filter_var($emailValue, FILTER_VALIDATE_EMAIL)) {
    $errors['emailMissing'] = 'Please enter a valid email';
  } else {}
}

# This code validates the date. It checks if the fields have been filled, then
#it checks if the day is an integer which is less than 32 and greater than 1,
#then it checks if the month is one which is in the month list, and then it
#checks if the year is not in the future and is greater than 1900.
function dateValidate(&$errors, $day, $month, $year) {
  $monthList = ['1','2','3','4','5','6','7','8','9','10','11','12'];
  if ((!isset($day) || empty($day)) || (!isset($month) || empty($month)) ||
  (!isset($year) || empty($year))) {
    $errors['dateMissing'] = 'Please fill all date fields';
  } elseif ((!filter_var($day, FILTER_VALIDATE_INT) && ($day>31) && ($day<1)) ||
(!in_array($month, $monthList)) ||
((!filter_var($year, FILTER_VALIDATE_INT) && ($year>date("Y")) && ($year<1900)))) {
    $errors['dateMissing'] = 'Please enter a valid date';
  } else {}
}

# This code validates the person's name. It doesn't check anything apart from if
#it is empty because human naming conventions are inconsistent
function fullNameValidate(&$errors, $fullName) {
  if (!isset($fullName) || empty($fullName)) {
    $errors['nameMissing'] = 'Please enter your name';
  } else {}
}

# This code validates the username, it just checks if the username is empty
function userNameValidate(&$errors, $username) {
  if (!isset($username) || empty($username)) {
    $errors['usernameMissing'] = 'Please enter your username';
  } else {}
}

# This function validates the password by checking if the forms have been filled
# and check if the passwords match
function passwordValidate(&$errors, $password, $confirmPassword) {
  if ((!isset($password) || empty($password))) {
    $errors['passwordMissing'] = 'Please enter your password';
  } elseif (!isset($confirmPassword) || empty($confirmPassword)) {
    $errors['confirmPass'] = 'Please enter your password';
  } elseif ($password !== $confirmPassword) {
    $errors['confirmPass'] = 'Please confirm your passwords match';
  } else {}
}
?>
