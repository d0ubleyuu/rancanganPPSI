<?php
include '../koneksi.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Ambil informasi file penilaian
    $id = $_POST['id'];
    $kode_mapel = $_POST['kode_mapel'];
    $nama_mapel = $_POST['nama_mapel'];
    $nama_guru = $_POST['nama_guru'];
    $waktu = date("Y-m-d");
    $namafilePenilaian = $_FILES['file_nilai']['name'];
    $xPenilaian = explode('.', $namafilePenilaian);
    $ekstensiPenilaian = strtolower(end($xPenilaian));
    $ukuranPenilaian = $_FILES['file_nilai']['size'];
    $file_tmpPenilaian = $_FILES['file_nilai']['tmp_name'];

    // Ambil informasi file remedial
    $namafileRemedial = $_FILES['file_remedial']['name'];
    $xRemedial = explode('.', $namafileRemedial);
    $ekstensiRemedial = strtolower(end($xRemedial));
    $ukuranRemedial = $_FILES['file_remedial']['size'];
    $file_tmpRemedial = $_FILES['file_remedial']['tmp_name'];
    $namaFileBaru = $kode_mapel."_".$nama_mapel."_".$nama_guru."_".$waktu."_";
    // Set direktori tujuan dengan jalur absolut menggunakan __DIR__
    $dirUpload = __DIR__ . '../../document/'; 
    $linkBerkasPenilaian = $dirUpload . 'penilaian/' . $namaFileBaru . 'Catatan_Penilaian.pdf';
    $linkBerkasRemedial = $dirUpload . 'remedial/' . $namaFileBaru . 'Laporan_Remedial.pdf';

    // Cek apakah direktori sudah ada, jika belum buat direktori
    if (!is_dir($dirUpload . 'penilaian/')) {
        mkdir($dirUpload . 'penilaian/', 0755, true);
    }
    if (!is_dir($dirUpload . 'remedial/')) {
        mkdir($dirUpload . 'remedial/', 0755, true);
    }

    // Validasi ekstensi dan ukuran file
    $allowedExtensions = ['pdf']; // Daftar ekstensi yang diizinkan
    $maxSize = 2 * 1024 * 1024; // Batasan ukuran file (2MB)

    $successMessage = '';
    $errorMessage = '';

    
    if (in_array($ekstensiRemedial, $allowedExtensions) && $ukuranRemedial <= $maxSize && in_array($ekstensiPenilaian, $allowedExtensions) && $ukuranPenilaian <= $maxSize) {
        // Upload file remedial
        if (move_uploaded_file($file_tmpPenilaian, $linkBerkasPenilaian) && move_uploaded_file($file_tmpRemedial, $linkBerkasRemedial)) {
            $successMessage .= "File remedial berhasil diunggah. ";
            
            // Simpan path ke database
            $query = "INSERT INTO document (id_mapel, waktu, path_doc_nilai, path_doc_remedial) VALUES ($id, NOW(), '".$namaFileBaru."Catatan_Penilaian.pdf','".$namaFileBaru."Laporan_Remedial.pdf')";
            mysqli_query($koneksi, $query);
        } else {
            $errorMessage .= "Gagal memindahkan file remedial. ";
        }
    } else {
        $errorMessage .= "Ekstensi atau ukuran file remedial tidak diizinkan. ";
    }

    // Menampilkan pop-up
    if ($successMessage) {
        echo "<script>alert('$successMessage');document.location='dashboard.php';</script>";
    }
    if ($errorMessage) {
        echo "<script>alert('$errorMessage');document.location='dashboard.php';</script>";
    }
} else{
    echo "<script>alert(TAKDEE);</script>";
}
?>
