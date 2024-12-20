<?php 
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
 

?>
<!DOCTYPE html>
<html>

<head>
  <title>Mata Pelajaran | Sistem Informasi Mutu Program Remedial dan Pengayaan</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="..\css\output.css" rel="stylesheet" />
  <script src="node_modules\flowbite\dist\flowbite.min.js"></script>
  <link
    href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"
    rel="stylesheet" />
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
            window.location.href = "tendik.php";
        });
    });
<?php endif; ?>
</script>
<body>
  <nav
    class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">
        <div class="flex items-center justify-start rtl:justify-end">
          <button
            data-drawer-target="logo-sidebar"
            data-drawer-toggle="logo-sidebar"
            aria-controls="logo-sidebar"
            type="button"
            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg
              class="w-6 h-6"
              aria-hidden="true"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path
                clip-rule="evenodd"
                fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
          </button>
          <a href="dashboard.php" class="flex ms-2 md:me-24">
            <img
              src="https://upload.wikimedia.org/wikipedia/commons/9/9c/Logo_of_Ministry_of_Education_and_Culture_of_Republic_of_Indonesia.svg"
              class="h-8 me-3"
              alt="Logo Dinas Kelas dan Kebudayaan" />
            <span
              class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">SIMAPREM</span>
          </a>
        </div>
        <div class="flex items-center">
          <div class="flex items-center ms-3">
            <div>
              <button
                type="button"
                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                aria-expanded="false"
                data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open user menu</span>
                <img
                  class="w-8 h-8 rounded-full"
                  src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                  alt="user photo" />
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
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
        <li>
          <a
            href="dashboard.php"
            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <svg
              class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              viewBox="0 0 22 21">
              <path
                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
              <path
                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
            </svg>
            <span class="ms-3">Dashboard</span>
          </a>
        </li>
        <li>
          <a
            href="sekolah.php"
            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <svg
              class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
              fill="currentColor "
              viewBox="0 0 640 512"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M337.8 5.4C327 -1.8 313 -1.8 302.2 5.4L166.3 96H48C21.5 96 0 117.5 0 144V464C0 490.5 21.5 512 48 512H256V416C256 380.7 284.7 352 320 352C355.3 352 384 380.7 384 416V512H592C618.5 512 640 490.5 640 464V144C640 117.5 618.5 96 592 96H473.7L337.8 5.4ZM96 192H128C136.8 192 144 199.2 144 208V272C144 280.8 136.8 288 128 288H96C87.2 288 80 280.8 80 272V208C80 199.2 87.2 192 96 192ZM496 208C496 199.2 503.2 192 512 192H544C552.8 192 560 199.2 560 208V272C560 280.8 552.8 288 544 288H512C503.2 288 496 280.8 496 272V208ZM96 320H128C136.8 320 144 327.2 144 336V400C144 408.8 136.8 416 128 416H96C87.2 416 80 408.8 80 400V336C80 327.2 87.2 320 96 320ZM496 336C496 327.2 503.2 320 512 320H544C552.8 320 560 327.2 560 336V400C560 408.8 552.8 416 544 416H512C503.2 416 496 408.8 496 400V336ZM232 176C232 152.661 241.271 130.278 257.775 113.775C274.278 97.2714 296.661 88 320 88C343.339 88 365.722 97.2714 382.225 113.775C398.729 130.278 408 152.661 408 176C408 199.339 398.729 221.722 382.225 238.225C365.722 254.729 343.339 264 320 264C296.661 264 274.278 254.729 257.775 238.225C241.271 221.722 232 199.339 232 176ZM320 128C311.2 128 304 135.2 304 144V176C304 184.8 311.2 192 320 192H352C360.8 192 368 184.8 368 176C368 167.2 360.8 160 352 160H336V144C336 135.2 328.8 128 320 128Z" />
            </svg>

            <span class="flex-1 ms-3 whitespace-nowrap">Sekolah</span>
          </a>
        </li>
        <li>
          <a
            href="tendik.php"
            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <svg
              class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
              aria-hidden="true"
              viewBox="0 0 16 16"
              fill="currentColor"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M8 8C10.21 8 12 6.21 12 4C12 1.79 10.21 0 8 0C5.79 0 4 1.79 4 4C4 6.21 5.79 8 8 8ZM8 10C5.33 10 0 11.34 0 14V15C0 15.55 0.45 16 1 16H15C15.55 16 16 15.55 16 15V14C16 11.34 10.67 10 8 10Z" />
            </svg>

            <span class="flex-1 ms-3 whitespace-nowrap">Guru dan Tendik</span>
          </a>
        </li>
        <li>
          <a
            href="mapel.php"
            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <svg
              class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
              aria-hidden="true"
              viewBox="0 0 24 24"
              fill="currentColor"
              xmlns="http://www.w3.org/2000/svg">
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M6.271 2.112C5.461 2.218 5.033 2.413 4.727 2.712C4.422 3.012 4.223 3.432 4.114 4.225C4.002 5.042 4 6.124 4 7.675V16.245C4.39598 15.9746 4.83533 15.7741 5.299 15.652C5.827 15.513 6.443 15.513 7.346 15.514H20V7.676C20 6.124 19.998 5.042 19.886 4.225C19.777 3.432 19.578 3.012 19.273 2.712C18.967 2.413 18.539 2.218 17.729 2.112C16.895 2.002 15.791 2 14.207 2H9.793C8.209 2 7.105 2.002 6.271 2.112ZM6.759 6.595C6.759 6.147 7.129 5.784 7.586 5.784H16.414C16.631 5.78213 16.8398 5.86633 16.9948 6.01815C17.1498 6.16997 17.2384 6.37704 17.241 6.594C17.2386 6.81113 17.1502 7.01846 16.9952 7.17049C16.8401 7.32253 16.6311 7.40687 16.414 7.405H7.586C7.36903 7.40687 7.16017 7.32267 7.00516 7.17085C6.85016 7.01903 6.76164 6.81196 6.759 6.595ZM7.586 9.568C7.36903 9.56613 7.16017 9.65033 7.00516 9.80215C6.85016 9.95397 6.76164 10.161 6.759 10.378C6.759 10.826 7.129 11.189 7.586 11.189H13.103C13.3201 11.1911 13.5293 11.1071 13.6845 10.9552C13.8397 10.8034 13.9284 10.5961 13.931 10.379C13.9286 10.1617 13.8401 9.95422 13.6848 9.80215C13.5296 9.65008 13.3203 9.56587 13.103 9.568H7.586Z" />
              <path
                d="M7.473 17.135H20C19.997 18.265 19.979 19.109 19.887 19.775C19.778 20.568 19.579 20.988 19.274 21.288C18.968 21.587 18.54 21.782 17.73 21.888C16.896 21.998 15.792 22 14.208 22H9.793C8.209 22 7.105 21.998 6.271 21.889C5.461 21.782 5.033 21.587 4.727 21.288C4.422 20.988 4.223 20.568 4.114 19.775C4.073 19.475 4.046 19.138 4.03 18.755C4.16706 18.3804 4.39315 18.0448 4.68879 17.777C4.98442 17.5093 5.34072 17.3174 5.727 17.218C6.017 17.142 6.394 17.135 7.473 17.135Z" />
            </svg>
            <span class="flex-1 ms-3 whitespace-nowrap">Mata Pelajaran</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <div class="sm:ml-64">
    <div
      class="border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
      <!-- Start block -->
      <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
        <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">
        <div>
             <nav class="flex mb-4" aria-label="Breadcrumb">
               <ol class="inline-flex items-center space-x-1 md:space-x-3 rtl:space-x-reverse">
                 <li class="inline-flex items-center">
                   <a href="dashboard.php" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                     <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                       <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                     </svg>
                     Dashboard
                   </a>
                 </li>
                 <li>
                   <div class="flex items-center">
                     <svg class="w-3 h-3 text-gray-400 mx-1 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                       <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                     </svg>
                     <span class="ms-1 text-sm font-medium text-gray-700 md:ms-2 dark:text-gray-400 dark:hover:text-white">Mapel</a>
                   </div>
                 </li>
               </ol>
             </nav>
             <h2 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">Kelola Mata Pelajaran</h2>
            </div>
          <div
            class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div
              class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
              <div class="flex-1 flex items-center space-x-2">
                <h5>
                  <span class="text-gray-500">Result:</span>
                  <span class="dark:text-white"><?=(isset($_GET['KataKunci'])) ? $_GET['KataKunci'] : "Semua Mata Pelajaran";?></span>
                </h5>
              </div>
            </div>
            <div
              class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">
              <div class="w-full md:w-1/2">
              <form class="flex flex-row items-center mx-auto">   
                      <label for="voice-search" class="sr-only">Search</label>
                      <div class="relative w-full">
                          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                              </svg>
                          </div>
                          <input type="text" name="KataKunci" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari Mata Pelajaran" value="<?php if (isset($_GET['KataKunci']))  echo $_GET['KataKunci']; ?>"value="<?php if (isset($_GET['KataKunci']))  echo $_GET['KataKunci']; ?>" required />
                          <?php if (isset($_GET['KataKunci']))  echo  
                          "<a href='tendik.php' class='absolute inset-y-0 end-0 flex items-center pe-3'>
                          <svg  viewBox='0 0 24 24' fill='none' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' class='w-4 h-4 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white'>
                            <path d='M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12L19 6.41Z' fill='black'/>
                          </svg>
                        </a>";
                          ?>
                      </div>
                      <button type="submit" class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                          <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                          </svg>
                      </button>
                  </form>
              </div>
              <div
                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                <button
                  type="button"
                  id="createProductModalButton"
                  data-modal-target="createProductModal"
                  data-modal-toggle="createProductModal"
                  class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                  <svg
                    class="h-3.5 w-3.5 mr-2"
                    fill="currentColor"
                    viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">
                    <path
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                      d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                  </svg>
                  Tambah
                </button>
              </div>
            </div>
            <div class="overflow-x-auto">
              <table
                class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead
                  class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                    <th scope="col" class="pl-8 p-4">Nama</th>
                    <th scope="col" class="p-4">Kode</th>
                    <th scope="col" class="p-4">Guru</th>
                    <th scope="col" class="p-4">KKM</th>
                    <th scope="col" class="p-4">Kelas</th>
                    <th scope="col" class="p-4">Tahun Ajaran</th>
                    <th scope="col" class="p-4">Mutu</th>
                    <th scope="col" class="p-4">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include "../koneksi.php";
                  
                  $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;

                  $kolomCari = (isset($_GET['Kolom'])) ? $_GET['Kolom'] : "";

                  $kolomKataKunci = (isset($_GET['KataKunci'])) ? $_GET['KataKunci'] : "";

                  // Jumlah data per halaman
                  $limit = 5;

                  $limitStart = ($page - 1) * $limit;

                  // Query untuk mengambil semua data dari tabel mapel
                  if ($kolomKataKunci == "") {
                    $data = mysqli_query($koneksi, "SELECT mapel.id as id,mapel.nama as nama_mapel, mapel.kkm as kkm, mapel.mutu as mutu, mapel.kode_mapel as kode_mapel, mapel.kelas as kelas, mapel.ta as ta, tendik.nama as nama_guru from mapel INNER JOIN tendik ON mapel.id_guru = tendik.id ORDER BY tendik.id, mapel.kode_mapel LIMIT " . $limitStart . "," . $limit);
                  }else{
                    $data = mysqli_query($koneksi, "SELECT mapel.id as id, mapel.nama as nama_mapel, mapel.kkm as kkm, mapel.mutu as mutu, mapel.kode_mapel as kode_mapel, mapel.kelas as kelas, mapel.ta as ta, tendik.nama as nama_guru from mapel INNER JOIN tendik ON mapel.id_guru = tendik.id WHERE mapel.nama LIKE '%$kolomKataKunci%' OR mapel.kkm LIKE '%$kolomKataKunci%' OR mapel.mutu LIKE '%$kolomKataKunci%' OR mapel.kode_mapel LIKE '%$kolomKataKunci%' OR tendik.nama LIKE '%$kolomKataKunci%' OR mapel.kelas LIKE '%$kolomKataKunci%' OR mapel.ta LIKE '%$kolomKataKunci%' ORDER BY tendik.id, mapel.kode_mapel LIMIT " . $limitStart . "," . $limit);
                  }
                  $no = $limitStart + 1;
                  $no = 1;

                  // Looping melalui data hasil query
                  while ($r2 = mysqli_fetch_array($data)) {
                    $id         = $r2['id'];
                    $nama_mapel = $r2['nama_mapel'];
                    $kkm        = $r2['kkm'];
                    $mutu       = $r2['mutu'];
                    $kode_mapel = $r2['kode_mapel'];
                    $kelas    = $r2['kelas'];
                    $ta    = $r2['ta'];
                    $id_guru    = $r2['nama_guru'];
                  ?>
                    <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                      <th scope="row" class="pl-8 px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="flex items-center mr-3"><?php echo $nama_mapel ?></div>
                      </th>
                      <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo $kode_mapel ?>
                      </td>
                      <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo $id_guru ?>
                      </td>
                      <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo $kkm ?>
                      </td>
                      <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo $kelas ?>
                      </td>
                      <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo $ta ?>
                      </td>
                      <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="flex items-center">
                        <?php 
                            for ($i = 0; $i  < 4; $i++) {
                              if($i < $mutu){
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
                              }else{
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
                          <span class="text-gray-500 dark:text-gray-400 ml-1"
                            ><?php echo $mutu;?>.0</span
                          >
                        </div>
                      </td>
                      <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="flex items-center space-x-4">
                          <button type="button" data-modal-target="updateProductModal<?php echo $id; ?>" data-modal-toggle="updateProductModal<?php echo $id; ?>"
                            aria-controls="drawer-update-product"
                            class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor"
                              aria-hidden="true">
                              <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                              <path fill-rule="evenodd"
                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                clip-rule="evenodd" />
                            </svg>
                            Edit
                          </button>
                          <button type="button" data-modal-target="deleteModal<?php echo $id; ?>" data-modal-toggle="deleteModal<?php echo $id; ?>"
                            class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor"
                              aria-hidden="true">
                              <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                            </svg>
                            Delete
                          </button>
                        </div>
                      </td>
                    </tr>
                  <!-- Update Modal -->
                  <div
                    id="updateProductModal<?php echo $id; ?>"
                    tabindex="-1"
                    aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                      <!-- Modal content -->
                      <div
                        class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                        <!-- Modal header -->
                        <div
                          class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                          <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Update Mata Pelajaran
                          </h3>
                          <button
                            type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="updateProductModal<?php echo $id; ?>">
                            <svg
                              aria-hidden="true"
                              class="w-5 h-5"
                              fill="currentColor"
                              viewbox="0 0 20 20"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                          </button>
                        </div>
                        <!-- Modal body -->
                        <form action="update_mapel.php" method="post">
                          <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Menyimpan ID di sini -->
                            <div>
                              <label
                                for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                              <input
                                type="text"
                                name="name"
                                id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan Nama Mata Pelajaran"
                                required=""
                                value="<?php echo $nama_mapel ?>" />
                            </div>
                            <div>
                              <label
                                for="kode"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode</label>
                              <input
                                type="text"
                                name="kode"
                                id="kode"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan Kode Mata Pelajaran"
                                required=""
                                value="<?php echo $kode_mapel ?>" />
                            </div>
                            <div>
                              <label
                                for="guru"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guru</label>
                              <select
                                id="guru"
                                name="guru"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <?php
                                  $queryGuru = mysqli_query($koneksi, "SELECT * FROM tendik WHERE jabatan = 'Guru'");
                                  foreach ($queryGuru as $data_guru) {
                                  ?>
                                      <option value="<?php echo $data_guru['id']; ?>" <?php if (@$id_guru  == $data_guru['id']) echo 'selected'; ?>><?php echo $data_guru['nama']; ?></option>
                                  <?php
                                  }
                                ?>
                              </select>
                            </div>
                            <div>
                              <label
                                for="angkatan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
                                <div class="flex flex-row gap-4">                      
                                  <select
                                    id="angkatan"
                                    name="angkatan"
                                    class="bg-gray-50 inline border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required
                                  >
                                    <option value="" selected>Pilih Anngkatan</option>
                                    <option value="01" <?php echo (substr($kelas,0,2)== '01') ? 'selected' : ''; ?>>Kelas 1</option>
                                    <option value="02" <?php echo (substr($kelas,0,2)== '02') ? 'selected' : ''; ?>>Kelas 2</option>
                                    <option value="03" <?php echo (substr($kelas,0,2)== '03') ? 'selected' : ''; ?>>Kelas 3</option>
                                    <option value="04" <?php echo (substr($kelas,0,2)== '04') ? 'selected' : ''; ?>>Kelas 4</option>
                                    <option value="05" <?php echo (substr($kelas,0,2)== '05') ? 'selected' : ''; ?>>Kelas 5</option>
                                    <option value="06" <?php echo (substr($kelas,0,2)== '06') ? 'selected' : ''; ?>>Kelas 6</option>
                                    <option value="07" <?php echo (substr($kelas,0,2)== '07') ? 'selected' : ''; ?>>Kelas 7</option>
                                    <option value="08" <?php echo (substr($kelas,0,2)== '08') ? 'selected' : ''; ?>>Kelas 8</option>
                                    <option value="09" <?php echo (substr($kelas,0,2)== '09') ? 'selected' : ''; ?>>Kelas 9</option>
                                    <option value="10" <?php echo (substr($kelas,0,2)== '10') ? 'selected' : ''; ?>>Kelas 10</option>
                                    <option value="11" <?php echo (substr($kelas,0,2)== '11') ? 'selected' : ''; ?>>Kelas 11</option>
                                    <option value="12" <?php echo (substr($kelas,0,2)== '12') ? 'selected' : ''; ?>>Kelas 12</option>
                                  </select>
                                  <select
                                    id="kelas"
                                    name="kelas"
                                    class="bg-gray-50 border inline border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required
                                  >
                                    <option value="A" <?php echo (substr($kelas,3,1)== 'A') ? 'selected' : ''; ?>>A</option>
                                    <option value="B" <?php echo (substr($kelas,3,1)== 'B') ? 'selected' : ''; ?>>B</option>
                                    <option value="C" <?php echo (substr($kelas,3,1)== 'C') ? 'selected' : ''; ?>>C</option>
                                    <option value="D" <?php echo (substr($kelas,3,1)== 'D') ? 'selected' : ''; ?>>D</option>
                                    <option value="E" <?php echo (substr($kelas,3,1)== 'E') ? 'selected' : ''; ?>>E</option>
                                    <option value="F" <?php echo (substr($kelas,3,1)== 'F') ? 'selected' : ''; ?>>F</option>
                                  </select>
                                </div>
                            </div>
                            <div>
                              <label
                                for="ta"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun Ajaran</label>
                                <select
                                    id="ta"
                                    name="ta"
                                    class="bg-gray-50 border inline border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required
                                  >
                                    <option value="Ganjil 2023/2024">Ganjil 2023/2024</option>
                                    <option value="Genap 2023/2024">Genap 2023/2024</option>
                                    <option value="Ganjil 2024/2025">Ganjil 2024/2025</option>
                                    <option value="Genap 2024/2025">Genap 2024/2025</option>
                                  </select>
                            </div>
                            <div>
                              <label
                                for="kkm"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">KKM</label>
                              <input
                                type="number"
                                name="kkm"
                                id="kkm"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan KKM"
                                value="<?php echo $kkm ?>"
                                required="" />
                            </div>
                          </div>
                          <div class="flex items-center space-x-4">
                            <a href="update_mapel.php?id=<?php echo $id; ?>"><button
                                type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Update Mapel
                              </button></a>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <!-- Delete Modal -->
                  <div
                    id="deleteModal<?php echo $id; ?>"
                    tabindex="-1"
                    aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                      <!-- Modal content -->
                      <div
                        class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                        <button
                          type="button"
                          class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                          data-modal-toggle="deleteModal<?php echo $id; ?>">
                          <svg
                            aria-hidden="true"
                            class="w-5 h-5"
                            fill="currentColor"
                            viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd" />
                          </svg>
                          <span class="sr-only">Close modal</span>
                        </button>
                        <svg
                          class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto"
                          aria-hidden="true"
                          fill="currentColor"
                          viewbox="0 0 20 20"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                        </svg>
                        <p class="mb-4 text-gray-500 dark:text-gray-300">
                          Are you sure you want to delete this item?
                        </p>
                        <div class="flex justify-center items-center space-x-4">
                          <button
                            data-modal-toggle="deleteModal"
                            type="button"
                            class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            No, cancel
                          </button>
                          <a href="delete_mapel.php?id=<?php echo $id; ?>"><button
                              type="submit"
                              class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                              Yes, I'm sure
                            </button></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                  }
                  ?>
                </tbody>

              </table>
            </div>
            <?php
              //kondisi jika parameter pencarian kosong
              if ($kolomKataKunci == "") {
                $countStmt = mysqli_query($koneksi,"SELECT COUNT(*) AS total_baris FROM mapel");
              } else {
                $countStmt = mysqli_query($koneksi,"SELECT COUNT(*) AS total_baris FROM mapel WHERE mapel.nama LIKE '%$kolomKataKunci%' OR mapel.kkm LIKE '%$kolomKataKunci%' OR mapel.mutu LIKE '%$kolomKataKunci%' OR mapel.kode_mapel LIKE '%$kolomKataKunci%' OR tendik.nama LIKE '%$kolomKataKunci%'"); 

              }
              $rowCount = mysqli_fetch_array($countStmt);
              //Hitung semua jumlah data yang berada pada tabel Sisawa
              $JumlahData = $rowCount['total_baris'];
              // Hitung jumlah halaman yang tersedia
              $jumlahPage = ceil($JumlahData / $limit);

              // Jumlah link number 
              $jumlahNumber = 1;

              // Untuk awal link number
              $startNumber = ($page > $jumlahNumber) ? $page - $jumlahNumber : 1;

              // Untuk akhir link number
              $endNumber = ($page < ($jumlahPage - $jumlahNumber)) ? $page + $jumlahNumber : $jumlahPage;
              ?>
            <nav
              class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
              aria-label="Table navigation">
              <span
                class="text-sm font-normal text-gray-500 dark:text-gray-400">
                Showing
                <span class="font-semibold text-gray-900 dark:text-white"><?=$limitStart+1?>-<?php echo $endNumber == $page ? $JumlahData : $page*$limit; ?></span>
                of
                <span class="font-semibold text-gray-900 dark:text-white"><?=$JumlahData?></span>
              </span>
              <ul class="inline-flex items-stretch -space-x-px">
              <?php
                    // Jika page = 1, maka LinkPrev disable
                    if ($page == 1) {
                  ?>
                  <li>
                    <a
                      href=""
                      class="flex items-center justify-center cursor-not-allowed h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                      disabled
                      >
                      <span class="sr-only">Previous</span>
                      <svg
                        class="w-5 h-5"
                        aria-hidden="true"
                        fill="currentColor"
                        viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                          clip-rule="evenodd"
                        />
                      </svg>
                    </a>
                  </li>
                  <?php
                  } else {
                    $LinkPrev = ($page > 1) ? $page - 1 : 1;

                    if ($kolomKataKunci == "") {
                    ?>
                  <li>
                    <a
                      href="mapel.php?page=<?php echo $LinkPrev; ?>"
                      class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"                      
                      >
                      <span class="sr-only">Previous</span>
                      <svg
                        class="w-5 h-5"
                        aria-hidden="true"
                        fill="currentColor"
                        viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                          clip-rule="evenodd"
                        />
                      </svg>
                    </a>
                  </li>
                  <?php
                  } else {
                  ?>    
                  <li>
                    <a
                      href="mapel.php?KataKunci=<?php echo $kolomKataKunci; ?>&page=<?php echo $LinkPrev; ?>"
                      class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"                      
                      >
                      <span class="sr-only">Previous</span>
                      <svg
                        class="w-5 h-5"
                        aria-hidden="true"
                        fill="currentColor"
                        viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                          clip-rule="evenodd"
                        />
                      </svg>
                    </a>
                  </li>
                  <?php
                      }
                  }
                  ?>

                  <!-- Numberr -->
                  <?php                    
                    for ($i = $startNumber; $i <= $endNumber; $i++) {
                        $linkActive = ($page == $i) ? ' class="text-blue-600 bg-blue-50 border border-blue-300 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"' : '';
                        $linkNonActive = ($page !== $i) ? ' class="text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"' : '';

                        if ($kolomKataKunci == "") {
                    ?>
                            <li <?php echo $linkActive; echo $linkNonActive;?>>
                              <a
                                href="mapel.php?page=<?php echo $i; ?>"
                                class="flex items-center justify-center text-sm py-2 px-3 leading-tight"
                                ><?php echo $i; ?></a
                              >
                            </li>
                            <?php
                        } else {
                            ?>
                                <li <?php echo $linkActive; echo $linkNonActive;?>>
                                <a href="mapel.php?KataKunci=<?php echo $kolomKataKunci; ?>&page=<?php echo $i; ?>"
                                class="flex items-center justify-center text-sm py-2 px-3 leading-tight"><?php echo $i; ?></a></li>
                            <?php
                        }
                    }
                            ?>

                  <!-- Next -->
                  <?php
                  if ($page == $jumlahPage) {
                  ?>
                      <li>
                        <a
                          href=""
                          class="flex items-center justify-center cursor-not-allowed h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                          disabled
                        >
                          <span class="sr-only">Next</span>
                          <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="currentColor"
                            viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              fill-rule="evenodd"
                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                              clip-rule="evenodd"
                            />
                          </svg>
                        </a>
                      </li>
                      <?php
                  } else {
                      $linkNext = ($page < $jumlahPage) ? $page + 1 : $jumlahPage;
                      if ($kolomKataKunci == "") {
                      ?>
                          <li>
                            <a
                              href="mapel.php?page=<?php echo $linkNext; ?>"
                              class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                            >
                              <span class="sr-only">Next</span>
                              <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="currentColor"
                                viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  fill-rule="evenodd"
                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                  clip-rule="evenodd"
                                />
                              </svg>
                            </a>
                          </li>
                      <?php
                      } else {
                      ?>
                          <li>
                            <a
                              href="mapel.php?KataKunci=<?php echo $kolomKataKunci; ?>&page=<?php echo $linkNext; ?>"
                              class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                            >
                              <span class="sr-only">Next</span>
                              <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="currentColor"
                                viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  fill-rule="evenodd"
                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                  clip-rule="evenodd"
                                />
                              </svg>
                            </a>
                          </li>
                  <?php
                      }
                  }
                  ?>
              </ul>
            </nav>
          </div>
        </div>
      </section>
      <!-- End block -->
      <div
        id="createProductModal"
        tabindex="-1"
        aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
          <!-- Modal content -->
          <div
            class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div
              class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                Tambah Mata Pelajaran
              </h3>
              <button
                type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-target="createProductModal"
                data-modal-toggle="createProductModal">
                <svg
                  aria-hidden="true"
                  class="w-5 h-5"
                  fill="currentColor"
                  viewbox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path
                    fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
                </svg>
                <span class="sr-only">Close modal</span>
              </button>
            </div>
            <!-- Modal body -->
            <form action="tambah_mapel.php" method="POST">
              <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div>
                  <label
                    for="name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                  <input
                    type="text"
                    name="name"
                    id="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Masukkan Nama Mata Pelajaran"
                    required="" />
                </div>
                <div>
                  <label
                    for="kode"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode</label>
                  <input
                    type="text"
                    name="kode"
                    id="kode"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Masukkan Kode Mata Pelajaran"
                    required="" />
                </div>
                <div>
                  <label
                    for="guru"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guru</label>
                  <select
                    id="guru"
                    name="guru"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected="">Pilih Guru</option>
                    <?php
                      $queryGuru = mysqli_query($koneksi, "SELECT * FROM tendik WHERE jabatan = 'Guru'");
                      foreach ($queryGuru as $data_guru) {
                      ?>
                          <option value="<?php echo $data_guru['id']; ?>" <?php if (@$vdosen == '1') echo 'selected'; ?>><?php echo $data_guru['nama']; ?></option>
                      <?php
                      }
                    ?>
                  </select>
                </div>
                <div>
                  <label
                    for="angkatan"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
                    <div class="flex flex-row gap-4">                      
                      <select
                        id="angkatan"
                        name="angkatan"
                        class="bg-gray-50 inline border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required
                      >
                        <option value="" selected>Pilih Anngkatan</option>
                        <option value="01">Kelas 1</option>
                        <option value="02">Kelas 2</option>
                        <option value="03">Kelas 3</option>
                        <option value="04">Kelas 4</option>
                        <option value="05">Kelas 5</option>
                        <option value="06">Kelas 6</option>
                        <option value="07">Kelas 7</option>
                        <option value="08">Kelas 8</option>
                        <option value="09">Kelas 9</option>
                        <option value="10">Kelas 10</option>
                        <option value="11">Kelas 11</option>
                        <option value="12">Kelas 12</option>
                      </select>
                      <select
                        id="kelas"
                        name="kelas"
                        class="bg-gray-50 border inline border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required
                      >
                        <option value="" selected>Pilih Kelas</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                      </select>
                    </div>
                </div>
                <div>
                  <label
                    for="ta"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun Ajaran</label>
                    <select
                        id="ta"
                        name="ta"
                        class="bg-gray-50 border inline border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required
                      >
                        <option value="" selected>Pilih Tahun Ajaran</option>
                        <option value="Ganjil 2023/2024">Ganjil 2023/2024</option>
                        <option value="Genap 2023/2024">Genap 2023/2024</option>
                        <option value="Ganjil 2024/2025">Ganjil 2024/2025</option>
                        <option value="Genap 2024/2025">Genap 2024/2025</option>
                      </select>
                </div>
                <div>
                  <label
                    for="kkm"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">KKM</label>
                  <input
                    type="number"
                    name="kkm"
                    id="kkm"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Masukkan KKM"
                    required="" />
                </div>
              </div>
              <button
                type="submit"
                name="submit"
                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg
                  class="mr-1 -ml-1 w-6 h-6"
                  fill="currentColor"
                  viewbox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path
                    fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd" />
                </svg>
                Tambah
              </button>
            </form>
          </div>
        </div>
      </div>    

      <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>