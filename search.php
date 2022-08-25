<html>
<head>
 <style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: #4CAF50;
}
</style>
 <title> Wine Inventory </title>
</head>
<body>
 <ul>
  <li><a class="active" href="index.php">Wines</a></li>
  <li><a href="drank.php">Drank Wines</a></li>
 </ul>
 <h1> Wine Inventory </h1>
<form action="search.php">
  <label for="search">Search:</label>
  <input type="search" id="search" name="search">
  <input type="submit">
 </form>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}
/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

/* Add a background color when the inputs get focus */
input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: #474e5d;
  padding-top: 50px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}
 
/* The Close Button (x) */
.close {
  position: absolute;
  right: 35px;
  top: 15px;
  font-size: 40px;
  font-weight: bold;
  color: #f1f1f1;
}

.close:hover,
.close:focus {
  color: #f44336;
  cursor: pointer;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>
<body>

<?php
include('connect.php');
if (isset($_POST['submitted'])) {
 $WineName = $_POST['WineName'];
 $Year = $_POST['Year'];
 $Vine = $_POST['Vine'];
 $Grape = $_POST['Grape'];
 $App = $_POST['App'];
 $sqlinsert = "INSERT INTO Wines (WineName, Year, Vineyard, Grape, App) VALUES ('$WineName', '$Year', '$Vine', '$Grape', '$App')";
 //echo $sqlinsert;
 if (!mysqli_query($conn,$sqlinsert)) {
  die('error inserting record');
 }
}
if(isset($_POST['Delete'])){
 $rowDelete =$_POST['rowDelete'];
 $delete= "DELETE FROM Wines WHERE id=$rowDelete";
 $sqldelete = mysqli_query($conn, $delete) or die('error deleting data');
 $update = "ALTER TABLE Wines DROP COLUMN id";
 $update2= "ALTER TABLE Wines ADD id int NOT NULL AUTO_INCREMENT PRIMARY KEY";
 $sqlupdate = mysqli_query($conn, $update) or die('error updating');
 $sqlupdate2 = mysqli_query($conn, $update2) or die('error updating2');
}
if(isset($_POST['Drank'])){
 $drink =$_POST['drink'];
 $add= "INSERT INTO DrankWines(WineName, Year, Vineyard, Grape, App)
  SELECT WineName, Year, Vineyard, Grape, App
  FROM Wines WHERE id=$drink";
 $sqladd = mysqli_query($conn, $add) or die('error adding data');
 $delete= "DELETE FROM Wines WHERE id=$drink";
 $sqldelete = mysqli_query($conn, $delete) or die('error deleting data');
 $update = "ALTER TABLE Wines DROP COLUMN id";
 $update2= "ALTER TABLE Wines ADD id int NOT NULL AUTO_INCREMENT PRIMARY KEY";
 $sqlupdate = mysqli_query($conn, $update) or die('error updating');
 $sqlupdate2 = mysqli_query($conn, $update2) or die('error updating2');
}


?>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Add Wine</button>

<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    <form class="modal-content" method="post" action="index.php">
    <input type="hidden" name="submitted" value="true" />
    <div class="container">
      
      <label for="WineName"><b>Wine Name</b></label>
      <input type="text" placeholder="Enter Wine Name" name="WineName" required>

      <label for="Year"><b>Year</b></label>
      <input type="text" placeholder="Enter Year" name="Year" required>
      
      <label for="Vine"><b>Vineyard</b></label>
      <input type="text" placeholder="Enter Vineyard" name="Vine" required>
      
      <label for="Grape"><b>Grape</b></label>
      <input type="text" placeholder="Enter Grape" name="Grape" required>
      
      <label for="App"><b>Appellation</b></label>
      <input type="text" placeholder="Enter Appellation" name="App" required>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Add Wine</button>
      </div>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');
</script>
<?php
//Displays the sql table
include('connect.php');
$sqlget = "SELECT * FROM Wines";
$sqldata = mysqli_query($conn, $sqlget) or die('error getting data');

echo "<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>";

echo "<table>";
echo "<tr><th>Wine Name</th><th>Year</th><th>Vineyard</th><th>Grape</th><th>Appellation</th><th>Options</th></tr>";
while($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)){
echo "<tr><td>";
echo $row['WineName'];
echo "</td><td>";
echo $row['Year'];
echo "</td><td>";
echo $row['Vineyard'];
echo "</td><td>";
echo $row['Grape'];
echo "</td><td>";
echo $row['App'];
echo "</td>
<td>
<form method='post'>
    <input type='checkbox' id='drink' name='drink' value=$row[id]>
    <input type='submit' class='button' name='Drank' value='Drank' />
    <input type='checkbox' id='row' name='rowDelete' value=$row[id]>
    <input type='submit' name='Delete' value='Delete' />
</form>
</td>
</tr>";
}

echo "</table>";

?>


</body>
</html>
