<!DOCTYPE html>
<html lang="en">
<head>
    <title>Flying.com</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="./style/style_searchResultOneWay.css">
</head>
<body>
    <header>
        <p id="logo">Flying.com</p>
        <div class="right-side">
            <a href="./logout.php" id="keluar">KELUAR</a>
        </div>
    </header>
    <main>
        <?php
            include_once 'dbconnect.php';

            function test_input($data) {
               $data = trim($data);
               $data = stripslashes($data);
               $data = htmlspecialchars($data);
               return $data;
            }
            
            $from = test_input($_POST["from"]);
            $to = test_input($_POST["to"]);
            $departdate = $_POST["depart"];
            $stop = "nonstop";
            
            global $sql, $result, $availableNumber;

            if ($stop == "nonstop") {
                //search by (code and code) or (city and city)
                $sql = "
                    SELECT * FROM penerbangan P, maskapai M
                    WHERE P.no_maskapai=M.no_maskapai
                        AND P.bandara_keberangkatan='$from'
                        AND P.bandara_tujuan='$to'
                        AND P.tanggal_keberangkatan='$departdate'
                ";
                $result = mysqli_query($con, $sql);
                $rowcount = mysqli_num_rows($result);
            
                if ($rowcount == 0) {
                    echo "<div><strong>Search Result: </strong>".$rowcount." result</div>";
                } else {
                    echo "
                        <div class='top-content'>
                            <div class='keberangkatan-tujuan'>
                                <p>Dari</p>
                                <b id='bandara_keberangkatan'>".$from."</b>
                                <p>Ke</p>
                                <b id='bandara_tujuan'>".$to."</b>
                                <b>|</b>
                                <p id='tanggal_keberangkatan'>".$departdate."</p>
                            </div>
                            <p><strong>Search Result: </strong>".$rowcount." result(s)</p>
                        </div>
                    ";
                
                    echo "
                        <div class='content'>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Maskapai</th>
                                        <th>Keberangkatan</th>
                                        <th>Waktu Keberangkatan</th>
                                        <th>Kedatangan</th>
                                        <th>Waktu Kedatangan</th>
                                        <th>No. Pesawat</th>
                                        <th>Harga</th>
                                        <th>Remain Seats</th>
                                        <th>Reserve</th>
                                    </tr>
                                </thead>
                        </div>
                    ";
                    
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tbody><tr>";
                        echo "<td>" . $row['nama_maskapai']."</td>";
                        echo "<td>" . $row['bandara_keberangkatan'] . "</td>";
                        echo "<td>" . $row['jam_keberangkatan'] . "</td>";
                        echo "<td>" . $row['bandara_tujuan'] . "</td>";
                        echo "<td>" . $row['jam_kedatangan'] . "</td>";
                        echo "<td>" . $row['no_pesawat'] . "</td>";
                        echo "<td>Rp " . $row['harga'] . "</td>";
                   
                        //calculate number of remain seats
                        $seatreserved = "
                            SELECT *, COUNT(*) FROM memesan, penerbangan
                            WHERE penerbangan.tanggal_keberangkatan = '".$departdate."'
                                AND memesan.no_penerbangan = '".$row['no_penerbangan']."'
                                AND no_pesawat='".$row['no_pesawat']."'
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
                            $availableNumber = $capacityNumber['kapasitas_penumpang'];
                        }
                    
                        echo "<td>".$availableNumber."</td>";
                    
                        if ($availableNumber > 0) {
                            echo '
                                <td>
                                    <form action="shoppingcart.php" method="post">
                                        <input type="hidden" name="flightno" value="'.$row['no_penerbangan'].'">
                                        <input type="hidden" name="date" value="'.$departdate.'">
                                        <input type="hidden" name="price" value="'.$row['harga'].'">
                                        <input type="hidden" name="type" value="onewaynonstop">
                                        <button type="submit" id="pilih">Add to Chart</button>
                                    </form>
                                </td>
                            ';
                        } else {
                            echo "<td><button type='button' id='pilih'>Not Available</button></td>";
                        }
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                }
            }
        ?>
    </main>
    <footer class="footer">

    </footer>
</body>
</html>
