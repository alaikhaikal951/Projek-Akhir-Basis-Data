<?php
    // Start the session
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Flying.com</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="./style/style_cartShow.css">
</head>
<body>
    <header>
        <p id="logo">Flying.com</p>
        <div class="right-side">
            <a href="logout.php" id="keluar">KELUAR</a>
        </div>
    </header>
    <main>
        <?php
            include_once 'dbconnect.php';

            if (!isset($_SESSION['nama_penumpang'])) {
                header("Location: masuk.html");
            } else {
                $user = $_SESSION['nama_penumpang'];	

                $sql = "
                    SELECT * FROM penumpang P, memesan M, penerbangan
                    WHERE P.nama_penumpang = '$user'
                    AND P.no_penumpang = M.no_penumpang
                    AND M.no_penerbangan = penerbangan.no_penerbangan
                    AND M.terbayar='0'
                        ORDER BY M.waktu_pemesanan;
                ";
                $result = mysqli_query($con, $sql);
                $rowcount = mysqli_num_rows($result);

                if ($rowcount == 0) {
                    echo "<div><strong>Nothing in the shopping cart.</strong><a href='homepage.php'>Back to homepage</a></div>";
                } else {
                    echo "
                        <div class='top-content'>
                            In the shopping cart:
                        </div>
                    ";

                    echo "
                        <div class='content'>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Waktu</th>
                                        <th>ID Pemesanan</th>
                                        <th>Tanggal Keberangkatan</th>
                                        <th>Bandara Keberangkatan</th>
                                        <th>Waktu Keberangkatan</th>
                                        <th>Bandara Kedatangan</th>
                                        <th>Waktu Kedatangan</th>
                                    </tr>
                                </thead>
                        </div>
                    ";

                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tbody><tr>";
                        echo "<td>" . $row['waktu_pemesanan'] . "</td>";
                        echo "<td>" . $row['id_pemesanan'] . "</td>";
                        echo "<td>" . $row['tanggal_keberangkatan'] . "</td>";
                        echo "<td>" . $row['bandara_keberangkatan'] . "</td>";
                        echo "<td>" . $row['jam_keberangkatan'] . "</td>";
                        echo "<td>" . $row['bandara_tujuan'] . "</td>";
                        echo "<td>" . $row['jam_kedatangan'] . "</td>";
                
                        //calculate number of remain seats
                        $seatreserved = "
                            SELECT *, COUNT(*) FROM memesan, penerbangan
                            WHERE penerbangan.tanggal_keberangkatan = '".$row['tanggal_keberangkatan']."'
                                AND memesan.no_penerbangan = '".$row['no_penerbangan']."'
                        ";
                        $reserved = mysqli_query($con, $seatreserved);   
                        $reservedNumber = mysqli_fetch_array($reserved);
                        
                        $capacity = mysqli_query($con, "
                            SELECT kapasitas_penumpang FROM pesawat
                            WHERE no_pesawat='".$row['no_pesawat']."'
                        ");
                        $capacityNumber = mysqli_fetch_array($capacity);
                        
                        if (mysqli_num_rows($reserved) > 0) {            
                            $availableNumber = $capacityNumber['kapasitas_penumpang'] - $reservedNumber['COUNT(*)'];
                        } else {
                            $availableNumber = $capacityNumber['kapasistas_penumpang'];
                        }
                    
                        if ($availableNumber > 0) {
                            echo '
                                <td>
                                    <form action="cartdelete.php" method="post">
                                        <input type="hidden" name="bookid" value="'.$row['id_pemesanan'].'" >
                                        <button type="submit" id="delete">Delete</button></div>
                                    </form>        
                                </td>
                            ';
                        } else {
                            echo "<td><button type='button'>No seat Available now</button></td>";
                        }
                    
                        $sum = mysqli_query($con,"
                            SELECT SUM(harga) FROM penumpang P, memesan M, Penerbangan
                            WHERE P.nama_penumpang = '$user'
                            AND P.no_penumpang = M.no_penumpang
                            AND M.no_penerbangan = Penerbangan.no_penerbangan
                            AND terbayar = '0'
                        ");

                        $t = mysqli_fetch_array($sum);
                        $total = $t['SUM(harga)'];

                        echo "</tr>";
                    }

                    echo " </tbody></table>";
                    echo " <form action='showhistory.php' method='post'>";
                    echo "
                        <div class='total'>
                            <p>Total: <span id='total'>Rp ".$total."</span></p>
                            <div><button type='submit' id='pay'>Pay</button></div>
                        </div>
                    ";
                    
                    echo "</form>";
                    echo "<br>";
                }

            }

            mysqli_close($con);
        ?>
    </main>
    <footer class="footer">

    </footer>
</body>
</html>
