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
  try {
    if($ins){
      $status = "success";
      $message = "Data berhasil disimpan!";
    }
  } catch (PDOException $e) {
      $status = "error";
      $message = "Data gagal disimpan: " . $e->getMessage();
  }
  // Execute the query
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
            window.location.href = "mapel.php";
        });
    });
<?php endif; ?>
</script>
</html>