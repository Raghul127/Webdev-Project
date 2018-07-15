
<!DOCTYPE html>

<html>

<head>

<title>View My Reviews</title>
</head>

<body>


<?php
if(!isset($_SESSION)){ 
    session_start(); 
}

if(!isset($_SESSION["username"])){
  header('Location: login.php');
  exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$username = $_SESSION["username"];


$sql = "SELECT * FROM data WHERE username='$username' ";
   $result = $conn->query($sql);


if ($result->num_rows > 0) {

echo "MY REVIEWS<br><br>";

echo "<table border='1' cellpadding='10'>";

echo "<tr>  <th>Place</th> <th>My Review</th> <th>Likes</th> <th></th> </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // echo out the contents of each row into a table

echo "<tr>";


echo '<td>' . $row['place'] . '</td>';

echo '<td>' . $row['descr'] . '</td>';

echo '<td>' . $row['likes'] . '</td>';

echo '<td><a href="edit.php?id=' . $row['id'] . '">Edit</a></td>';

echo "</tr>";
    }}
     else {
    echo "0 results";
}

$conn->close();

// close table>

echo "</table>";
?>
<br>

<p style="color: black;"><a href="home.php">Back to HomePage</a></p> 

</body>

</html>