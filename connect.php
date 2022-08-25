<?php
DEFINE ('servername', 'localhost');
DEFINE ('username',  "user");
DEFINE ('password', "winecellar");
DEFINE ('dbname', "wine");
// Create connection
$conn = mysqli_connect(servername, username, password, dbname);
// Check connection
if (!$conn) {
  die("Connection failed");
}
//echo 'you connected';
?>
