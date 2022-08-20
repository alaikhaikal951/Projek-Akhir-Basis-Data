<?php
	// Start the session
	session_start();
	include_once 'dbconnect.php';

	date_default_timezone_set("Asia/Jakarta");
	// $t = time();
	$time = date("Y-m-d h:i:s");


	if (!isset($_SESSION['nama_penumpang'])) {
		header("Location: masuk.html");
	} else {
		$user = $_SESSION['nama_penumpang'];

		if (true) {
			$flightno = $_POST["flightno"];
			$price = $_POST["price"];
			$date = $_POST["date"];
			$no_penumpang = "
				SELECT no_penumpang FROM penumpang
				WHERE nama_penumpang='$user';
			";
			$upPenumpang = mysqli_query($con, $no_penumpang);
			$row = mysqli_fetch_array($upPenumpang);

			$sql = "
				INSERT INTO memesan (no_penerbangan, no_penumpang, no_kursi, waktu_pemesanan, terbayar) 
				VALUES ('$flightno', '".$row['no_penumpang']."', '2', '$time', '0')
			";
			$result = mysqli_query($con, $sql);

			header("Location: cartshow.php");
		}
	
		echo "Error adding to cart..";
	}

	mysqli_close($con);
?>
