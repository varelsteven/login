<?php
    session_start();

    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "flybox";

    $connect = mysqli_connect($host,$user,$password,$database) or die("Gagal Menghubungkan");
?>