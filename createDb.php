<?php

$sql = "CREATE DATABASE IF NOT EXISTS travel;";
$conn->query($sql);

$sql = "USE travel;";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS user(
		id INT(100) NOT NULL AUTO_INCREMENT,
		username VARCHAR(100) NOT NULL,
		email VARCHAR(320) NOT NULL,
		password VARCHAR(128) NOT NULL,
		PRIMARY KEY (id,username)
		)";
$result = $conn->query($sql);

 $sql="CREATE TABLE IF NOT EXISTS data(
    id INT(100) NOT NULL AUTO_INCREMENT,
    username VARCHAR(500) NOT NULL,
    place VARCHAR(500) NOT NULL,
    descr VARCHAR(500) NOT NULL,
    comm VARCHAR(500) NOT NULL, 
    likes INT(11) NOT NULL
    )";

$result = $conn->query($sql);


?>