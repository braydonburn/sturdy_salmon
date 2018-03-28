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
