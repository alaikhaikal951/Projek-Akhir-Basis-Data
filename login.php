<?php
	session_start();

	include_once 'dbconnect.php';

	if (isset($_SESSION['nama_penumpang'])!="") {
		header("Location: homepage.php");
	}

	$email = $_POST['email'];
	$pwd = $_POST['pwd'];

	$res = mysqli_query($con,"SELECT * FROM penumpang WHERE email='$email'");
	$row = mysqli_fetch_array($res);

	if ($row['password'] == $pwd) {
		$_SESSION['nama_penumpang'] = $row['nama_penumpang'];
		header("Location: homepage.php");
	} else {
		echo "<script>alert('wrong email or wrong password ');</script>";
	}

	mysqli_close($con);
	
?>