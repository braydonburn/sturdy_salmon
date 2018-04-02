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

function validate() {
  validateEmail();
  validatePassword();
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
