<?php
include '../koneksi.php'; // Menginclude file koneksi.php

session_start();

// Check if user is logged in
if (!isset($_SESSION['id'])) {
  header('Location: ../../index.php');
  exit;
} else {
  if ($_SESSION['jabatan'] !== 'admin') {
    header('Location: ../../index.php');
  exit;
  }
}
// Ambil ID dari parameter GET
$id = $_GET['id'];

// Query untuk menghapus data
$sql = "DELETE FROM mapel WHERE id = ?";

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "i", $id); // "i" berarti integer
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) > 0) {
        header("location: mapel.php");
}

// Tutup koneksi
mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>
