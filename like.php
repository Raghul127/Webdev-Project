
<!DOCTYPE html>

<html>

<head>

<title>View Records of List</title>
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


// connect to the database

$db = mysqli_connect('localhost', 'root', '', 'travel');
$username=$_SESSION['username'];
$id = $_GET['id'];


// save the data to the database

$query="UPDATE data SET likes=likes+1 WHERE id='$id'";
mysqli_query($db, $query);

// once saved, redirect back to the view page

header("Location: view.php");


?>