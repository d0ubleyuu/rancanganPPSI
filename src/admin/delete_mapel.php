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
try {
if (mysqli_stmt_affected_rows($stmt) > 0) {
  $status = "success";
  $message = "Data berhasil dihapus!";
}} catch (PDOException $e) {
  $status = "error";
  $message = "Data gagal dihapus: " . $e->getMessage();
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
