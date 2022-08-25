<html>
<head>
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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
  list-style-type: none;
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
<form action="index.php" method="GET">
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
 $Cost = $_POST['Cost'];
 $Bin = $_POST['Bin'];
 $sqlinsert = "INSERT INTO Wines (WineName, Year, Vineyard, Grape, App, Cost, Bin) VALUES ('$WineName', '$Year', '$Vine', '$Grape', '$App', '$Cost', '$Bin')";
 $sqlinsertBackup = "INSERT INTO AllWines (WineName, Year, Vineyard, Grape, App, Cost, Review, Stars) VALUES ('$WineName', '$Year', '$Vine', '$Grape', '$App', '$Cost', '',0)";
 //echo $sqlinsert;
 if (!mysqli_query($conn,$sqlinsert)) {
  die('error inserting record');
 }
if (!mysqli_query($conn,$sqlinsertBackup)) {
  die('error inserting backup');
 }
}
if(isset($_POST['edit'])){
$WineName = $_POST['WineName'];
 $Year = $_POST['Year'];
 $Vine = $_POST['Vine'];
 $Grape = $_POST['Grape'];
 $App = $_POST['App'];
 $Cost = $_POST['Cost'];
 $Bin = $_POST['Bin'];
 $editNum= $_POST['rowEdit'];
 $edit1 = "UPDATE Wines SET WineName='$WineName' WHERE id=$editNum";
 $edit2="UPDATE Wines SET Year='$Year' WHERE id=$editNum";
 $edit3="UPDATE Wines SET Vineyard='$Vine' WHERE id=$editNum";
 $edit4="UPDATE Wines SET Grape='$Grape' WHERE id=$editNum";
 $edit5="UPDATE Wines SET App='$App' WHERE id=$editNum";
 $edit6="UPDATE Wines SET Cost='$Cost' WHERE id=$editNum";
 $edit7="UPDATE Wines SET Bin='$Bin' WHERE id=$editNum";
 $sqlEdit = mysqli_query($conn, $edit1) or die('error editing1');
 $sqlEdit = mysqli_query($conn, $edit2) or die('error editing2');
 $sqlEdit = mysqli_query($conn, $edit3) or die('error editing3');
$sqlEdit = mysqli_query($conn, $edit4) or die('error editing4');
$sqlEdit = mysqli_query($conn, $edit5) or die('error editing5');
$sqlEdit = mysqli_query($conn, $edit6) or die('error editing6');
$sqlEdit = mysqli_query($conn, $edit7) or die('error editing7');
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
 $add= "INSERT INTO DrankWines(WineName, Year, Vineyard, Grape, App,Cost, Stars, Review)
  SELECT WineName, Year, Vineyard, Grape, App, Cost, 0, ''
  FROM Wines WHERE id=$drink";
 $sqladd = mysqli_query($conn, $add) or die('error adding data');
 $delete= "DELETE FROM Wines WHERE id=$drink";
 $sqldelete = mysqli_query($conn, $delete) or die('error deleting data');
 $update = "ALTER TABLE Wines DROP COLUMN id";
 $update2= "ALTER TABLE Wines ADD id int NOT NULL AUTO_INCREMENT PRIMARY KEY";
 $sqlupdate = mysqli_query($conn, $update) or die('error updating');
 $sqlupdate2 = mysqli_query($conn, $update2) or die('error updating2');
}

if(isset($_POST['Edit'])){
 $WineName = $_POST['WineName'];
 $Year = $_POST['Year'];
 $Vineyard = $_POST['Vineyard'];
 $Grape = $_POST['Grape'];
 $App = $_POST['App'];
 $Cost = $_POST['Cost'];
 $Bin = $_POST['Bin'];
 $rowEdit=$_POST['rowEdit'];
?>

<div id='id02' class='modal'>
  <span onclick="document.getElementById('id02').style.display='none'" class='close' title='Close Modal'>&times;</span>
    <form class='modal-content' method='post' action='index.php'>
    <input type='hidden' name='edit' value='true' />
    <div class='container'>
<?php
echo "
      <label for='WineName'><b>Wine Name</b></label>
      <input type='text' name='WineName' value='$WineName'>

      <label for='Year'><b>Year</b></label>
      <input type='text' name='Year' value='$Year'>

      <label for='Vine'><b>Vineyard</b></label>
      <input type='text' name='Vine' value='$Vineyard'>

      <label for='Grape'><b>Grape</b></label>
      <input type='text' name='Grape' value='$Grape'>

      <label for='App'><b>Appellation</b></label>
      <input type='text' name='App' value='$App'>

      <label for='Cost'><b>Cost</b></label>
      <input type='text' name='Cost' value='$Cost'>

     <label for='Bin'><b>Bin</b></label>
      <input type='text' name='Bin' value='$Bin'>
      <input type='hidden' name='rowEdit' value='$rowEdit'>
";?>
      <div class='clearfix'>
        <button type='button' onclick="document.getElementById('id02').style.display='none'" class='cancelbtn'>Cancel</button>
        <button type='submit' class='signupbtn'>Confirm</button>
      </div>
    </div>
  </form>
</div>

<script>
// Get the modal
document.getElementById('id02').style.display='block';
var modal = document.getElementById('id02');
</script>
<?php
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
     
      <label for="Cost"><b>Cost</b></label>
      <input type="text" placeholder="Enter Cost" name="Cost" required>

     <label for="Bin"><b>Bin</b></label>
      <input type="text" placeholder="Enter Bin" name="Bin" required>

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
include('connect.php');
// For extra protection these are the columns of which the user can sort by (in your database table).
$columns = array('WineName','Year','Vineyard', 'Grape','App','Cost','Bin');

// Only get the column if it exists in the above columns array, if it doesn't exist the database table will be sorted by the first item in the columns array.
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Get the sort order for the column, ascending or descending, default is ascending.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

// Get the result...
$sqlget= 'SELECT * FROM Wines ORDER BY ' .  $column . ' ' . $sort_order;
if (!empty($_REQUEST['search'])){
 $term = $_GET['search'];
 $sqlget = "SELECT * FROM Wines WHERE WineName LIKE '%".$term."%' or Year LIKE '%".$term."%'  or Vineyard LIKE '%".$term."%'  or Grape LIKE '%".$term."%' or App LIKE '%".$term."%' or Bin LIKE '%".$term."%'";
}

if($result=mysqli_query($conn, $sqlget)){

//if ($result = $conn->query('SELECT * FROM Wines ORDER BY ' .  $column . ' ' . $sort_order)) {
	// Some variables we need for the table.
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
	$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
	$add_class = ' class="highlight"';
	?>
<style>
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
</style>
<table>
	<tr>
		<th><a href="index.php?column=WineName&order=<?php echo $asc_or_desc; ?>">Wine Name<i class="fas fa-sort<?php echo $column == 'WineName' ? '-' . $up_or_down : ''; ?>"></i></a></th>
		<th><a href="index.php?column=Year&order=<?php echo $asc_or_desc; ?>">Year<i class="fas fa-sort<?php echo $column == 'Year' ? '-' . $up_or_down : ''; ?>"></i></a></th>
		<th><a href="index.php?column=Vineyard&order=<?php echo $asc_or_desc; ?>">Vineyard<i class="fas fa-sort<?php echo $column == 'Vineyard' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                <th><a href="index.php?column=Grape&order=<?php echo $asc_or_desc; ?>">Grape<i class="fas fa-sort<?php echo $column == 'Grape' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                <th><a href="index.php?column=App&order=<?php echo $asc_or_desc; ?>">Appelation<i class="fas fa-sort<?php echo $column == 'App' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                <th><a href="index.php?column=Cost&order=<?php echo $asc_or_desc; ?>">Cost<i class="fas fa-sort<?php echo $column == 'Cost' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                <th><a href="index.php?column=Bin&order=<?php echo $asc_or_desc; ?>">Bin<i class="fas fa-sort<?php echo $column == 'Bin' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                <th>Options</th>
	</tr>
<?php while ($row = $result->fetch_assoc()): ?>
	<tr>
		<td<?php echo $column == 'WineName' ? $add_class : ''; ?>><?php echo $row['WineName']; ?></td>
		<td<?php echo $column == 'Year' ? $add_class : ''; ?>><?php echo $row['Year']; ?></td>
		<td<?php echo $column == 'Vineyard' ? $add_class : ''; ?>><?php echo $row['Vineyard']; ?></td>
                <td<?php echo $column == 'Grape' ? $add_class : ''; ?>><?php echo $row['Grape']; ?></td>
                <td<?php echo $column == 'App' ? $add_class : ''; ?>><?php echo $row['App']; ?></td>
                <td<?php echo $column == 'Cost' ? $add_class : ''; ?>><?php echo $row['Cost']; ?></td>
                <td<?php echo $column == 'Bin' ? $add_class : ''; ?>><?php echo $row['Bin']; ?></td>
<?php
echo "<td>
	<form method='post'>
    <input type='hidden' id='drink' name='drink' value=$row[id]>
    <input type='submit' class='button' name='Drank' value='Drank' />
    <input type='hidden' id='rowDelete' name='rowDelete' value=$row[id]>
    <input type='submit' name='Delete' value='Delete' />
    <input type='hidden' id='rowEdit' name='rowEdit' value='$row[id]'>
    <input type='hidden' id='WineName' name='WineName' value='$row[WineName]'>
    <input type='hidden' id='Year' name='Year' value='$row[Year]'>
    <input type='hidden' id='Vineyard' name='Vineyard' value='$row[Vineyard]'>
    <input type='hidden' id='Grape' name='Grape' value='$row[Grape]'>
    <input type='hidden' id='App' name='App' value='$row[App]'>
    <input type='hidden' id='Cost' name='Cost' value='$row[Cost]'>
    <input type='hidden' id='Bin' name='Bin' value='$row[Bin]'>
    <input type='submit' name='Edit' value='Edit' />
</form>";
?>
<!--/*
<button onclick="openForm()" style='width:auto;'>Edit</button>

<div id='id02' class='modal'>
  <span onclick="document.getElementById('id02').style.display='none'" class='close' title='Close Modal'>&times;</span>
    <form class='modal-content' method='post' action='index.php'>
    <input type='hidden' name='edit' value='true' />
    <div class='container'>
<?php
echo "
      <label for='WineName'><b>Wine Name</b></label>
      <input type='text' name='WineName' value='$row[WineName]'>

      <label for='Year'><b>Year</b></label>
      <input type='text' name='Year' value='$row[Year]'>

      <label for='Vine'><b>Vineyard</b></label>
      <input type='text' name='Vine' value='$row[Vineyard]'>

      <label for='Grape'><b>Grape</b></label>
      <input type='text' name='Grape' value='$row[Grape]'>

      <label for='App'><b>Appellation</b></label>
      <input type='text' name='App' value='$row[App]'>

      <label for='Cost'><b>Cost</b></label>
      <input type='text' name='Cost' value='$row[Cost]'>

     <label for='Bin'><b>Bin</b></label>
      <input type='text' name='Bin' value='$row[Bin]'>
";?>
      <div class='clearfix'>
        <button type='button' onclick="document.getElementById('id02').style.display='none'" class='cancelbtn'>Cancel</button>
        <button type='submit' class='signupbtn'>Confirm</button>
      </div>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id02');
function openForm() {
 document.getElementById('id02').style.display='block';
}
</script>
*/--!>
 </td>

	</tr>
	<?php endwhile; ?>
			</table>
	<?php
	$result->free();
}
?>
<!--
/*
<?php
//Displays the sql table
include('connect.php');
$sqlget= "SELECT * FROM Wines";
if (!empty($_REQUEST['search'])){
 $term = $_GET['search'];
 $sqlget = "SELECT * FROM Wines WHERE WineName LIKE '%".$term."%' or Year LIKE '%".$term."%'  or Vineyard LIKE '%".$term."%'  or Grape LIKE '%".$term."%' or App LIKE '%".$term."%'";
}
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
echo "<tr><th>Wine Name</th><th>Year</th><th>Vineyard</th><th>Grape</th><th>Appellation</th><th>Cost</th><th>Bin</th><th>Options</th></tr>";
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
echo "</td><td>";
echo "<li>$</li>";
echo $row['Cost'];
echo "</td><td>";
echo $row['Bin'];
echo "</td>
<td>
<form method='post'>
    <input type='hidden' id='drink' name='drink' value=$row[id]>
    <input type='submit' class='button' name='Drank' value='Drank' />
    <input type='hidden' id='rowDelete' name='rowDelete' value=$row[id]>
    <input type='submit' name='Delete' value='Delete' />
</form>
</td>
</tr>";
}

echo "</table>";

?>
*/
-->

</body>
</html>
