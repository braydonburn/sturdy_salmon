//On page open, show spinner until page is loaded
function ready(callback) {
  // in case the document is already rendered
  if (document.readyState != 'loading') callback();
  // modern browsers
  else if (document.addEventListener) document.addEventListener('DOMContentLoaded', callback);
  // IE <= 8
  else document.attachEvent('onreadystatechange', function() {
    if (document.readyState == 'complete') callback();
  });
}

ready(function() {
  var element = document.getElementById("overlay");
  if (element != null) {
    element.parentNode.removeChild(element);
  }
});

// Geolocation code
function getLocation() {
  errorDisplay = document.getElementById("status");
  searchField = document.getElementById("addressSearch");
  // This will check if geolocation is available and display an error if not
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    errorDisplay.innerHTML = "Geolocation is unavailable";
  }
  // If geolocation is available, this will display current cordinates
  function showPosition(position) {
    searchField.value = position.coords.latitude + " " + position.coords.longitude;
  }
}

// Registration validation function
//validates all relevant forms and returns true if all forms are correctly filled
function validateRegistration() {
  x = true;
  if (!(validateEmpty())) {
    x = false;
  }
  if (!(validateEmail())) {
    x = false;
  }
  if (!(validateDate())) {
    x = false;
  }
  if (!(validateCheckbox())) {
    x = false;
  }
  if (!(validatePassword())) {
    x = false;
  }
  return x;
}

//Validates email using regex expressions
function validateEmail() {
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.forms["myForm"]["email"].value)) {
    return true;
  }
  //Displays error message if test fails
  document.getElementById("emailMissing").style.visibility = "visible";
  return false;
}

//Check if checkbox is checked, else return true
function validateCheckbox() {
  var y = document.forms["myForm"]["agree"].checked;
  if (y === false) {
    alert("Oops! You forgot to agree to the terms and conditions.");
    return false;
  } else {
    return true;
  }
}

//Checks if password is empty, displays error if not
function validatePassword() {
  if ((document.forms["myForm"]["password"].value) === (document.forms["myForm"]["confirmPassword"].value)) {
    return true;
  }
  document.getElementById("confirmPass").style.visibility = "visible";
  return false;
}

//Checks the date is within normal boundries and shows an error if it is not
function validateDate() {
  var x = true;
  var day = document.forms["myForm"]["day"].value;
  var year = document.forms["myForm"]["year"].value;
  //Uses if or statements to get if date is correct
  if ((isNaN(day)) || (day > 31) || (day <= 0) || (isNaN(year)) || (year > 2018) || (year < 1900)) {
    document.getElementById("dateMissing").style.visibility = "visible";
    x = false;
  } else {
    return true;
  }
}

//Various if statements to check if values are empty and shows an error if they are
function validateEmpty() {
  var x = true;
  if ((document.forms["myForm"]["fullName"].value) === "") {
    document.getElementById("nameMissing").style.visibility = "visible";
    x = false;
  }
  if ((document.forms["myForm"]["month"].value) === "") {
    document.getElementById("dateMissing").style.visibility = "visible";
    x = false;
  }
  if ((document.forms["myForm"]["password"].value) === "") {
    document.getElementById("passwordMissing").style.visibility = "visible";
    x = false;
  }
  if ((document.forms["myForm"]["confirmPassword"].value) === "") {
    document.getElementById("confirmPass").style.visibility = "visible";
    x = false;
  }
  if ((document.forms["myForm"]["day"].value) === "") {
    document.getElementById("dateMissing").style.visibility = "visible";
    x = false;
  }
  if ((document.forms["myForm"]["year"].value) === "") {
    document.getElementById("dateMissing").style.visibility = "visible";
    x = false;
  }
  if ((document.forms["myForm"]["username"].value) === "") {
    document.getElementById("usernameMissing").style.visibility = "visible";
    x = false;
  }
  if (x) {
    return true;
  } else {
    return false;
  }
}

//These statements check if text has been changed to be correct, if it has then
//the error message is changed. It only revalidates forms which have error
//messages. To do this it first checks if the error message exists.
function formChange() {
  if (document.getElementById("nameMissing")!==null) {
    if ((document.forms["myForm"]["fullName"].value) != "") {
      document.getElementById("nameMissing").style.visibility = "hidden";
    }}

  if (document.getElementById("dateMissing")!==null) {
    if ((document.forms["myForm"]["month"].value) != "") {
    document.getElementById("dateMissing").style.visibility = "hidden";
  }}

  if (document.getElementById("passwordMissing")!==null){
    if ((document.forms["myForm"]["password"].value) != "") {
    document.getElementById("passwordMissing").style.visibility = "hidden";
  }}

  if (document.getElementById("confirmPass")!==null){
    if (validatePassword()) {
    document.getElementById("confirmPass").style.visibility = "hidden";
  }}

  if (document.getElementById("dateMissing")!==null){
    if (validateDate()) {
    document.getElementById("dateMissing").style.visibility = "hidden";
  }}

  if (document.getElementById("usernameMissing")!==null){
    if ((document.forms["myForm"]["username"].value) != "") {
      document.getElementById("usernameMissing").style.visibility = "hidden";
    }}

  if (document.getElementById("emailMissing")!==null){
    if (validateEmail()) {
      document.getElementById("emailMissing").style.visibility = "hidden";
    } else {
      document.getElementById("emailMissing").style.visibility = "visible";
    }
  }
}
