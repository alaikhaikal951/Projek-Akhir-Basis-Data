<?php
    session_start();
    unset($_SESSION['nama_penumpang']);
    header("Location: masuk.html");
?>