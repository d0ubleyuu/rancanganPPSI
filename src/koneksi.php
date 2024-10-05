<?php
//Koneksi Database
$server = "localhost";
$user = "root";
$pass = "";
$database = "penilaian_mutu";

$koneksi = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($koneksi));
