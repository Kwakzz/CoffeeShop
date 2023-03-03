<?php 

//database connection parameters
$servername = "13.42.12.179";
$username = "java";
$password = "password";
$dbname = "CoffeeShop";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
	//stop executing the code and echo error
	die("Connection failed: " . mysqli_connect_error());
} 

?>