<?php

// Include Koneksi.php
require_once '../koneksi.php';
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

$query1 = "SELECT COUNT(*) as totalSekolah FROM sekolah";
$result1 = mysqli_query($koneksi, $query1);
$row1 = mysqli_fetch_assoc($result1);
$jumlah_sekolah = $row1['totalSekolah'];

$query2 = "SELECT COUNT(*) as totalGuru FROM tendik WHERE jabatan = 'Guru'";
$result2 = mysqli_query($koneksi, $query2);
$row2 = mysqli_fetch_assoc($result2);
$jumlah_guru = $row2['totalGuru'];

$query3 = "SELECT COUNT(*) as totalKepsek FROM tendik WHERE jabatan = 'Kepsek'";
$result3 = mysqli_query($koneksi, $query3);
$row3 = mysqli_fetch_assoc($result3);
$jumlah_kepsek = $row3['totalKepsek'];

$query4 = "SELECT COUNT(*) as totalPengawas FROM tendik WHERE jabatan = 'Pengawas'";
$result4 = mysqli_query($koneksi, $query4);
$row4 = mysqli_fetch_assoc($result4);
$jumlah_pengawas = $row4['totalPengawas'];


$query5 = "SELECT COUNT(*) as totalMapel FROM mapel";
$result5 = mysqli_query($koneksi, $query5);
$row5 = mysqli_fetch_assoc($result5);
$jumlah_mapel = $row5['totalMapel'];



// Query SQL untuk mengambil satu row berdasarkan ID, misalnya

$query7 = "SELECT * FROM tendik WHERE id = 1";

$result7 = mysqli_query($koneksi, $query7);

if (mysqli_num_rows($result7) > 0) {
  $row7 = mysqli_fetch_assoc($result7);;
} else {
  echo "Tidak ada data ditemukan";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Dashboard | Sistem Informasi Mutu Program Remedial dan Pengayaan</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="..\css\output.css" rel="stylesheet" />
    <script src="node_modules\flowbite\dist\flowbite.min.js"></script>
    <!-- <link
      href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"
      rel="stylesheet"
    /> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
              href="sekolah.php"
              class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
            >
              <svg
                class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                fill="currentColor "
                viewBox="0 0 640 512"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M337.8 5.4C327 -1.8 313 -1.8 302.2 5.4L166.3 96H48C21.5 96 0 117.5 0 144V464C0 490.5 21.5 512 48 512H256V416C256 380.7 284.7 352 320 352C355.3 352 384 380.7 384 416V512H592C618.5 512 640 490.5 640 464V144C640 117.5 618.5 96 592 96H473.7L337.8 5.4ZM96 192H128C136.8 192 144 199.2 144 208V272C144 280.8 136.8 288 128 288H96C87.2 288 80 280.8 80 272V208C80 199.2 87.2 192 96 192ZM496 208C496 199.2 503.2 192 512 192H544C552.8 192 560 199.2 560 208V272C560 280.8 552.8 288 544 288H512C503.2 288 496 280.8 496 272V208ZM96 320H128C136.8 320 144 327.2 144 336V400C144 408.8 136.8 416 128 416H96C87.2 416 80 408.8 80 400V336C80 327.2 87.2 320 96 320ZM496 336C496 327.2 503.2 320 512 320H544C552.8 320 560 327.2 560 336V400C560 408.8 552.8 416 544 416H512C503.2 416 496 408.8 496 400V336ZM232 176C232 152.661 241.271 130.278 257.775 113.775C274.278 97.2714 296.661 88 320 88C343.339 88 365.722 97.2714 382.225 113.775C398.729 130.278 408 152.661 408 176C408 199.339 398.729 221.722 382.225 238.225C365.722 254.729 343.339 264 320 264C296.661 264 274.278 254.729 257.775 238.225C241.271 221.722 232 199.339 232 176ZM320 128C311.2 128 304 135.2 304 144V176C304 184.8 311.2 192 320 192H352C360.8 192 368 184.8 368 176C368 167.2 360.8 160 352 160H336V144C336 135.2 328.8 128 320 128Z"
                />
              </svg>

              <span class="flex-1 ms-3 whitespace-nowrap">Sekolah</span>
            </a>
          </li>
          <li>
            <a
              href="tendik.php"
              class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
            >
              <svg
                class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                aria-hidden="true"
                viewBox="0 0 16 16"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M8 8C10.21 8 12 6.21 12 4C12 1.79 10.21 0 8 0C5.79 0 4 1.79 4 4C4 6.21 5.79 8 8 8ZM8 10C5.33 10 0 11.34 0 14V15C0 15.55 0.45 16 1 16H15C15.55 16 16 15.55 16 15V14C16 11.34 10.67 10 8 10Z"
                />
              </svg>

              <span class="flex-1 ms-3 whitespace-nowrap">Guru dan Tendik</span>
            </a>
          </li>
          <li>
            <a
              href="mapel.php"
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
              <span class="flex-1 ms-3 whitespace-nowrap">Mata Pelajaran</span>
            </a>
          </li>
        </ul>
      </div>
    </aside>
    <div class="p-4 sm:ml-64">
      <div
        class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 mb-4"
      >
        <div>
          <h2 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">👋Welcome, <?=$_SESSION['nama']?>!</h2>
        </div>
        <div class="mt-12">
      <div class="mb-6 grid gap-y-10 gap-x-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-5">
        <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
          <div class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-blue-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
            <svg width="20" height="16" viewBox="0 0 20 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white">
             <path d="M10.5562 0.16875C10.2187 -0.05625 9.78125 -0.05625 9.44375 0.16875L5.19688 3H1.5C0.671875 3 0 3.67188 0 4.5V14.5C0 15.3281 0.671875 16 1.5 16H8V13C8 11.8969 8.89688 11 10 11C11.1031 11 12 11.8969 12 13V16H18.5C19.3281 16 20 15.3281 20 14.5V4.5C20 3.67188 19.3281 3 18.5 3H14.8031L10.5562 0.16875ZM3 6H4C4.275 6 4.5 6.225 4.5 6.5V8.5C4.5 8.775 4.275 9 4 9H3C2.725 9 2.5 8.775 2.5 8.5V6.5C2.5 6.225 2.725 6 3 6ZM15.5 6.5C15.5 6.225 15.725 6 16 6H17C17.275 6 17.5 6.225 17.5 6.5V8.5C17.5 8.775 17.275 9 17 9H16C15.725 9 15.5 8.775 15.5 8.5V6.5ZM3 10H4C4.275 10 4.5 10.225 4.5 10.5V12.5C4.5 12.775 4.275 13 4 13H3C2.725 13 2.5 12.775 2.5 12.5V10.5C2.5 10.225 2.725 10 3 10ZM15.5 10.5C15.5 10.225 15.725 10 16 10H17C17.275 10 17.5 10.225 17.5 10.5V12.5C17.5 12.775 17.275 13 17 13H16C15.725 13 15.5 12.775 15.5 12.5V10.5ZM7.25 5.5C7.25 4.77065 7.53973 4.07118 8.05546 3.55546C8.57118 3.03973 9.27065 2.75 10 2.75C10.7293 2.75 11.4288 3.03973 11.9445 3.55546C12.4603 4.07118 12.75 4.77065 12.75 5.5C12.75 6.22935 12.4603 6.92882 11.9445 7.44454C11.4288 7.96027 10.7293 8.25 10 8.25C9.27065 8.25 8.57118 7.96027 8.05546 7.44454C7.53973 6.92882 7.25 6.22935 7.25 5.5ZM10 4C9.725 4 9.5 4.225 9.5 4.5V5.5C9.5 5.775 9.725 6 10 6H11C11.275 6 11.5 5.775 11.5 5.5C11.5 5.225 11.275 5 11 5H10.5V4.5C10.5 4.225 10.275 4 10 4Z"/>
            </svg>
          </div>
          <div class="p-4 text-right">
            <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">Sekolah</p>
            <h4 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900"><?= $jumlah_sekolah ?></h4>
          </div>
        </div>
        <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
          <div class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-pink-600 to-pink-400 text-white shadow-pink-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-6 h-6 text-white">
              <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd"></path>
            </svg>
          </div>
          <div class="p-4 text-right">
            <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">Kepala Sekolah</p>
            <h4 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900"><?= $jumlah_kepsek?></h4>
          </div>
        </div>
        <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
          <div class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-green-600 to-green-400 text-white shadow-green-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-6 h-6 text-white">
              <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd"></path>
            </svg>
          </div>
          <div class="p-4 text-right">
            <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">Pengawas</p>
            <h4 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900"><?= $jumlah_kepsek?></h4>
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
      <div class="mb-12 grid gap-y-10 gap-x-6 sm:grid-cols-1 lg:grid-cols-4">
        <div class="relative flex flex-col lg:col-span-3 min-w-0 mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-md rounded-xl">
            <div class="rounded-t mb-0 px-0 border-0">
              <div class="flex flex-wrap items-center px-4 py-2">
                <div class="relative w-full max-w-full flex-grow flex-1">
                  <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Progres Penilaian</h3>
                </div>
                <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                  <a href="sekolah.php" class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">See More</a>
                </div>
              </div>
              <div class="block w-full overflow-x-auto">
                <table class="items-center w-full bg-transparent border-collapse">
                  <thead>
                    <tr>
                      <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Nama</th>
                      <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Jenjang</th>
                      <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Akreditasi</th>
                      <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $query7 = "SELECT * FROM sekolah LIMIT 5";
                      $result7 = mysqli_query($koneksi, $query7);
                      while ($row7 = mysqli_fetch_array($result7)) {
                    ?>
                    <tr class="text-gray-700 dark:text-gray-100">
                      <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left"><?= $row7['nama']?></th>
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left"><?= $row7['bp']?></th>
                      <?php 
                        $ijo = ($row7['akreditasi'] == 'A') ? ' class="bg-green-100 text-green-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-green-900 dark:text-green-300"' : '';
                        $biru = ($row7['akreditasi'] == 'B') ? ' class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"' : '';
                        $merah = ($row7['akreditasi'] == 'C') ? ' class="bg-red-100 text-red-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-red-900 dark:text-red-300"' : '';
                        $abu = ($row7['akreditasi'] == 'TT') ? ' class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-gray-900 dark:text-gray-300"' : '';
                      ?>
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                      <span <?php echo $ijo; echo $biru; echo $abu; echo $merah;?> class="">
                          <?=$row7['akreditasi']?> 
                        </span>
                      </td>
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        <div class="flex items-center">
                            <?php 
                              $id_sekolah = $row7['id'];
                              $length_data1 = 0;
                              $length_data2 = 0;
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
                                $length_data2 = $row9['total_baris'];
                              } catch (\Throwable $th) {
                                $length_data2 = 0;
                              }

                              try {
                                $persentase = $length_data1/$length_data2 * 100;
                              } catch (\Throwable $th) {
                                $persentase = 0;
                              }
                            ?>
                          <span class="mr-2"><?=$persentase?>%</span>
                          <div class="relative min-w-12 w-full">
                            <div class="overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                              <div style="width: <?=$persentase?>%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-600"></div>
                            </div>
                          </div>
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
          <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 bg-gray-50 dark:bg-gray-800 w-full shadow-md rounded-xl">
            <div class="rounded-t mb-0 px-0 border-0">
              <div class="flex flex-wrap items-center px-4 py-2">
                <div class="relative w-full max-w-full flex-grow flex-1">
                  <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Diagram Jenjang Pendidikan</h3>
                </div>
              </div>
            </div>
            <div class="flex w-full justify-center overflow-x-auto">
            <?php
              $query10 = "
                  SELECT bp, COUNT(id) AS total_sekolah
                  FROM sekolah
                  GROUP BY bp
              ";
              $result10 = $koneksi->query($query10);
              
              // Simpan data dalam array untuk Chart.js
              $data10 = [];
              while ($row = $result10->fetch_assoc()) {
                  $data10[] = $row;
              }
            ?>
            <canvas id="sekolahChart" class="w-full h-full p-4"></canvas>
            <script>
                // Ambil data dari PHP
                const dataSekolah = <?php echo json_encode($data10); ?>;

                // Pisahkan data untuk Chart.js
                const labels = [];
                const sekolahData = [];

                dataSekolah.forEach(item => {
                    labels.push(item.bp); // Menyimpan kategori BP (SD, SMP, SMA, SMK)
                    sekolahData.push(item.total_sekolah); // Menyimpan jumlah sekolah untuk tiap BP
                });

                const ctx = document.getElementById('sekolahChart').getContext('2d');
                const sekolahChart = new Chart(ctx, {
                    type: 'pie', // Menggunakan pie chart
                    data: {
                        labels: labels, // Label BP (SD, SMP, SMA, SMK)
                        datasets: [{
                            label: 'Jumlah Sekolah',
                            data: sekolahData,
                            backgroundColor: [
                                'rgba(118, 169, 250, 1)', // Warna untuk setiap kategori
                                'rgba(241, 126, 184, 1)',
                                'rgba(49, 196, 141, 1)',
                                'rgba(255, 138, 76, 1)'
                            ],
                            borderColor: [
                                'rgba(28, 100, 242, 1)',
                                'rgba(214, 31, 105, 1)',
                                'rgba(5, 122, 85, 1)',
                                'rgba(208, 56, 1, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top', // Menampilkan legenda di bagian atas
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.label || '';
                                        let value = context.raw || 0;
                                        return `${label}: ${value} sekolah`;
                                    }
                                }
                            }
                        }
                    }
                });
            </script>
            </div>
          </div>
        </div>
      </div>
      <div class="mb-12 grid gap-y-10 gap-x-6 sm:grid-cols-1 lg:grid-cols-2">
        <div class="relative flex flex-col min-w-0 mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-md rounded-xl">
            <div class="rounded-t mb-0 px-0 border-0">
              <div class="flex flex-wrap items-center px-4 py-2">
                <div class="relative w-full max-w-full flex-grow flex-1">
                  <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Mata Pelajaran</h3>
                </div>
                <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                  <a href="mapel.php" class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">See More</a>
                </div>
              </div>
              <div class="block w-full overflow-x-auto">
                <table class="items-center w-full bg-transparent border-collapse">
                  <thead>
                    <tr>
                      <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Nama</th>
                      <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Pengajar</th>
                      <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">Mutu</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $query9 = "SELECT mapel.mutu AS mutu, mapel.nama AS nama, tendik.nama as nama_guru FROM mapel JOIN tendik ON mapel.id_guru = tendik.id LIMIT 5";
                      $result9 = mysqli_query($koneksi, $query9);
                      while ($row9 = mysqli_fetch_array($result9)) {
                    ?>
                    <tr class="text-gray-700 dark:text-gray-100">
                      <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left"><?=$row9['nama']?></th>
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"><?=$row9['nama_guru']?>
                      </td>
                      <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                      <div class="flex flex-row">
                        <?php
                          for ($i = 0; $i  < 4; $i++) {
                            if ($i < $row9['mutu']) {
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
          <div class="relative flex flex-col min-w-0 mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-md rounded-xl">
              <div class="rounded-t mb-0 px-0 border-0">
                <div class="flex flex-wrap items-center px-4 py-2">
                  <div class="relative w-full max-w-full flex-grow flex-1">
                    <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Guru dan Tendik</h3>
                  </div>
                  <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                    <a href="tendik.php" class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">See More</a>
                  </div>
                </div>
                <div class="block w-full overflow-x-auto">
                  <table class="items-center w-full bg-transparent border-collapse">
                    <thead>
                      <tr>
                        <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Nama</th>
                        <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">NIP</th>
                        <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">Jabatan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $query8 = "SELECT * FROM tendik LIMIT 5";
                        $result8 = mysqli_query($koneksi, $query8);
                        while ($row8 = mysqli_fetch_array($result8)) {
                      ?>
                      <tr class="text-gray-700 dark:text-gray-100">
                        <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left"><?= $row8['nama']?></th>
                        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                          <?=$row8['nip']?>
                        </td>
                        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                          <?php 
                            $biru = ($row8['jabatan'] == 'Pengawas') ? ' class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"' : '';
                            $kuning = ($row8['jabatan'] == 'Guru') ? ' class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300"' : '';
                            $merah = ($row8['jabatan'] == 'Kepsek') ? ' class="bg-red-100 text-red-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-red-900 dark:text-red-300"' : '';
                          ?>
                          <span <?php echo $biru; echo $kuning; echo $merah;?> class="">
                            <?= $row8['jabatan']?>
                          </span>
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

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
  </body>
</html>
