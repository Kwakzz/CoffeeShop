<?php 

//database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CoffeeShop";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
	//stop executing the code and echo error
	die("Connection failed: " . mysqli_connect_error());
} 

?>