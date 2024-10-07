<?php
include '../koneksi.php'; // Menghubungkan ke database

// Ambil data dari form
$id = $_POST['id'];
$nama_mapel = $_POST['name'];
$kode_mapel = $_POST['kode'];
$id_guru = $_POST['guru'];
$kkm = $_POST['kkm'];
$mutu = $_POST['mutu'];

// Query untuk memperbarui data
$sql = "UPDATE mapel SET id_guru=?, kode_mapel=?, nama=?, kkm=?, mutu=? WHERE id=?";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "sssiii", $id_guru, $kode_mapel, $nama_mapel, $kkm, $mutu, $id);
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
