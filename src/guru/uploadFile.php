<?php
include '../koneksi.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit;
  } else {
    if ($_SESSION['jabatan'] !== 'Guru') {
      header('Location: ../../index.php');
    exit;
    }
  }

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

    try {
        if (in_array($ekstensiRemedial, $allowedExtensions) && $ukuranRemedial <= $maxSize && in_array($ekstensiPenilaian, $allowedExtensions) && $ukuranPenilaian <= $maxSize) {
            // Upload file remedial
            if (move_uploaded_file($file_tmpPenilaian, $linkBerkasPenilaian) && move_uploaded_file($file_tmpRemedial, $linkBerkasRemedial)) {
                $successMessage .= "File remedial berhasil diunggah. ";
                
                // Simpan path ke database
                $query = "INSERT INTO document (id_mapel, waktu, path_doc_nilai, path_doc_remedial) VALUES ($id, NOW(), '".$namaFileBaru."Catatan_Penilaian.pdf','".$namaFileBaru."Laporan_Remedial.pdf')";
                mysqli_query($koneksi, $query);
                $status = "success";
                $message = "File berhasil diupload!";
            } else {
                $status = "error";
                $message = "File gagal diupload: Lokasi Tidak Ditemukan";
            }
        } else {
            $status = "error";
            $message = "File gagal diupload: Pastikan File dengan format PDF dan maksimal ukuran 2MB";
        }
    } catch (\Throwable $th) {
        $status = "error";
        $message = "File gagal diupload";
    }    
}
?>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="..\css\output.css" rel="stylesheet" />
    <script src="node_modules\flowbite\dist\flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-minimal@4/minimal.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link
      href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"
      rel="stylesheet"
    />
  </head>
  <script>
<?php if (isset($status) && isset($message)): ?>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: '<?= $status ?>', 
            title: '<?= $message ?>',
            showConfirmButton: true
        }).then(() => {
            // Redirect setelah SweetAlert ditutup (opsional)
            window.location.href = "dashboard.php";
        });
    });
<?php endif; ?>
</script>
</html>