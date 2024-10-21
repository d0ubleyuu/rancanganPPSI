<?php
include "../koneksi.php";

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
  

$nama_mapel = "";
$kode_mapel = "";
$jenjang = "";
$kelas = "";
$id_guru = "";
$kkm = "";
$kelas = "";
$ta = "";
$mutu = "0";

if (isset($_POST['submit'])) {
  // Get the form data
  $id_guru = $_POST['guru'];
  $kode_mapel = $_POST['kode'];
  $nama_mapel = $_POST['name'];
  $kelas = $_POST['angkatan'].' '.$_POST['kelas'];
  $ta = $_POST['ta'];
  $kkm = $_POST['kkm'];

  // Prepare the SQL query
  $sql = "INSERT INTO mapel (id_guru, kode_mapel, nama, kkm, kelas, ta, mutu) 
            VALUES ('$id_guru', '$kode_mapel', '$nama_mapel', '$kkm', '$kelas', '$ta', $mutu)";
  $ins = mysqli_query($koneksi, $sql);
  if($ins){
    header("location: mapel.php");
}
  // Execute the query
}
?>