<?php
include("../koneksi.php");
session_start();

// Check if user is logged in
if (!isset($_SESSION['id'])) {
  header('Location: ../../index.php');
  exit;
} else {
  if ($_SESSION['jabatan'] !== 'Kepsek') {
    header('Location: ../../index.php');
  exit;
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['new_password'])) {
    $id = $_POST['id'];
    $new_pass = $_POST['new_password'];
    $queryEdit = "UPDATE tendik SET password = '$new_pass' WHERE tendik.id = $id";
    $edit = mysqli_query($koneksi, $queryEdit);
    if ($edit)
    {
        echo "<script>
        alert('Ubah Password suksess!');
        document.location='../../index.php';
          </script>";
    } else {
        echo "<script>
        alert('Ubah Password GAGAL!!');
        document.location='../../index.php';
          </script>";
        }
  } 

  if(isset($_POST['id_penilaian'])) {
  $id_penilaian = $_POST['id_penilaian'];
  // echo $abc;

  $query = mysqli_query($koneksi, 
  "SELECT 
    penilaian_mutu.mutu AS mutu,
    sekolah.nama AS nama_sekolah,
    sekolah.npsm AS npsm_sekolah,
    sekolah.status AS status_sekolah,
    sekolah.bp AS bp_sekolah,
    sekolah.akreditasi AS akreditasi_sekolah,
    mapel.kode_mapel AS kode_mapel,
    mapel.nama AS nama_mapel,
    mapel.kkm AS kkm,
    mapel.kelas AS kelas,
    mapel.ta AS ta,
    mapel.id_guru AS id_pengajar,
    tendik.nama AS nama_penilai,
    tendik.nip AS nip_penilai,
    tendik.jk AS jk_penilai,
    tendik.jabatan AS jabatan_penilai,
    tendik.pendidikan AS pendidikan_penilai,
    penilaian_mutu.waktu AS waktu,
    document.path_doc_nilai AS doc_nilai,
    document.path_doc_remedial AS doc_remedial,
    penilaian_mutu.sesuai_jadwal AS sesuai_jadwal,
    penilaian_mutu.metode_beragam AS metode_beragam,
    penilaian_mutu.berkelanjutan AS berkelanjutan,
    penilaian_mutu.peningkatan AS peningkatan
  FROM penilaian_mutu
  JOIN mapel ON penilaian_mutu.id_mapel = mapel.id
  JOIN tendik ON penilaian_mutu.id_kepsek = tendik.id
  JOIN sekolah ON tendik.id_sekolah = sekolah.id
  JOIN document ON penilaian_mutu.id_doc = document.id
  WHERE penilaian_mutu.id = '$id_penilaian';");
  foreach ($query as $row) {

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Dashboard | Sistem Penilaian Program Remedial & Pengayaan</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link href="..\css\output.css" rel="stylesheet" /> -->
    <script src="node_modules\flowbite\dist\flowbite.min.js"></script>
    <link
      href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <nav
      class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700"
    >
      <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
          <div class="flex items-center justify-start rtl:justify-end">
            <button
              data-drawer-target="logo-sidebar"
              data-drawer-toggle="logo-sidebar"
              aria-controls="logo-sidebar"
              type="button"
              class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            >
              <span class="sr-only">Open sidebar</span>
              <svg
                class="w-6 h-6"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  clip-rule="evenodd"
                  fill-rule="evenodd"
                  d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
                ></path>
              </svg>
            </button>
            <a href="dashboard.php" class="flex ms-2 md:me-24">
              <img
                src="https://upload.wikimedia.org/wikipedia/commons/9/9c/Logo_of_Ministry_of_Education_and_Culture_of_Republic_of_Indonesia.svg"
                class="h-8 me-3"
                alt="Logo Dinas Pendidikan dan Kebudayaan"
              />
              <span
                class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white"
                >Dindikbud</span
              >
            </a>
          </div>
          <div class="flex items-center">
            <div class="flex items-center ms-3">
              <div>
                <button
                  type="button"
                  class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                  aria-expanded="false"
                  data-dropdown-toggle="dropdown-user"
                >
                  <span class="sr-only">Open user menu</span>
                  <img
                    class="w-8 h-8 rounded-full"
                    src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                    alt="user photo"
                  />
                </button>
              </div>
              <div
                class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                id="dropdown-user"
              >
              <div class="px-4 py-3" role="none">
                  <p class="text-sm text-gray-900 dark:text-white" role="none">
                    <?php $nama = ucwords($_SESSION['nama']); echo $nama; ?>
                  </p>
                  <p
                    class="text-sm font-medium text-gray-900 truncate dark:text-gray-300"
                    role="none"
                  >
                    <?=$_SESSION['email']?>
                  </p>
                </div>
                <ul class="py-1" role="none">
                  <li>
                    <a
                      href="dashboard.php"
                      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                      role="menuitem"
                      >Dashboard</a
                    >
                  </li>
                  <li>
                    <button
                      data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                      class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                      role="menuitem"
                      >Change Password</button
                    >
                  </li>
                  <li>
                    <a
                      href="../../index.php"
                      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                      role="menuitem"
                      >Sign out</a
                    >
                  </li>
                </ul>
              </div>
            </div>
            <!-- Change Password modal -->
          <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
              <div class="relative p-4 w-full max-w-md max-h-full">
                  <!-- Modal content -->
                  <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                      <!-- Modal header -->
                      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                          <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                              Change Password
                          </h3>
                          <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                              </svg>
                              <span class="sr-only">Close modal</span>
                          </button>
                      </div>
                      <!-- Modal body -->
                      <div class="p-4 md:p-5">
                      <form class="space-y-4" method="POST" onsubmit="return validatePassword()">
                        <!-- Div untuk menampilkan pesan error -->
                        <input type="hidden" name="pass_val" id="pass_val" value=<?=$_SESSION['password']?> />
                        <input type="hidden" name="id" id="id" value=<?=$_SESSION['id']?> />
                        <input type="hidden" name="id_penilaian" id="pass_val" value=<?=$_POST['id_penilaian']?> />
                        <div id="error-message" class="hidden flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Error</span>
                            <div>
                                <span class="font-medium" id="alert-title">Error!</span> <span id="alert-message"></span>
                            </div>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your old password</label>
                            <input type="password" name="old_password" id="old_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your new password</label>
                            <input type="password" name="new_password" id="new_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        </div>
                        <div>
                            <label for="password" class="block  text-sm font-medium text-gray-900 dark:text-white">Confirm new password</label>
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="••••••••" class="bg-gray-50 mb-6 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        </div>
                        <button type="submit" nama="btn_change_pass" value="ubah" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Change Password</button>
                        
                      </form>
                      </div>
                  </div>
              </div>
          </div> 
          </div>
        </div>
      </div>
    </nav>

    <div class="p-4 h-full">
      <div
        class="px-4 py-8 flex flex-col items-center justify-center border-2 border-gray-200 border-dashed rounded-lg h-full dark:border-gray-700 mt-14 "
      >
      <h1 class="mb-4 text-4xl text-center font-extrabold leading-5 tracking-tight text-gray-900 md:text-4xl lg:text-6 dark:text-white">Hasil Penilaian Capaian Program <span class="text-blue-600 dark:text-blue-500">Remedial dan Pengayaan</span> </h1>
        <div class="flex items-center mt-8">
        <?php 
          for ($i = 0; $i  < 4; $i++) {
            if($i < $row['mutu']){
              echo '
              <svg
                aria-hidden="true"
                class="w-16 h-16 text-yellow-400"
                fill="currentColor"
                viewbox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                />
              </svg>';
            }else{
              echo '
              <svg
                aria-hidden="true"
                class="w-16 h-16 text-gray-400"
                fill="currentColor"
                viewbox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                />
              </svg>
              ';
            }
          }
        ?>
        <span class="text-4xl text-gray-500 dark:text-gray-400 ml-4"
          ><?php echo $row['mutu'];?>.0</span
        >
        </div>

        <div class="flex gap-6 items-start mt-8 mb-16 w-full">
          
          <div class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow rounded-lg p-5">
              <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Detail Sekolah</h2>
              <address class="relative bg-gray-50 dark:bg-gray-700 dark:border-gray-600 p-4 rounded-lg border border-gray-200 not-italic grid grid-cols-2">
                  <div class="space-y-2 text-gray-500 dark:text-gray-400 leading-loose hidden sm:block">
                      Nama <br />
                      NPSN <br />
                      Status <br />
                      Bentuk Pendidikan <br />
                      Akreditasi
                  </div>
                  <div id="contact-details" class="space-y-2 text-gray-900 dark:text-white font-medium leading-loose">
                      <?php echo $row['nama_sekolah'];?> <br />
                      <?php echo $row['npsm_sekolah'];?> <br />
                      <?php echo $row['status_sekolah'];?> <br />
                      <?php echo $row['bp_sekolah'];?> <br />
                      <?php 
                      // Agama
                      if ($row['akreditasi_sekolah'] == "A") {
                          $akreditasi_sekolah = 'A (Unggul)';
                      } else if ($row['akreditasi_sekolah'] == "B") {
                          $akreditasi_sekolah = '(B) Baik';
                      } else if ($row['akreditasi_sekolah'] == "C") {
                          $akreditasi_sekolah = '(C) Cukup';
                      } else if ($row['akreditasi_sekolah'] == "TT") {
                          $akreditasi_sekolah = 'Tidak Terakreditasi';
                      }  else {
                          $akreditasi_sekolah = 'Not Found';
                      }
                      echo $akreditasi_sekolah;?>
                      
                  </div>
                  </div>
              </address>

          <div class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow rounded-lg p-5">
              <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Detail Mata Pelajaran</h2>
              <address class="relative bg-gray-50 dark:bg-gray-700 dark:border-gray-600 p-4 rounded-lg border border-gray-200 not-italic grid grid-cols-2">
                  <div class="space-y-2 text-gray-500 dark:text-gray-400 leading-loose hidden sm:block">
                      Kode <br />
                      Nama <br />
                      kelas <br />
                      Tahun Ajar <br />
                      KKM 
                  </div>
                  <div id="contact-details" class="space-y-2 text-gray-900 dark:text-white font-medium leading-loose">
                      <?php echo $row['kode_mapel'];?> <br />
                      <?php echo $row['nama_mapel'];?> <br />
                      <?php echo $row['kelas'];?> <br />
                      <?php echo $row['ta'];?> <br />
                      <?php echo $row['kkm'];?> 
                  </div>
                  </div>
              </address>

          </div>
          <div class="flex gap-6 items-start mt-8 mb-16 w-full">
            <div class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow rounded-lg p-5">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Detail Pengajar</h2>
            <address class="relative bg-gray-50 dark:bg-gray-700 dark:border-gray-600 p-4 rounded-lg border border-gray-200 not-italic grid grid-cols-2">
                <div class="space-y-2 text-gray-500 dark:text-gray-400 leading-loose hidden sm:block">
                    Nama <br />
                    NIP <br />
                    Jenis Kelamin <br />
                    Jabatan <br />
                    Pendidikan
                </div>
                <?php 
                $queryPengajar = mysqli_query($koneksi, "SELECT * FROM tendik WHERE id= '$row[id_pengajar]'");
                foreach ($queryPengajar as $guru) {
                ?>
                <div id="contact-details" class="space-y-2 text-gray-900 dark:text-white font-medium leading-loose">
                    <?php echo $guru['nama'];?>  <br />
                    <?php echo $guru['nip'];?>  <br />
                    <?php 
                    $jenis_kelamin = $guru['jk'] == 'P' ? 'Perempuan' : 'Laki-Laki';
                    echo $jenis_kelamin;
                    ?>  <br />
                    <?php echo $guru['jabatan'];?> <br />
                    <?php echo $guru['pendidikan'];
                }?>
                </div>
                </div>
            </address>
  
            <div class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow rounded-lg p-5">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Detail Penilai</h2>
            <address class="relative bg-gray-50 dark:bg-gray-700 dark:border-gray-600 p-4 rounded-lg border border-gray-200 not-italic grid grid-cols-2">
                <div class="space-y-2 text-gray-500 dark:text-gray-400 leading-loose hidden sm:block">
                    Nama <br />
                    NIP <br />
                    Jenis Kelamin <br />
                    Jabatan <br />
                    Pendidikan
                </div>
                <div id="contact-details" class="space-y-2 text-gray-900 dark:text-white font-medium leading-loose">
                    <?php echo $row['nama_penilai'];?> <br />
                    <?php echo $row['nip_penilai'];?> <br />
                    <?php 
                    $jenis_kelamin = $row['jk_penilai'] == 'P' ? 'Perempuan' : 'Laki-Laki';
                    echo $jenis_kelamin;
                    ?> <br />
                    <?php echo $row['jabatan_penilai'];?> <br />
                    <?php echo $row['pendidikan_penilai'];?>
                </div>
                </div>
            </address>
          </div>
              
          

        <div class="flex gap-6 items-start mt-8 w-full">
          <div class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow rounded-lg p-5">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Hasil Penilaian</h2>
            <address class="relative bg-gray-50 dark:bg-gray-700 dark:border-gray-600 p-4 rounded-lg border border-gray-200 not-italic grid grid-cols-2">
                <div class="space-y-2 text-gray-500 dark:text-gray-400 leading-loose hidden sm:block">
                    Waktu Penilaian <br />
                    Doc. Penilaian <br />
                    Doc. Remedial <br />
                    Program dilakukan Sesuai dengan Jadwal <br />
                    Program dilakukan dengan Metode yang Beragam  <br />
                    Program dilakukan Secara Berkelanjutan  <br />
                    Hasil Program Mengalami Peningkatan Nilai  <br />
                </div>
                <div id="contact-details" class="space-y-2 text-gray-900 dark:text-white font-medium leading-loose">
                    <?php echo $row['waktu'];?> <br />
                    <a href="../document/penilaian/<?php echo $row['doc_nilai'];?>" target="_blank" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Download</a>  <br />
                    <a href="../document/remedial/<?php echo $row['doc_remedial'];?>" target="_blank" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Download</a>  <br />
                    <?php echo $row['sesuai_jadwal'];?>  <br />
                    <?php echo $row['metode_beragam'];?>  <br />
                    <?php echo $row['berkelanjutan'];?>  <br />
                    <?php echo $row['peningkatan'];?> 
                </div>
                </div>
            </address>
          </div>
        </div>
      </div>
    </div>
  </body>
  <?php }}}
  else {
  echo "<script>
        document.location='penilaian.php';
        </script>";
}?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script>
function validatePassword() {
    var oldPassword = document.getElementById("old_password").value; // Password lama dari input
    var storedPassword = document.getElementById("pass_val").value; // Password lama dari sesi
    var newPassword = document.getElementById("new_password").value; // Password baru
    var confirmPassword = document.getElementById("confirm_password").value; // Konfirmasi password baru
    var errorMessage = document.getElementById("error-message"); // Elemen untuk menampilkan pesan error
    var alertMessage = document.getElementById("alert-message"); // Pesan kesalahan
    var alertTitle = document.getElementById("alert-title"); // Judul pesan kesalahan

    // Reset alert
    alertMessage.textContent = "";
    alertTitle.textContent = "Error!";
    errorMessage.classList.add("hidden"); // Sembunyikan alert

    // Validasi password lama
    if (oldPassword !== storedPassword) {
        alertMessage.textContent = "Old password is incorrect!"; // Tampilkan pesan kesalahan
        errorMessage.classList.remove("hidden"); // Tampilkan alert
        return false;  // Mencegah pengiriman form jika password lama tidak cocok
    }

    // Validasi password baru dan konfirmasi password
    if (newPassword !== confirmPassword) {
        alertMessage.textContent = "New password and confirmation password do not match!"; // Tampilkan pesan kesalahan
        errorMessage.classList.remove("hidden"); // Tampilkan alert
        return false;  // Mencegah pengiriman form jika password baru dan konfirmasi tidak cocok
    }

    // Jika semua validasi lulus
    errorMessage.classList.add("hidden"); // Sembunyikan pesan kesalahan
    return true;  // Mengizinkan form dikirim
}
</script>
</html>
