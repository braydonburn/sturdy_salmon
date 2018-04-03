function getLocation() {
  errorDisplay = document.getElementById("status");
  searchField = document.getElementById("addressSearch");
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    errorDisplay.innerHTML = "Geolocation is unavailable";
  }
  function showPosition(position) {
    searchField.value = position.coords.latitude + " " + position.coords.longitude;
  }
}

function validateLogin() {
  validateEmail();
  validatePassword();
}

function validateRegistration() {
  validateEmpty();
  validateEmail();
  validateDate();
}


function validateEmail() {
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.forms["myForm"]["email"].value)) {
    return(true);
  }
  document.getElementById("emailMissing").style.visibility = "visible";
  return false;
}

function validatePassword() {
  if ((document.forms["myForm"]["password"].value) === "") {
    document.getElementById("passwordMissing").style.visibility = "visible";
    return(false);
  }
  return true;
}

function validateDate() {
  var x = true;
  var day = document.forms["myForm"]["day"].value;
  var year = document.forms["myForm"]["year"].value;
  if ((isNaN(day)) || (day > 31) || (day <= 0) || (isNaN(year)) || (year > 2018) || (year < 1900)) {
    document.getElementById("dateMissing").style.visibility = "visible";
    x = false;
  }
}

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
