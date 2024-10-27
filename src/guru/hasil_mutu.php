<?php
include("../koneksi.php");
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['pass_val']) && isset($_POST['old_password']) && isset($_POST['new_password'])) {
    $id = $_POST['id'];
    $new_pass = $_POST['new_password'];
    $queryEdit = "UPDATE tendik SET password = '$new_pass' WHERE tendik.id = $id";
    $edit = mysqli_query($koneksi, $queryEdit);
    try {
      if ($edit)
      {
        $status = "success";
        $message = "Password berhasil diubah!";
      } else {
        $status = "error";
        $message = "Password gagal diubah";
      } 
    } catch (\Throwable $th) {
      $status = "error";
      $message = "Password gagal diubah";
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
    <title>Hasil Penilaian | Sistem Informasi Mutu Program Remedial dan Pengayaan</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="..\css\output.css" rel="stylesheet" />
    <script src="node_modules\flowbite\dist\flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-minimal@4/minimal.css" rel="stylesheet">
    <!-- <link
      href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"
      rel="stylesheet"
    /> -->
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
            window.location.href = "../../index.php";
        });
    });
<?php endif; ?>
</script>
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
                >SIMAPREM</span
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
      <h1 class="mb-4 text-2xl text-center font-extrabold leading-5 tracking-tight text-gray-900 md:text-4xl lg:text-6 dark:text-white">Hasil Penilaian Capaian Program <span class="text-blue-600 dark:text-blue-500">Remedial dan Pengayaan</span> </h1>
        <div class="flex items-center mt-8">
        <?php 
          for ($i = 0; $i  < 4; $i++) {
            if($i < $row['mutu']){
              echo '
              <svg
                aria-hidden="true"
                class="w-8 h-8 md:w-14 md:h-14 lg:w-16 lg:h-16 text-yellow-400"
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
                class="w-8 h-8 md:w-14 md:h-14 lg:w-16 lg:h-16 text-gray-400"
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
        <span class="text-xl md:text-3xl lg:text-4xl text-gray-500 dark:text-gray-400 ml-4"
          ><?php echo $row['mutu'];?>.0</span
        >
        </div>

        <div class="flex flex-col lg:flex-row gap-6 items-start mt-8 w-full">
          
          <div class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow rounded-lg p-5">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-5">Detail Sekolah</h2>
            <div class="block w-full overflow-x-auto">
              <table class="items-center w-full relative bg-gray-50 dark:bg-gray-700 dark:border-gray-600 p-4 rounded-lg border border-gray-200">
                <tbody>
                  <tr class="text-gray-700 dark:text-gray-100">
                    <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">Nama</td>
                    <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left"><?php echo $row['nama_sekolah'];?></th>
                  </tr>
                  <tr class="text-gray-700 dark:text-gray-100">
                    <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">NPSN</td>
                    <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left"><?php echo $row['npsm_sekolah'];?></th>
                  </tr>
                  <tr class="text-gray-700 dark:text-gray-100">
                    <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">Status</td>
                    <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left"><?php echo $row['status_sekolah'];?></th>
                  </tr>
                  <tr class="text-gray-700 dark:text-gray-100">
                    <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">Jenjang</td>
                    <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left"><?php echo $row['bp_sekolah'];?></th>
                  </tr>
                  <tr class="text-gray-700 dark:text-gray-100">
                    <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">Akreditasi</td>
                    <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">
                      <?php 
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
                        echo $akreditasi_sekolah;
                      ?>
                    </th>
                  </tr>
                </tbody>
              </table>    
            </div>
          </div>

          <div class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow rounded-lg p-5">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-5">Detail Sekolah</h2>
            <div class="block w-full overflow-x-auto">
              <table class="items-center w-full relative bg-gray-50 dark:bg-gray-700 dark:border-gray-600 p-4 rounded-lg border border-gray-200">
                <tbody>
                  <tr class="text-gray-700 dark:text-gray-100">
                    <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">Kode</td>
                    <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left"><?php echo $row['kode_mapel'];?></th>
                  </tr>
                  <tr class="text-gray-700 dark:text-gray-100">
                    <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">Nama</td>
                    <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left"><?php echo $row['nama_mapel'];?></th>
                  </tr>
                  <tr class="text-gray-700 dark:text-gray-100">
                    <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">Kelas</td>
                    <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left"><?php echo $row['kelas'];?></th>
                  </tr>
                  <tr class="text-gray-700 dark:text-gray-100">
                    <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">TA</td>
                    <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left"><?php echo $row['ta'];?></th>
                  </tr>
                  <tr class="text-gray-700 dark:text-gray-100">
                    <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">KKM</td>
                    <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left"><?php echo $row['kkm'];?></th>
                  </tr>
                </tbody>
              </table>    
            </div>
          </div>

        </div>
          <div class="flex flex-col lg:flex-row gap-6 items-start mt-6 w-full">
            <div class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow rounded-lg p-5">
              <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-5">Detail Pengajar</h2>
              <div class="block w-full overflow-x-auto">
                <table class="items-center w-full relative bg-gray-50 dark:bg-gray-700 dark:border-gray-600 p-4 rounded-lg border border-gray-200">
                  <tbody>
                    <?php 
                      $queryPengajar = mysqli_query($koneksi, "SELECT * FROM tendik WHERE id= '$row[id_pengajar]'");
                      foreach ($queryPengajar as $guru) {
                    ?>
                    <tr class="text-gray-700 dark:text-gray-100">
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">Nama</td>
                      <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left"><?= $guru['nama']?></th>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-100">
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">NIP</td>
                      <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left"><?= $guru['nip']?></th>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-100">
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">JK</td>
                      <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">
                        <?php 
                          $jenis_kelamin = $guru['jk']== 'P' ? 'Perempuan' : 'Laki-Laki';
                          echo $jenis_kelamin;
                        ?>  
                      </th>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-100">
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">Jabatan</td>
                      <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left"><?= $guru['jabatan']?></th>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-100">
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">Pendidikan</td>
                      <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left"><?=$guru['pendidikan'];}?></th>
                    </tr>
                  </tbody>
                </table>    
              </div>
            </div>
            
            <div class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow rounded-lg p-5">
              <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-5">Detail Penilai</h2>
              <div class="block w-full overflow-x-auto">
                <table class="items-center w-full relative bg-gray-50 dark:bg-gray-700 dark:border-gray-600 p-4 rounded-lg border border-gray-200">
                  <tbody>
                    <?php 
                      $queryPengajar = mysqli_query($koneksi, "SELECT * FROM tendik WHERE id= '$row[id_pengajar]'");
                      foreach ($queryPengajar as $guru) {
                    ?>
                    <tr class="text-gray-700 dark:text-gray-100">
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">Nama</td>
                      <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left"><?= $row['nama_penilai']?></th>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-100">
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">NIP</td>
                      <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left"><?= $row['nip_penilai']?></th>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-100">
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">JK</td>
                      <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">
                        <?php 
                          $jenis_kelamin = $row['jk_penilai'] == 'P' ? 'Perempuan' : 'Laki-Laki';
                          echo $jenis_kelamin;
                        ?>  
                      </th>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-100">
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">Jabatan</td>
                      <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left"><?= $row['jabatan_penilai']?></th>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-100">
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">Pendidikan</td>
                      <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left"><?=$row['pendidikan_penilai'];}?></th>
                    </tr>
                  </tbody>
                </table>    
              </div>
            </div>
          </div>
              
          

        <div class="flex gap-6 items-start mt-6 w-full">
          <div class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow rounded-lg p-5">
              <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-5">Hasil Penilaian</h2>
              <div class="block w-full overflow-x-auto">
                <table class="items-center w-full relative bg-gray-50 dark:bg-gray-700 dark:border-gray-600 p-4 rounded-lg border border-gray-200">
                  <tbody>
                    <tr class="text-gray-700 dark:text-gray-100">
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">Waktu Penilaian</td>
                      <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left"><?php echo $row['waktu'];?></th>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-100">
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">Doc. Penilaian</td>
                      <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">
                        <a href="../document/penilaian/<?php echo $row['doc_nilai'];?>" target="_blank" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Download Doc Penilaian</a>   
                      </th>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-100">
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">Doc. Remedial</td>
                      <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">
                        <a href="../document/remedial/<?php echo $row['doc_remedial'];?>" target="_blank" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Download Doc Remedial</a>  
                      </th>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-100">
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">Program dilakukan Sesuai dengan Jadwal</td>
                      <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">
                        <?php 
                          $answers = $row['sesuai_jadwal']== 0 ? 'Tidak' : 'Iyaa';
                          echo $answers;
                        ?>   
                      </th>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-100">
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">Program dilakukan dengan Metode yang Beragam</td>
                      <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">
                        <?php 
                          $answers = $row['metode_beragam']== 0 ? 'Tidak' : 'Iyaa';
                          echo $answers;
                        ?>   
                      </th>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-100">
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">Program dilakukan Secara Berkelanjutan</td>
                      <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">
                        <?php 
                          $answers = $row['berkelanjutan']== 0 ? 'Tidak' : 'Iyaa';
                          echo $answers;
                        ?>   
                      </th>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-100">
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">Hasil Program Mengalami Peningkatan Nilai</td>
                      <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-sm md:text-base whitespace-nowrap p-4 text-left">
                        <?php 
                          $answers = $row['peningkatan']== 0 ? 'Tidak' : 'Iyaa';
                          echo $answers;
                        ?>   
                      </th>
                    </tr>
                  </tbody>
                </table>    
              </div>
            </div>
          </div>
          <div class="flex w-full mt-10 px-6">
            <a href="dashboard.php" class="text-white w-full transition bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 hover:shadow-lg hover:-translate-y-1 hover:shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm lg:text-lg px-5 py-3 text-center me-2 mb-2 ">Back Menu</a>
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
