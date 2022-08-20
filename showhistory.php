<?php
    // Start the session
    session_start();
    $user = $_SESSION['nama_penumpang'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Flying.com</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="./style/style_showHistory.css">
</head>
<body>
    <header>
        <p id="logo">Flying.com</p>
        <div class="right-side">
            <a href="homepage.php" id="halaman-utama">Kembali ke Halaman Utama</a>
            <a href="logout.php" id="keluar">KELUAR</a>
        </div>
    </header>
    <main>
        <?php
            include_once 'dbconnect.php';
            
            $update = mysqli_query($con, "
                UPDATE memesan, penumpang SET terbayar = '1'
                WHERE nama_penumpang = '$user'
                AND memesan.no_penumpang = penumpang.no_penumpang
            ");

            $sql = "
                SELECT * FROM penumpang P, memesan M, Penerbangan
                WHERE P.nama_penumpang = '$user'
                AND P.no_penumpang = M.no_penumpang
                AND M.no_penerbangan = Penerbangan.no_penerbangan
                AND M.terbayar='1'
                    ORDER BY M.waktu_pemesanan;
            ";
            $result = mysqli_query($con, $sql);
            $rowcount = mysqli_num_rows($result);

            if ($rowcount == 0) {
                echo "<div><strong>Nothing in the history.</strong></div>";
            } else {
                echo "<div class='top-content'>History:</div>";
                echo "
                    <div class='content'>
                        <table>
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Aircraft</th>
                                    <th>Date</th>
                                    <th>Departure</th>
                                    <th>Departure Time</th>
                                    <th>Arrival</th>
                                    <th>Arrival Time</th>
                                    <th>Price</th>
                                    <th>Pay</th>
                                </tr>
                            </thead>
                    </div>
                ";
                
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tbody><tr>";
                    echo "<td>" . $row['waktu_pemesanan'] . "</td>";
                    echo "<td>" . $row['nama_penumpang']."</td>";
                    echo "<td>" . $row['tanggal_keberangkatan'] . "</td>";
                    echo "<td>" . $row['bandara_keberangkatan'] . "</td>";
                    echo "<td>" . $row['jam_keberangkatan'] . "</td>";
                    echo "<td>" . $row['bandara_tujuan'] . "</td>";
                    echo "<td>" . $row['jam_kedatangan'] . "</td>";
                    echo "<td>" . $row['harga'] . "</td>";

                    if($row['terbayar'] == 1){
                        echo "<td>YES</td>";
                    }
                
                    echo "</tr>";
                }

                echo " </tbody></table>";
            }

            mysqli_close($con);
        ?>
    </main>
    <footer class="footer">

    </footer>
</body>
</html>
