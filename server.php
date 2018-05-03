<?php
//Host, username, password, database below.
$con = mysqli_connect("localhost","root","dreadman1","cab230");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
