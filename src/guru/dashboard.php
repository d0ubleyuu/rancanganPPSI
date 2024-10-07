<?php

// Include Koneksi.php
require_once '../koneksi.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['nama'])) {
    header('Location: ../index.php');
    exit;
}

$nama = $_SESSION['nama'];
$jabatan = $_SESSION['jabatan'];

// Halaman untuk admin
echo "Selamat datang, " . $_SESSION['nama'] . "! Ini adalah dashboard admin.";

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Dashboard | Sistem Penilaian Program Remedial & Pengayaan</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="src\css\output.css" rel="stylesheet" />
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
                    Admin
                  </p>
                  <p
                    class="text-sm font-medium text-gray-900 truncate dark:text-gray-300"
                    role="none"
                  >
                    admin@dindikbud.riau.gov.id
                  </p>
                </div>
                <ul class="py-1" role="none">
                  <li>
                    <a
                      href="#"
                      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                      role="menuitem"
                      >Dashboard</a
                    >
                  </li>
                  <li>
                    <a
                      href="#"
                      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                      role="menuitem"
                      >Change Password</a
                    >
                  </li>
                  <li>
                    <a
                      href="login.php"
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
    <div class="p-4">
      <div
        class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 mb-4"
      >
        <!-- Start block -->
        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
          <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">
            <div
              class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden"
            >
              <div
                class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4"
              >
                <div class="flex-1 flex items-center space-x-2">
                  <h5>
                    <span class="text-gray-500">Semua Mata Pelajaran:</span>
                    <span class="dark:text-white">123456</span>
                  </h5>
                  <h5 class="text-gray-500 dark:text-gray-400 ml-1">
                    1-100 (436)
                  </h5>
                  <button
                    type="button"
                    class="group"
                    data-tooltip-target="results-tooltip"
                  >
                    <svg
                      aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                      viewbox="0 0 20 20"
                      fill="currentColor"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"
                      />
                    </svg>
                    <span class="sr-only">More info</span>
                  </button>
                  <div
                    id="results-tooltip"
                    role="tooltip"
                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700"
                  >
                    Showing 1-100 of 436 results
                    <div class="tooltip-arrow" data-popper-arrow=""></div>
                  </div>
                </div>
              </div>
              <div
                class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700"
              >
                <div class="w-full md:w-1/2">
                  <form class="flex items-center">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                      <div
                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                      >
                        <svg
                          aria-hidden="true"
                          class="w-5 h-5 text-gray-500 dark:text-gray-400"
                          fill="currentColor"
                          viewbox="0 0 20 20"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                          />
                        </svg>
                      </div>
                      <input
                        type="text"
                        id="simple-search"
                        placeholder="Cari Mata Pelajaran"
                        required=""
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      />
                    </div>
                  </form>
                </div>
              </div>
              
              <div class="overflow-x-auto">
                <table
                  class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                >
                  <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                  >
                    <tr>
                      <th scope="col" class="p-4">
                        <div class="flex items-center">
                          <input
                            id="checkbox-all"
                            type="checkbox"
                            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                          />
                          <label for="checkbox-all" class="sr-only"
                            >checkbox</label
                          >
                        </div>
                      </th>
                      <th scope="col" class="p-4">Kode</th>
                      <th scope="col" class="p-4">Nama</th>
                      <th scope="col" class="p-4">Guru</th>
                      <th scope="col" class="p-4">KKM</th>
                      <th scope="col" class="p-4">Level Mutu</th>
                      <th scope="col" class="p-4">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
                    $kolomCari = (isset($_GET['Kolom'])) ? $_GET['Kolom'] : "";
                    $kolomKataKunci = (isset($_GET['KataKunci'])) ? $_GET['KataKunci'] : "";

                    // Jumlah data per halaman
                    $limit = 10;

                    $limitStart = ($page - 1) * $limit;

                    //kondisi jika parameter pencarian kosong
                    if ($kolomKataKunci == "") {
                      $mapel = mysqli_query($koneksi, "SELECT mapel.id AS id, mapel.kode_mapel AS kode_mapel, mapel.nama AS nama_mapel, tendik.nama AS nama_guru, mapel.kkm, mapel.mutu FROM `mapel` INNER JOIN tendik ON mapel.id_guru = tendik.id LIMIT " . $limitStart . "," . $limit);
                    } else {
                        //kondisi jika parameter kolom pencarian diisi
                      $mapel = mysqli_query($koneksi, "SELECT mapel.id AS id, mapel.kode_mapel AS kode_mapel, mapel.nama AS nama_mapel, tendik.nama AS nama_guru, mapel.kkm, mapel.mutu FROM `mapel` INNER JOIN tendik ON mapel.id_guru = tendik.id WHERE nama LIKE '%$kolomKataKunci%' LIMIT " . $limitStart . "," . $limit);
                    }
                    $no = $limitStart + 1;

                    $no = 1;
                    foreach ($mapel as $row) {
                      
                  ?>
                    <tr
                      class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700"
                    >
                    <td class="p-4 w-4">
                        <div class="flex items-center">
                          <input
                            id="checkbox-table-search-1"
                            type="checkbox"
                            onclick="event.stopPropagation()"
                            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                          />
                          <label for="checkbox-table-search-1" class="sr-only"
                            >checkbox</label
                          >
                        </div>
                      </td>
                      <th
                        scope="row"
                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                      >
                        <div class="flex items-center mr-3"><?php echo $row['kode_mapel'];?></div>
                      </th>
                      <td
                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                      >
                        <?php echo $row['nama_mapel'];?>
                      </td>
                      <td
                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                      >
                        <?php echo $row['nama_guru'];?>
                      </td>
                      <td
                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                      >
                        <span
                          class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"
                          ><?php echo $row['kkm'];?></span
                        >
                      </td>
                      <td
                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                      >
                        <div class="flex items-center">
                          <?php 
                            for ($i = 0; $i  < 4; $i++) {
                              if($i < $row['mutu']){
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
                            ><?php echo $row['mutu'];?>.0</span
                          >
                        </div>
                      </td>

                      <td
                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                      >
                        <div class="flex items-center space-x-4">
                        <?php 
                          $id_mapel = $row['id'];
                          $mapel = mysqli_query($koneksi, "SELECT * FROM document WHERE id_mapel = '$id_mapel'");
                          $jumlah_data = mysqli_num_rows($mapel);
                        ?>
                          <button
                            type="button"
                            data-modal-target="updateProductModal<?php echo $row['id']; ?>"
                            data-modal-toggle="updateProductModal<?php echo $row['id']; ?>"
                            aria-controls="drawer-update-product"
                            class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 <?php if ($jumlah_data > 0) echo 'cursor-not-allowed'; ?> "
                            <?php if ($jumlah_data > 0) echo 'disabled'; ?> 
                            >
                            <svg
                              class="h-4 w-4 mr-2 -ml-0.5"
                              viewBox="0 0 24 24"
                              fill="currentColor"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M10 16H14C14.55 16 15 15.55 15 15V10H16.59C17.48 10 17.93 8.92 17.3 8.29L12.71 3.7C12.6175 3.6073 12.5076 3.53375 12.3866 3.48357C12.2657 3.43338 12.136 3.40755 12.005 3.40755C11.874 3.40755 11.7443 3.43338 11.6234 3.48357C11.5024 3.53375 11.3925 3.6073 11.3 3.7L6.71 8.29C6.08 8.92 6.52 10 7.41 10H9V15C9 15.55 9.45 16 10 16ZM6 18H18C18.55 18 19 18.45 19 19C19 19.55 18.55 20 18 20H6C5.45 20 5 19.55 5 19C5 18.45 5.45 18 6 18Z"
                              />
                            </svg>

                            Upload Doc
                          </button>

                          <!-- Tombol Preview -->
                          <?php 
                            $id_mapel = $row['id'];
                            $mapel = mysqli_query($koneksi, "SELECT * FROM penilaian_mutu WHERE id_mapel = '$id_mapel'");
                            $jumlah_data = mysqli_num_rows($mapel);
                          ?>
                          <form action="hasil_mutu.php" method="POST">
                                <input type="hidden" name="id_penilaian" value="<?php foreach ($mapel as $nilai_mutu) {echo $nilai_mutu['id'];}?>">
                                <button
                                    type="submit"
                                    name="preview"
                                    aria-controls="drawer-update-product"
                                    class="py-2 px-3 flex items-center text-sm font-medium text-center rounded-lg text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 me-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 <?php if ($jumlah_data == 0) echo 'cursor-not-allowed'; ?> "
                                    <?php if ($jumlah_data == 0) echo 'disabled'; ?>  
                                >
                                    <svg class="h-4 w-4 mr-2 -ml-0.5" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 6V7.998H15V6H5ZM11.998 11V14H14.998V11H11.998ZM2 5.754C2 5.02465 2.28973 4.32518 2.80546 3.80945C3.32118 3.29373 4.02065 3.004 4.75 3.004H15.25C15.9792 3.004 16.6785 3.29359 17.1942 3.8091C17.7099 4.32461 17.9997 5.02383 18 5.753V14.253C18 14.9823 17.7103 15.6818 17.1945 16.1975C16.6788 16.7133 15.9793 17.003 15.25 17.003H4.75C4.02065 17.003 3.32118 16.7133 2.80546 16.1975C2.28973 15.6818 2 14.9823 2 14.253V5.754ZM4 5.5V8.498C4 8.63061 4.05268 8.75778 4.14645 8.85155C4.24021 8.94532 4.36739 8.998 4.5 8.998H15.5C15.6326 8.998 15.7598 8.94532 15.8536 8.85155C15.9473 8.75778 16 8.63061 16 8.498V5.5C16 5.36739 15.9473 5.24021 15.8536 5.14645C15.7598 5.05268 15.6326 5 15.5 5H4.5C4.36739 5 4.24021 5.05268 4.14645 5.14645C4.05268 5.24021 4 5.36739 4 5.5Z"></path>
                                    </svg>
                                    Preview
                                </button>
                            </form>
                        </div>
                      </td>
                    </tr>
                    <div
          id="updateProductModal<?php echo $row['id']; ?>"
          tabindex="-1"
          aria-hidden="true"
          class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
        >
          <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div
              class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5"
            >
              <!-- Modal header -->
              <div
                class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600"
              >
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                  Upload Document
                </h3>
                <button
                  type="button"
                  class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                  data-modal-toggle="updateProductModal<?php echo $row['id']; ?>"
                >
                  <svg
                    aria-hidden="true"
                    class="w-5 h-5"
                    fill="currentColor"
                    viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                      clip-rule="evenodd"
                    />
                  </svg>
                  <span class="sr-only">Close modal</span>
                </button>
              </div>
              <!-- Modal body -->
              <form action="uploadFile.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
              <input type="hidden" name="kode_mapel" value="<?php echo $row['kode_mapel']; ?>">
              <input type="hidden" name="nama_mapel" value="<?php echo $row['nama_mapel']; ?>">
              <input type="hidden" name="nama_guru" value="<?php echo $row['nama_guru']; ?>">
                <div class="grid gap-4 mb-4">
                  <div>
                    <label
                      for="name"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >Dokumen Nilai</label
                    >
                    <input
                      class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                      aria-describedby="user_avatar_help"
                      name="file_nilai" 
                      id="user_avatar"
                      type="file"
                    />
                  </div>
                  <div>
                    <label
                      for="name"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >Dokumen Remedial</label
                    >
                    <input
                      class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                      aria-describedby="user_avatar_help"
                      id="user_avatar"
                      name="file_remedial"
                      type="file"
                    />
                  </div>
                </div>
                <div class="flex items-center mt-6 space-x-4">
                  <button
                    type="submit"
                    name="submit-upload"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  >
                    Submit
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
                <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <nav
                class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                aria-label="Table navigation"
              >
                <span
                  class="text-sm font-normal text-gray-500 dark:text-gray-400"
                >
                  Showing
                  <span class="font-semibold text-gray-900 dark:text-white"
                    >1-10</span
                  >
                  of
                  <span class="font-semibold text-gray-900 dark:text-white"
                    >1000</span
                  >
                </span>
                <ul class="inline-flex items-stretch -space-x-px">
                  <li>
                    <a
                      href="#"
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
                  <li>
                    <a
                      href="#"
                      class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                      >1</a
                    >
                  </li>
                  <li>
                    <a
                      href="#"
                      class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                      >2</a
                    >
                  </li>
                  <li>
                    <a
                      href="#"
                      aria-current="page"
                      class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-blue-600 bg-blue-50 border border-blue-300 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                      >3</a
                    >
                  </li>
                  <li>
                    <a
                      href="#"
                      class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                      >...</a
                    >
                  </li>
                  <li>
                    <a
                      href="#"
                      class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                      >100</a
                    >
                  </li>
                  <li>
                    <a
                      href="#"
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
                </ul>
              </nav>
            </div>
          </div>
        </section>
        <!-- Update Modal -->
        
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
  </body>
</html>
