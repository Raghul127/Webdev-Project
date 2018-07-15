
<!DOCTYPE html>

<html>

<head>

<title>View Reviews</title>
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

if (isset($_POST['view'])) {
  $username=$_SESSION['username'];

  $place = mysqli_real_escape_string($conn, $_POST['cit']);

$sql = "SELECT * FROM data WHERE username!='$username' AND place='$place' ";
   $result = $conn->query($sql);



if ($result->num_rows > 0) {

echo "REVIEWS ABOUT THE PLACE <br><br>";

echo "<table border='1' cellpadding='10'>";

echo "<tr>  <th>Place</th> <th>Review</th> <th>Review By</th> <th>Likes</th><th></th> </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // echo out the contents of each row into a table

echo "<tr>";


echo '<td>' . $row['place'] . '</td>';

echo '<td>' . $row['descr'] . '</td>';

echo '<td>' . $row['username'] . '</td>';

echo '<td>' . $row['likes'] . '</td>';

echo '<td><a href="like.php?id=' . $row['id'] . '">Like</a></td>';

echo "</tr>";
    }}
     else {
    echo "0 results";
}

$conn->close();

// close table>

echo "</table>";
}
?>
<br>

<p style="color: black;"><a href="home.php">Back to HomePage</a></p> 




</body>

</html>