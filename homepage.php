<?php
    session_start();
    include_once 'dbconnect.php';

    if (isset($_SESSION['nama_penumpang'])=="") {
		header("Location: masuk.html");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Flying.com</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="./style/style_homePage.css">
</head>
<body>
    <header>
        <p id="logo">Flying.com</p>
        <div class="right-side">
            <p id="nama_penumpang">
                <?php if(isset($_SESSION['nama_penumpang'])): ?>
                    Hai, <?php echo $_SESSION["nama_penumpang"]; ?>
                <?php endif; ?>
            </p>
            <a href="./logout.php" id="keluar">KELUAR</a>
        </div>
    </header>
    <main>
        <div class="content">
            <form action="SearchResultOneway.php" method="post">
                <div class="sub-content">
                    <div class="field-wrap">
                        <label for="from">Dari</label>
                        <input type="text" id="from" name="from" placeholder="Lokasi Keberangkatan" required/>
                    </div>
                    <div class="field-wrap">
                        <label for="depart">Tanggal Keberangkatan</p>
                        <input type="date" id="depart" name="depart" placeholder="Tanggal/Bulan/Tahun" required/>
                    </div>
                </div>
                <div class="sub-content">
                    <div class="field-wrap">
                        <label for="to">Ke</label>
                        <input type="text" id="to" name="to" placeholder="Lokasi Tujuan" required/>
                    </div>
                    <div id="cari-tiket">
                        <button type="submit" class="button">Cari Tiket</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <footer class="footer">

    </footer>
</body>
</html>
