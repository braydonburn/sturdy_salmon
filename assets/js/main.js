
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

function myMap() {
  var myCenter = new google.maps.LatLng(-27.47091173, 153.0224598);
  var mapCanvas = document.getElementById("map");
  var mapOptions = {
    center: myCenter,
    zoom: 18
  };
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({
    position: myCenter
  });
  marker.setMap(map);
}

// Login validation function
// validates all relevant forms
function validateLogin() {
  validateEmail();
  validatePassword();
}

// Registration validation function
//validates all relevant forms
function validateRegistration() {
validateEmpty();
validateEmail();
validateDate();
validateCheckbox();
}

//Validates email using regex expressions
function validateEmail() {
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.forms["myForm"]["email"].value)) {
    return (true);
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
  if ((document.forms["myForm"]["password"].value) === "") {
    document.getElementById("passwordMissing").style.visibility = "visible";
    return (false);
  }
  return true;
}

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

//Various if statements to check if values are empty
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
    document.getElementById("passwordMissing").style.visibility = "visible";
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
