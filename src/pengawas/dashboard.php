<?php

// Include Koneksi.php
require_once '../koneksi.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['nama'])) {
    header('Location: ../index.php');
    exit;
}

$nama = $_SESSION['nama'];
$jabatan = $_SESSION['jabatan'];

// Halaman untuk admin
echo "Selamat datang, " . $_SESSION['nama'] . "! Ini adalah dashboard Pengawas.";

?>