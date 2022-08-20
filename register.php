<?php
      session_start();
      include_once 'dbconnect.php';

      if(isset($_SESSION['nama_penumpang'])!="") {
            header("Location: homepage.php");
      }

      $name = $_POST['nama_penumpang'];
      $email = $_POST['email'];
      $pwd = $_POST['pwd'];

      if (mysqli_query($con, "
            INSERT INTO penumpang (nama_penumpang, email, password)
            VALUES('$name','$email','$pwd')")
      ) {
            $_SESSION['nama_penumpang'] = $name;
            header("Location: homepage.php");
      } else {
            echo "<script>alert('error while registering you...')</script>";
      }

      mysqli_close($con);
?>