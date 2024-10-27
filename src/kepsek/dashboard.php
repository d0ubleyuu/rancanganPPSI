<?php

// Include Koneksi.php
require_once '../koneksi.php';
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
}

$id_sekolah = $_SESSION['id_sekolah'];
$query2 = "SELECT COUNT(*) as totalGuru FROM tendik WHERE jabatan = 'Guru' AND id_sekolah = '$id_sekolah'";
$result2 = mysqli_query($koneksi, $query2);
$row2 = mysqli_fetch_assoc($result2);
$jumlah_guru = $row2['totalGuru'];

$query4 = "SELECT COUNT(*) as totalPengawas FROM tendik WHERE jabatan = 'Pengawas' AND id_sekolah = '$id_sekolah'";
$result4 = mysqli_query($koneksi, $query4);
$row4 = mysqli_fetch_assoc($result4);
$jumlah_pengawas = $row4['totalPengawas'];


$query5 = "SELECT COUNT(*) as totalMapel FROM mapel JOIN tendik ON mapel.id_guru = tendik.id WHERE tendik.id_sekolah = '$id_sekolah'";
$result5 = mysqli_query($koneksi, $query5);
$row5 = mysqli_fetch_assoc($result5);
$jumlah_mapel = $row5['totalMapel'];

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Dashboard | Sistem Informasi Mutu Program Remedial dan Pengayaan</title>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                        <button type="submit" nama="btn_change_pass" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Change Password</button>
                        
                      </form>
                      </div>
                  </div>
              </div>
          </div> 
          </div>
        </div>
      </div>
    </nav>

    <aside
      id="logo-sidebar"
      class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
      aria-label="Sidebar"
    >
      <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
          <li>
            <a
              href="dashboard.php"
              class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
            >
              <svg
                class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 22 21"
              >
                <path
                  d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"
                />
                <path
                  d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"
                />
              </svg>
              <span class="ms-3">Dashboard</span>
            </a>
          </li>
          <li>
            <a
              href="penilaian.php"
              class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
            >
              <svg
                class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                aria-hidden="true"
                viewBox="0 0 24 24"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M6.271 2.112C5.461 2.218 5.033 2.413 4.727 2.712C4.422 3.012 4.223 3.432 4.114 4.225C4.002 5.042 4 6.124 4 7.675V16.245C4.39598 15.9746 4.83533 15.7741 5.299 15.652C5.827 15.513 6.443 15.513 7.346 15.514H20V7.676C20 6.124 19.998 5.042 19.886 4.225C19.777 3.432 19.578 3.012 19.273 2.712C18.967 2.413 18.539 2.218 17.729 2.112C16.895 2.002 15.791 2 14.207 2H9.793C8.209 2 7.105 2.002 6.271 2.112ZM6.759 6.595C6.759 6.147 7.129 5.784 7.586 5.784H16.414C16.631 5.78213 16.8398 5.86633 16.9948 6.01815C17.1498 6.16997 17.2384 6.37704 17.241 6.594C17.2386 6.81113 17.1502 7.01846 16.9952 7.17049C16.8401 7.32253 16.6311 7.40687 16.414 7.405H7.586C7.36903 7.40687 7.16017 7.32267 7.00516 7.17085C6.85016 7.01903 6.76164 6.81196 6.759 6.595ZM7.586 9.568C7.36903 9.56613 7.16017 9.65033 7.00516 9.80215C6.85016 9.95397 6.76164 10.161 6.759 10.378C6.759 10.826 7.129 11.189 7.586 11.189H13.103C13.3201 11.1911 13.5293 11.1071 13.6845 10.9552C13.8397 10.8034 13.9284 10.5961 13.931 10.379C13.9286 10.1617 13.8401 9.95422 13.6848 9.80215C13.5296 9.65008 13.3203 9.56587 13.103 9.568H7.586Z"
                />
                <path
                  d="M7.473 17.135H20C19.997 18.265 19.979 19.109 19.887 19.775C19.778 20.568 19.579 20.988 19.274 21.288C18.968 21.587 18.54 21.782 17.73 21.888C16.896 21.998 15.792 22 14.208 22H9.793C8.209 22 7.105 21.998 6.271 21.889C5.461 21.782 5.033 21.587 4.727 21.288C4.422 20.988 4.223 20.568 4.114 19.775C4.073 19.475 4.046 19.138 4.03 18.755C4.16706 18.3804 4.39315 18.0448 4.68879 17.777C4.98442 17.5093 5.34072 17.3174 5.727 17.218C6.017 17.142 6.394 17.135 7.473 17.135Z"
                />
              </svg>
              <span class="flex-1 ms-3 whitespace-nowrap">Penilaian</span>
            </a>
          </li>
        </ul>
      </div>
    </aside>
    <div class="p-4 sm:ml-64">
      <div
        class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 mb-4"
      >
        <div class="">
          <h2 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">👋Welcome, <?=$_SESSION['nama']?>!</h2>
        </div>
        <div class="mt-12 mb-6 grid gap-y-10 gap-x-6 sm:grid-cols-1 lg:grid-cols-3 ">
          <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
            <div class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-green-600 to-green-400 text-white shadow-green-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-6 h-6 text-white">
                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <div class="p-4 text-right">
              <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">Pengawas</p>
              <h4 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900"><?= $jumlah_pengawas?></h4>
            </div>
          </div>
          <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
            <div class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-orange-600 to-orange-400 text-white shadow-orange-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-6 h-6 text-white">
                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <div class="p-4 text-right">
              <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">Guru</p>
              <h4 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900"><?= $jumlah_guru?></h4>
            </div>
          </div>
          <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
            <div class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-rose-600 to-rose-400 text-white shadow-rose-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-6 h-6 text-white">
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M6.271 2.112C5.461 2.218 5.033 2.413 4.727 2.712C4.422 3.012 4.223 3.432 4.114 4.225C4.002 5.042 4 6.124 4 7.675V16.245C4.39598 15.9746 4.83533 15.7741 5.299 15.652C5.827 15.513 6.443 15.513 7.346 15.514H20V7.676C20 6.124 19.998 5.042 19.886 4.225C19.777 3.432 19.578 3.012 19.273 2.712C18.967 2.413 18.539 2.218 17.729 2.112C16.895 2.002 15.791 2 14.207 2H9.793C8.209 2 7.105 2.002 6.271 2.112ZM6.759 6.595C6.759 6.147 7.129 5.784 7.586 5.784H16.414C16.631 5.78213 16.8398 5.86633 16.9948 6.01815C17.1498 6.16997 17.2384 6.37704 17.241 6.594C17.2386 6.81113 17.1502 7.01846 16.9952 7.17049C16.8401 7.32253 16.6311 7.40687 16.414 7.405H7.586C7.36903 7.40687 7.16017 7.32267 7.00516 7.17085C6.85016 7.01903 6.76164 6.81196 6.759 6.595ZM7.586 9.568C7.36903 9.56613 7.16017 9.65033 7.00516 9.80215C6.85016 9.95397 6.76164 10.161 6.759 10.378C6.759 10.826 7.129 11.189 7.586 11.189H13.103C13.3201 11.1911 13.5293 11.1071 13.6845 10.9552C13.8397 10.8034 13.9284 10.5961 13.931 10.379C13.9286 10.1617 13.8401 9.95422 13.6848 9.80215C13.5296 9.65008 13.3203 9.56587 13.103 9.568H7.586Z"
                />
                <path
                  d="M7.473 17.135H20C19.997 18.265 19.979 19.109 19.887 19.775C19.778 20.568 19.579 20.988 19.274 21.288C18.968 21.587 18.54 21.782 17.73 21.888C16.896 21.998 15.792 22 14.208 22H9.793C8.209 22 7.105 21.998 6.271 21.889C5.461 21.782 5.033 21.587 4.727 21.288C4.422 20.988 4.223 20.568 4.114 19.775C4.073 19.475 4.046 19.138 4.03 18.755C4.16706 18.3804 4.39315 18.0448 4.68879 17.777C4.98442 17.5093 5.34072 17.3174 5.727 17.218C6.017 17.142 6.394 17.135 7.473 17.135Z"
                />
              </svg>
            </div>
            <div class="p-4 text-right">
              <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">Mata Pelajaran</p>
              <h4 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900"><?= $jumlah_mapel?></h4>
            </div>
          </div>
        </div>
        <div class="mb-12 lg:mb-3 grid gap-y-3 gap-x-6 sm:grid-cols-1 lg:grid-cols-4">
          <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 bg-gray-50 dark:bg-gray-800 w-full shadow-md rounded-xl">
            <div class="rounded-t mb-0 px-0 border-0">
              <div class="flex flex-wrap items-center px-4 py-2">
                <div class="relative w-full max-w-full flex-grow flex-1">
                  <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Progres Penilaian</h3>
                </div>
              </div>
            </div>
            <div class="flex w-full justify-center overflow-x-auto">
            <?php
              $id_sekolah = $_SESSION['id_sekolah'];
              $length_data1 = 0;
              $length_data2 = 0;
              $total_length_data = 0;
              try {
                $query8 = "SELECT COUNT(*) AS total_baris FROM penilaian_mutu 
                            JOIN tendik ON penilaian_mutu.id_kepsek = tendik.id 
                            JOIN sekolah ON tendik.id_sekolah = sekolah.id 
                            WHERE sekolah.id LIKE '$id_sekolah'";
                $result8 = mysqli_query($koneksi, $query8);
                $row8 = mysqli_fetch_assoc($result8);
                $length_data1 = $row8['total_baris'];
              } catch (\Throwable $th) {
                $length_data1 = 0;
              }

              try {
                $query9 = "SELECT COUNT(*) AS total_baris FROM mapel JOIN tendik ON mapel.id_guru = tendik.id JOIN sekolah ON tendik.id_sekolah = sekolah.id WHERE sekolah.id LIKE '$id_sekolah'";
                $result9 = mysqli_query($koneksi, $query9);
                $row9 = mysqli_fetch_assoc($result9);
                $total_length_data = $row9['total_baris'];
                $length_data2 = $total_length_data - $length_data1;
              } catch (\Throwable $th) {
                $total_length_data = 0;
                $length_data2 = $total_length_data - $length_data1;
              }

              try {
                $persentase = $length_data1/$length_data2 * 100;
              } catch (\Throwable $th) {
                $persentase = 0;
              }
            ?>
            <canvas id="dataChart" class="w-full h-full p-3 lg:p-6"></canvas>
            <script>
              // Data PHP yang dikirimkan ke JavaScript
              const lengthData1 = <?php echo $length_data1; ?>;
              const lengthData2 = <?php echo $length_data2; ?>;
              
              const ctx = document.getElementById('dataChart').getContext('2d');

              // Membuat gradient untuk setiap bagian pie chart
              const gradient1 = ctx.createLinearGradient(0, 0, 400, 400); // Gradient untuk data pertama
              gradient1.addColorStop(0, 'rgba(49, 196, 141, 1)');
              gradient1.addColorStop(1, 'rgba(5, 122, 85, 1)');

              const gradient2 = ctx.createLinearGradient(0, 0, 400, 400); // Gradient untuk data kedua
              gradient2.addColorStop(0, 'rgba(251, 113, 133, 1)');
              gradient2.addColorStop(1, 'rgba(255, 29, 72, 1)');

              // Chart.plugins.register({
              //     beforeDraw: function(chart) {
              //         const ctx = chart.chart.ctx;
              //         ctx.save();
              //         ctx.shadowColor = 'rgba(0, 0, 0, 0.3)'; // Warna shadow (shadow hitam dengan transparansi 30%)
              //         ctx.shadowBlur = 20; // Tingkat blur shadow
              //         ctx.shadowOffsetX = 10; // Offset horizontal shadow
              //         ctx.shadowOffsetY = 10; // Offset vertikal shadow
              //         ctx.restore();
              //     }
              // });
              const dataChart = new Chart(ctx, {
                  type: 'pie', // Menampilkan pie chart
                  data: {
                      labels: ['Sudah Dinilai', 'Belum Dinilai'], // Label untuk tiap bagian pie chart
                      datasets: [{
                          label: 'Total Data',
                          data: [lengthData1, lengthData2], // Data dari PHP
                          backgroundColor: [
                            gradient1, // Gradient untuk Length Data 1
                            gradient2 // Warna bagian Length Data 2
                          ],
                          borderColor: [
                              'rgba(75, 192, 192, 1)',
                              'rgba(255, 99, 132, 1)'
                          ],
                          borderWidth: 1
                      }]
                  },
                  options: {
                      responsive: true,
                      plugins: {
                          legend: {
                              position: 'top', // Posisi legenda
                          },
                          tooltip: {
                              callbacks: {
                                  label: function(context) {
                                      let label = context.label || '';
                                      let value = context.raw || 0;
                                      return `${label}: ${value}`;
                                  }
                              }
                          }
                      }
                  }
              });
            </script>
              </div>
            </div>
            <div class="relative flex flex-col lg:col-span-3 min-w-0 mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-md rounded-xl">
              <div class="rounded-t mb-0 px-0 border-0">
                <div class="flex flex-wrap items-center px-4 py-2">
                  <div class="relative w-full max-w-full flex-grow flex-1">
                    <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Status Penilaian</h3>
                  </div>
                  <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                    <a href="penilaian.php" class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">See More</a>
                  </div>
                </div>
                <div class="block w-full overflow-x-auto">
                  <table class="items-center w-full bg-transparent border-collapse">
                    <thead>
                      <tr>
                        <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Nama</th>
                        <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">TA</th>
                        <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Document</th>
                        <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Penilaian</th>
                        <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Mutu</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $query7 = "SELECT * FROM mapel LIMIT 5";
                        $result7 = mysqli_query($koneksi, $query7);
                        while ($row7 = mysqli_fetch_array($result7)) {
                      ?>
                      <tr class="text-gray-700 dark:text-gray-100">
                        <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left"><?= $row7['nama']?></th>
                        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left"><?= $row7['ta']?></th>
                        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                          <?php
                            $id_mapel = $row7['id'];
                            $sql_doc = "SELECT COUNT(*) as check_doc FROM document WHERE id_mapel = '$id_mapel'";
                            $rst_doc = mysqli_query($koneksi, $sql_doc);
                            $row_doc = mysqli_fetch_assoc($rst_doc);
                                                        
                            $biru = ($row_doc['check_doc'] > 0) ? ' class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"' : '';
                            $abu = ($row_doc['check_doc'] == 0) ? ' class="bg-slate-100 text-slate-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-slate-900 dark:text-slate-300"' : '';
                          ?>
                          <span <?php echo $biru; echo $abu;?> class="">
                            <?= ($row_doc['check_doc']==0) ? 'Not Ready' : 'Ready';?>
                          </span>
                        </td>
                        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                          <?php
                            $id_mapel = $row7['id'];
                            $sql_asses = "SELECT COUNT(*) as check_asses FROM penilaian_mutu WHERE id_mapel = '$id_mapel'";
                            $rst_asses = mysqli_query($koneksi, $sql_asses);
                            $row_asses = mysqli_fetch_assoc($rst_asses);
                                                        
                            $biru = ($row_asses['check_asses'] > 0) ? ' class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"' : '';
                            $abu = ($row_asses['check_asses'] == 0) ? ' class="bg-slate-100 text-slate-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-slate-900 dark:text-slate-300"' : '';
                          ?>
                          <span <?php echo $biru; echo $abu;?> class="">
                            <?= ($row_asses['check_asses']==0) ? 'Not Assessed' : 'Assessed';?>
                          </span>
                        </td>
                        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                          <div class="flex flex-row">
                            <?php
                              for ($i = 0; $i  < 4; $i++) {
                                if ($i < $row7['mutu']) {
                                  echo '
                                      <svg
                                        aria-hidden="true"
                                        class="w-5 h-5 text-yellow-400"
                                        fill="currentColor"
                                        viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                      >
                                        <path
                                          d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                        />
                                      </svg>';
                                } else {
                                  echo '
                                      <svg
                                        aria-hidden="true"
                                        class="w-5 h-5 text-gray-400"
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
                          </div>
                        </td>
                      </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></s>
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
  </body>
</html>
