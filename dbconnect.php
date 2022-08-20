<?php
	$servername = "localhost";
	$username = "root";
	$password = "Aldebaran09*";
	$dbname = "flaying";

	// Create connection
	$con = mysqli_connect($servername, $username, $password, $dbname);

	// Check connection
	if(mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
?>