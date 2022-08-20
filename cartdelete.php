<?php
	session_start();
	include_once 'dbconnect.php';

	if (!isset($_SESSION['nama_penumpang'])) {
		header("Location: masuk.html");
	} else {	
		$bookid = $_POST["bookid"];

		$delete = "DELETE FROM memesan WHERE id_pemesanan = '$bookid'";

		if (mysqli_query($con, $delete)) {
			header("Location: cartshow.php");
		} else {
			echo "Error";
		}
	}
?>