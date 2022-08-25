<html>
<head>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.checked {
  color: orange;
}

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
  <li><a href="index.php">Wines</a></li>
  <li><a class="active" href="drank.php">Drank Wines</a></li>
 </ul>
 <h1> Wine Inventory </h1>
<form action="drank.php" method="GET">
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
 $sqlinsert = "INSERT INTO DrankWines (WineName, Year, Vineyard, Grape, App, Cost, Stars, Review) VALUES ('$WineName', '$Year', '$Vine', '$Grape', '$App','$Cost', 0, '')";
 $sqlinsertBackup = "INSERT INTO AllWines (WineName, Year, Vineyard, Grape, App, Cost, Review, Stars) VALUES ('$WineName', '$Year', '$Vine', '$Grape', '$App','$Cost', '', 0)";
 //echo $sqlinsert;
 if (!mysqli_query($conn,$sqlinsert)) {
  die('error inserting record');
 }
 if (!mysqli_query($conn,$sqlinsertBackup)) {
  die('error inserting backup');
 }

}
if(isset($_POST['Delete'])){
 $rowDelete =$_POST['rowDelete'];
 $delete= "DELETE FROM DrankWines WHERE id=$rowDelete";
 $sqldelete = mysqli_query($conn, $delete) or die('error deleting data');
 $update = "ALTER TABLE DrankWines DROP COLUMN id";
 $update2= "ALTER TABLE DrankWines ADD id int NOT NULL AUTO_INCREMENT PRIMARY KEY";
 $sqlupdate = mysqli_query($conn, $update) or die('error updating');
 $sqlupdate2 = mysqli_query($conn, $update2) or die('error updating2');
}
if (isset($_POST['review'])){
 $review=$_POST['review'];
 $row=$_POST['row'];
 $sqlreview = "UPDATE DrankWines SET Review ='$review' WHERE id='$row'";
 $sqlre = mysqli_query($conn, $sqlreview) or die('error review');
}
if (isset($_POST['stars'])){
 $star=$_POST['stars'];
 $rowstar=$_POST['rowstar'];
 $sqlstars = "UPDATE DrankWines SET Stars =$star WHERE id=$rowstar";
 $sqlst = mysqli_query($conn, $sqlstars) or die('error stars');
}

?>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Add Wine</button>

<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    <form class="modal-content" method="post" action="drank.php">
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
$columns = array('WineName','Year','Vineyard', 'Grape','App','Cost');

// Only get the column if it exists in the above columns array, if it doesn't exist the database table will be sorted by the first item in the columns array.
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Get the sort order for the column, ascending or descending, default is ascending.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

// Get the result...
$sqlget= 'SELECT * FROM DrankWines ORDER BY ' .  $column . ' ' . $sort_order;
if (!empty($_REQUEST['search'])){
 $term = $_GET['search'];
 $sqlget = "SELECT * FROM DrankWines WHERE WineName LIKE '%".$term."%' or Year LIKE '%".$term."%'  or Vineyard LIKE '%".$term."%'  or Grape LIKE '%".$term."%' or App LIKE '%".$term."%'";
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
                <th><a href="drank.php?column=WineName&order=<?php echo $asc_or_desc; ?>">Wine Name<i class="fas fa-sort<?php echo $column == 'WineName' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                <th><a href="drank.php?column=Year&order=<?php echo $asc_or_desc; ?>">Year<i class="fas fa-sort<?php echo $column == 'Year' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                <th><a href="drank.php?column=Vineyard&order=<?php echo $asc_or_desc; ?>">Vineyard<i class="fas fa-sort<?php echo $column == 'Vineyard' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                <th><a href="drank.php?column=Grape&order=<?php echo $asc_or_desc; ?>">Grape<i class="fas fa-sort<?php echo $column == 'Grape' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                <th><a href="drank.php?column=App&order=<?php echo $asc_or_desc; ?>">Appelation<i class="fas fa-sort<?php echo $column == 'App' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                <th><a href="drank.php?column=Cost&order=<?php echo $asc_or_desc; ?>">Cost<i class="fas fa-sort<?php echo $column == 'Cost' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                <th>Review</th>
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
<?php
echo "</td><td>
<form  method='post'>
  <label>Review:</label><br>
<textarea rows='3' cols='25' name='review' id='review'>$row[Review]</textarea><br>
 <input type='hidden' id='row' name='row' value=$row[id]>
 <input type='submit' name='Submit' value='Submit'>
</form>

<form method='post'>
 <lable for='stars'>Rating:</label>
 <input type='number' id='stars' name='stars' min='0' max='5' value=$row[Stars]>
 <input type='submit'> 
 <input type='hidden' id='rowstar' name='rowstar' value=$row[id]>
</form>
 <br>";
if ($row['Stars']==5){
echo "<span class='fa fa-star checked'></span>
<span class='fa fa-star checked'></span>
<span class='fa fa-star checked'></span>
<span class='fa fa-star checked'></span>
<span class='fa fa-star checked'></span>
";
}
if ($row['Stars']==4){
echo "<span class='fa fa-star checked'></span>
<span class='fa fa-star checked'></span>
<span class='fa fa-star checked'></span>
<span class='fa fa-star checked'></span>
<span class='fa fa-star'></span>
";
}
if ($row['Stars']==3){
echo "<span class='fa fa-star checked'></span>
<span class='fa fa-star checked'></span>
<span class='fa fa-star checked'></span>
<span class='fa fa-star'></span>
<span class='fa fa-star'></span>
";
}
if ($row['Stars']==2){
echo "<span class='fa fa-star checked'></span>
<span class='fa fa-star checked'></span>
<span class='fa fa-star'></span>
<span class='fa fa-star'></span>
<span class='fa fa-star'></span>
";
}
if ($row['Stars']==1){
echo "<span class='fa fa-star checked'></span>
<span class='fa fa-star'></span>
<span class='fa fa-star'></span>
<span class='fa fa-star'></span>
<span class='fa fa-star'></span>
";
}
if ($row['Stars']==0){
echo "<span class='fa fa-star'></span>
<span class='fa fa-star'></span>
<span class='fa fa-star'></span>
<span class='fa fa-star'></span>
<span class='fa fa-star'></span>
";
}

echo "<td>
        <form method='post'>
    <input type='hidden' id='rowDelete' name='rowDelete' value=$row[id]>
    <input type='submit' name='Delete' value='Delete' />
</form>
</td>";
?>

        </tr>
        <?php endwhile; ?>
                        </table>
        <?php
        $result->free();
}
?>

<!--
<?php
//Displays the sql table
include('connect.php');
$sqlget = "SELECT * FROM DrankWines";
if (!empty($_REQUEST['search'])){
 $term = $_GET['search'];
 $sqlget = "SELECT * FROM DrankWines WHERE WineName LIKE '%".$term."%' or Year LIKE '%".$term."%'  or Vineyard LIKE '%".$term."%'  or Grape LIKE '%".$term."%' or App LIKE '%".$term."%' or Review LIKE '%".$term."%'";
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

</style>";

echo "<table>";
echo "<tr><th>Wine Name</th><th>Year</th><th>Vineyard</th><th>Grape</th><th>Appellation</th><th>Cost</th><th>Review</th><th>Options</th></tr>";
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
echo "</td><td>
<form action='drank.php' method='post'>
  <label>Review:</label><br>
<textarea rows='3' cols='25' name='review' id='review'>$row[Review]</textarea><br>
 <input type='hidden' id='row' name='row' value=$row[id]>
 <input type='submit' name='Submit' value='Submit'>
</form>
 ";
echo "</td>
<td>
<form method='post'>
    <input type='hidden' id='row' name='rowDelete' value=$row[id]>
    <input type='submit' name='Delete' value='Delete' />
</form>
</td>
</tr>";
}

echo "</table>";

?>
-->

</body>
</html>
