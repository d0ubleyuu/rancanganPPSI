<?php
include "../koneksi.php";

$nama_mapel = "";
$kode_mapel = "";
$jenjang = "";
$kelas = "";
$id_guru = "";
$kkm = "";
$mutu = "0";

if (isset($_POST['submit'])) {
  // Get the form data
  $id_guru = $_POST['guru'];
  $kode_mapel = $_POST['kode'];
  $nama_mapel = $_POST['name'];
  $kkm = $_POST['kkm'];

  // Prepare the SQL query
  $sql = "INSERT INTO mapel (id_guru, kode_mapel, nama, kkm, mutu) 
            VALUES ('$id_guru', '$kode_mapel', '$nama_mapel', '$kkm', $mutu)";
  $ins = mysqli_query($koneksi, $sql);
  if($ins){
    header("location: mapel.php");
}
  // Execute the query
}
?>