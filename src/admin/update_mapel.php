<?php
include '../koneksi.php'; // Menghubungkan ke database

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
 

// Ambil data dari form
$id = $_POST['id'];
$nama_mapel = $_POST['name'];
$kode_mapel = $_POST['kode'];
$id_guru = $_POST['guru'];
$kkm = $_POST['kkm'];
$kelas = $_POST['angkatan'].' '.$_POST['kelas'];
$ta = $_POST['ta'];

// Query untuk memperbarui data
$sql = "UPDATE mapel SET id_guru=?, kode_mapel=?, nama=?, kkm=?, kelas=?, ta=? WHERE id=?";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "sssissi", $id_guru, $kode_mapel, $nama_mapel, $kkm, $kelas, $ta, $id);
mysqli_stmt_execute($stmt);

// Cek apakah data berhasil diupdate
if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo "Data berhasil diperbarui.";
} else {
    echo "Gagal memperbarui data.";
}

// Tutup koneksi
mysqli_stmt_close($stmt);
mysqli_close($koneksi);

//Redirect atau tampilkan pesan sukses
header("Location: mapel.php"); // Ganti dengan halaman yang sesuai
exit; ?>
