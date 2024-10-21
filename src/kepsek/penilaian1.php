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


// Fungsi untuk analisis mutu
function analisisMutu($sesuai_jadwal, $metode_beragam, $berkelanjutan, $peningkataan) {
  if ( $metode_beragam == 1 && $berkelanjutan == 1 && $peningkataan == 1) {
      return 4;
  } elseif ( $metode_beragam == 1 && $berkelanjutan == 0 && $peningkataan == 1) {
      return 3;
  } elseif ( $metode_beragam == 1 && $berkelanjutan == 0 && $peningkataan == 0) {
      return 2;
  } else {
      return 1;
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST['simpan']) {
    // Ambil nilai id_mapel dari POST
    $id_document = $_POST['id_document'];
    $id_mapel = $_POST['id_mapel'];
    $id_kepsek = $_POST['id_kepsek'];
    $doc_nilai = $_POST['doc_nilai'];
    $remedial = $_POST['remedial'];
    $sesuai_jadwal = $_POST['sesuai_jadwal'];
    $metode_beragam = $_POST['metode_beragam'];
    $berkelanjutan = $_POST['berkelanjutan'];
    $peningkatan = $_POST['peningkatan'];
    $waktu = date("Y-m-d H:i:s");
    $mutu = analisisMutu($sesuai_jadwal, $metode_beragam, $berkelanjutan, $peningkatan);
    echo "<script>alert('Hasil analisis mutu: " . $mutu . "');</script>";
    
    $query = "INSERT INTO `penilaian_mutu` VALUES ('','$id_document','$id_mapel','$id_kepsek','$waktu','$doc_nilai','$remedial','$sesuai_jadwal','$metode_beragam','$berkelanjutan','$peningkatan','$mutu')";
    $simpan = mysqli_query($koneksi, $query);
    $queryEdit = "UPDATE mapel SET mutu = '$mutu' WHERE mapel.id = $id_mapel";
    $edit = mysqli_query($koneksi, $queryEdit);
    if ($simpan && $edit)
    {
        echo "<script>
        alert('Simpan data suksess!');
        document.location='penilaian.php';
          </script>";
    } else {
        echo "<script>
        alert('Simpan data GAGAL!!');
        document.location='penilaian.php';
          </script>";
    }
  } else if ($_POST['btn-menilai']==''){

  } else {
    echo "<script>
      document.location='penilaian.php';
      </script>";
  }
}else{
  echo "<script>
      document.location='penilaian.php';
      </script>";
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Dashboard | Sistem Penilaian Program Remedial & Pengayaan</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="..\css\output.css" rel="stylesheet" />
    <script src="node_modules\flowbite\dist\flowbite.min.js"></script>
    <link
      href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"
      rel="stylesheet"
    />
  </head>
  <body class="min-h-screen w-full">
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
                    Suarti
                  </p>
                  <p
                    class="text-sm font-medium text-gray-900 truncate dark:text-gray-300"
                    role="none"
                  >
                    suarti.smkn1@dindikbud.riau.gov.id
                  </p>
                </div>
                <ul class="py-1" role="none">
                  <li>
                    <a
                      href=".dashboard.php"
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

    <div class="p-1 md:p-2 w-full">
      <div
        class="p-2 md:p-4 border-2 border-gray-200 border-dashed rounded-lg h-full w-full dark:border-gray-700 mt-14"
      >
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4 h-full">
          <div
            class="flex items-center justify-start flex-col rounded bg-gray-50 h-full dark:bg-gray-800"
          >
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
              <ul
                class="flex flex-wrap -mb-px text-sm font-medium text-center"
                id="default-styled-tab"
                data-tabs-toggle="#default-styled-tab-content"
                data-tabs-active-classes="text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500"
                data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                role="tablist"
              >
                <li class="me-2" role="presentation">
                  <button
                    class="inline-block p-4 border-b-2 rounded-t-lg"
                    id="profile-styled-tab"
                    data-tabs-target="#styled-profile"
                    type="button"
                    role="tab"
                    aria-controls="profile"
                    aria-selected="false"
                  >
                    Doc. Penilaian
                  </button>
                </li>
                <li class="me-2" role="presentation">
                  <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-styled-tab"
                    data-tabs-target="#styled-dashboard"
                    type="button"
                    role="tab"
                    aria-controls="dashboard"
                    aria-selected="false"
                  >
                    Doc. Remedial
                  </button>
                </li>
              </ul>
            </div>
              <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                  // Ambil nilai id_mapel dari POST
                  $id_mapel = $_POST['id_mapel'];
                  $id_kepsek = $_POST['id_kepsek'];
                  
                  // Cetak nilai id_mapel
                  $query = mysqli_query($koneksi, "SELECT * from document WHERE id_mapel = '$id_mapel'");
                  $jumlah_data = mysqli_num_rows($query);
                  if ($jumlah_data>0) {
                    # code...
                  
                  foreach ($query as $row) {
                    $id_document = $row['id'];
                    $doc_nilai = $row['path_doc_nilai'];
                    $doc_remedial = $row['path_doc_remedial'];
                    echo"
            <div id='default-styled-tab-content' class='w-full h-full'>
              <div
                class='hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800'
                id='styled-profile'
                role='tabpanel'
                aria-labelledby='profile-tab'
              >
                <iframe
                  type='application/pdf'
                  src='../document/penilaian/$doc_nilai'
                  class='w-full min-h-80 md:min-h-[32rem]'
                ></iframe>
              </div>
              <div
                class='hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800'
                id='styled-dashboard'
                role='tabpanel'
                aria-labelledby='dashboard-tab'
              >
                <iframe
                  type='application/pdf'
                  src='../document/remedial/$doc_remedial'
                  class='w-full min-h-80 md:min-h-[32rem]'
                ></iframe>
              </div>";
             }} else {
              $id_document = 0;
              echo"
              <div
              class='hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 h-full flex items-center justify-start'
              id='styled-profile'
              role='tabpanel'
              aria-labelledby='profile-tab'
            >
                <p
                  class='text-2xl text-gray-900 dark:text-gray-500 text-center flex flex-col items-center'
                >
                  <svg
                    class='w-8 h-8 mb-4 items-center'
                    viewBox='0 0 15 15'
                    fill='none'
                    xmlns='http://www.w3.org/2000/svg'
                  >
                    <path
                      d='M3.5 8H3V7H3.5C3.63261 7 3.75979 7.05268 3.85355 7.14645C3.94732 7.24021 4 7.36739 4 7.5C4 7.63261 3.94732 7.75979 3.85355 7.85355C3.75979 7.94732 3.63261 8 3.5 8ZM7 10V7H7.5C7.63261 7 7.75979 7.05268 7.85355 7.14645C7.94732 7.24021 8 7.36739 8 7.5V9.5C8 9.63261 7.94732 9.75979 7.85355 9.85355C7.75979 9.94732 7.63261 10 7.5 10H7Z'
                      fill='#1a1a1a'
                    />
                    <path
                      fill-rule='evenodd'
                      clip-rule='evenodd'
                      d='M1 1.5C1 1.10218 1.15804 0.720644 1.43934 0.43934C1.72064 0.158035 2.10218 0 2.5 0L10.707 0L14 3.293V13.5C14 13.8978 13.842 14.2794 13.5607 14.5607C13.2794 14.842 12.8978 15 12.5 15H2.5C2.10218 15 1.72064 14.842 1.43934 14.5607C1.15804 14.2794 1 13.8978 1 13.5V1.5ZM3.5 6H2V11H3V9H3.5C3.89782 9 4.27936 8.84196 4.56066 8.56066C4.84196 8.27936 5 7.89782 5 7.5C5 7.10218 4.84196 6.72064 4.56066 6.43934C4.27936 6.15804 3.89782 6 3.5 6ZM7.5 6H6V11H7.5C7.89782 11 8.27936 10.842 8.56066 10.5607C8.84196 10.2794 9 9.89782 9 9.5V7.5C9 7.10218 8.84196 6.72064 8.56066 6.43934C8.27936 6.15804 7.89782 6 7.5 6ZM10 11V6H13V7H11V8H12V9H11V11H10Z'
                      fill='#1a1a1a'
                    />
                  </svg>

                  Document Penilaian Tidak Tersedia
                </p>
              </div>
              <div
              class='hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 h-full flex items-center justify-start'
              id='styled-dashboard'
              role='tabpanel'
              aria-labelledby='dashboard-tab'
            >
                <p
                  class='text-2xl text-gray-900 dark:text-gray-500 text-center flex flex-col items-center'
                >
                  <svg
                    class='w-8 h-8 mb-4 items-center'
                    viewBox='0 0 15 15'
                    fill='none'
                    xmlns='http://www.w3.org/2000/svg'
                  >
                    <path
                      d='M3.5 8H3V7H3.5C3.63261 7 3.75979 7.05268 3.85355 7.14645C3.94732 7.24021 4 7.36739 4 7.5C4 7.63261 3.94732 7.75979 3.85355 7.85355C3.75979 7.94732 3.63261 8 3.5 8ZM7 10V7H7.5C7.63261 7 7.75979 7.05268 7.85355 7.14645C7.94732 7.24021 8 7.36739 8 7.5V9.5C8 9.63261 7.94732 9.75979 7.85355 9.85355C7.75979 9.94732 7.63261 10 7.5 10H7Z'
                      fill='#1a1a1a'
                    />
                    <path
                      fill-rule='evenodd'
                      clip-rule='evenodd'
                      d='M1 1.5C1 1.10218 1.15804 0.720644 1.43934 0.43934C1.72064 0.158035 2.10218 0 2.5 0L10.707 0L14 3.293V13.5C14 13.8978 13.842 14.2794 13.5607 14.5607C13.2794 14.842 12.8978 15 12.5 15H2.5C2.10218 15 1.72064 14.842 1.43934 14.5607C1.15804 14.2794 1 13.8978 1 13.5V1.5ZM3.5 6H2V11H3V9H3.5C3.89782 9 4.27936 8.84196 4.56066 8.56066C4.84196 8.27936 5 7.89782 5 7.5C5 7.10218 4.84196 6.72064 4.56066 6.43934C4.27936 6.15804 3.89782 6 3.5 6ZM7.5 6H6V11H7.5C7.89782 11 8.27936 10.842 8.56066 10.5607C8.84196 10.2794 9 9.89782 9 9.5V7.5C9 7.10218 8.84196 6.72064 8.56066 6.43934C8.27936 6.15804 7.89782 6 7.5 6ZM10 11V6H13V7H11V8H12V9H11V11H10Z'
                      fill='#1a1a1a'
                    />
                  </svg>

                  Document Remedial Tidak Tersedia
                </p>
              ";}?>
            </div>
          </div>
          <div
            class="flex flex-col items-start justify-start rounded bg-gray-50 h-full dark:bg-gray-800"
          >
            <form method="POST" action="" id="multiStepForm">
              <input type="hidden" name="id_mapel" value=<?php echo $id_mapel?>>
              <input type="hidden" name="id_document" value=<?php echo $id_document?>>
              <input type="hidden" name="id_kepsek" value=<?php echo $id_kepsek;}?>>
              <div id="step-1" class="step-content">
                <ol
                  class="flex items-center w-full p-3 space-x-2 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse"
                >
                  <li
                    class="flex items-center text-blue-600 dark:text-blue-500"
                  >
                    <span
                      class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500"
                    >
                      1
                    </span>
                    Document Check
                    <svg
                      class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180"
                      aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 12 10"
                    >
                      <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m7 9 4-4-4-4M1 9l4-4-4-4"
                      />
                    </svg>
                  </li>
                  <li class="flex items-center">
                    <span
                      class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400"
                    >
                      2
                    </span>
                    Program Remedial Check
                    <svg
                      class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180"
                      aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 12 10"
                    >
                      <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m7 9 4-4-4-4M1 9l4-4-4-4"
                      />
                    </svg>
                  </li>
                  <li class="flex items-center">
                    <span
                      class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400"
                    >
                      3
                    </span>
                    Check Remedial Results
                  </li>
                </ol>
                <div
                  class="h-full mt-2 w-full px-3 py-6 space-x-2 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse"
                >
                  <div class="mb-4">
                    <h3
                      class="mb-5 text-lg font-medium text-gray-900 dark:text-white"
                    >
                      Apakah ada Dokumen Hasil Penilaian ?
                    </h3>
                    <ul class="grid w-full gap-6 md:grid-cols-2">
                      <li>
                        <input
                          type="radio"
                          id="doc_nilai1"
                          name="doc_nilai"
                          value="1"
                          class="hidden peer"
                          required
                        />
                        <label
                          for="doc_nilai1"
                          class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                        >
                          <div class="block">
                            <div class="w-full text-lg font-semibold">Yes</div>
                          </div>
                        </label>
                      </li>
                      <li>
                        <input
                          type="radio"
                          id="doc_nilai0"
                          name="doc_nilai"
                          value="0"
                          class="hidden peer"
                        />
                        <label
                          for="doc_nilai0"
                          class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                        >
                          <div class="block">
                            <div class="w-full text-lg font-semibold">No</div>
                          </div>
                        </label>
                      </li>
                    </ul>
                  </div>

                  <div class="mb-8">
                    <h3
                      class="mb-5 text-lg font-medium text-gray-900 dark:text-white"
                    >
                      Apakah ada Dokumen Hasil Program Remedial dan Pengayaan ?
                    </h3>
                    <ul class="grid w-full gap-6 md:grid-cols-2">
                      <li>
                        <input
                          type="radio"
                          id="doc_remedial1"
                          name="remedial"
                          value="1"
                          class="hidden peer"
                          required
                        />
                        <label
                          for="doc_remedial1"
                          class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                        >
                          <div class="block">
                            <div class="w-full text-lg font-semibold">Yes</div>
                          </div>
                        </label>
                      </li>
                      <li>
                        <input
                          type="radio"
                          id="doc_remedial0"
                          name="remedial"
                          value="0"
                          class="hidden peer"
                        />
                        <label
                          for="doc_remedial0"
                          class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                        >
                          <div class="block">
                            <div class="w-full text-lg font-semibold">No</div>
                          </div>
                        </label>
                      </li>
                    </ul>
                  </div>
                  <div class="text-right">
                    <button
                      type="button"
                      onclick="nextStep()"
                      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-3 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    >
                      Selanjutnya
                    </button>
                  </div>
                </div>
              </div>
              <div id="step-2" class="step-content hidden">
                <ol
                  class="flex items-center w-full p-3 space-x-2 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse"
                >
                  <li
                    class="flex items-center text-green-600 dark:text-green-500"
                  >
                    <span
                      class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-green-600 rounded-full shrink-0 dark:border-green-500"
                    >
                      1
                    </span>
                    Document Check
                    <svg
                      class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180"
                      aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 12 10"
                    >
                      <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m7 9 4-4-4-4M1 9l4-4-4-4"
                      />
                    </svg>
                  </li>
                  <li
                    class="flex items-center text-blue-600 dark:text-blue-500"
                  >
                    <span
                      class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500"
                    >
                      2
                    </span>
                    Program Remedial Check
                    <svg
                      class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180"
                      aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 12 10"
                    >
                      <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m7 9 4-4-4-4M1 9l4-4-4-4"
                      />
                    </svg>
                  </li>
                  <li class="flex items-center">
                    <span
                      class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400"
                    >
                      3
                    </span>
                    Check Remedial Results
                  </li>
                </ol>
                <div
                  class="h-full mt-2 w-full px-3 py-6 space-x-2 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse"
                >
                  <div class="mb-4">
                    <h3
                      class="mb-5 text-lg font-medium text-gray-900 dark:text-white"
                    >
                      Apakah Program dilakukan Sesuai dengan Jadwal?
                    </h3>
                    <ul class="grid w-full gap-6 md:grid-cols-2">
                      <li>
                        <input
                          type="radio"
                          id="sesuai_jadwal1"
                          name="sesuai_jadwal"
                          value="1"
                          class="hidden peer"
                          required
                        />
                        <label
                          for="sesuai_jadwal1"
                          class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                        >
                          <div class="block">
                            <div class="w-full text-lg font-semibold">Yes</div>
                          </div>
                        </label>
                      </li>
                      <li>
                        <input
                          type="radio"
                          id="sesuai_jadwal0"
                          name="sesuai_jadwal"
                          value="0"
                          class="hidden peer"
                        />
                        <label
                          for="sesuai_jadwal0"
                          class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                        >
                          <div class="block">
                            <div class="w-full text-lg font-semibold">No</div>
                          </div>
                        </label>
                      </li>
                    </ul>
                  </div>
                  <div class="mb-8">
                    <h3
                      class="mb-5 text-lg font-medium text-gray-900 dark:text-white"
                    >
                      Apakah Program dilakukan dengan Metode yang Beragam ?
                    </h3>
                    <ul class="grid w-full gap-6 md:grid-cols-2">
                      <li>
                        <input
                          type="radio"
                          id="metode_beragam1"
                          name="metode_beragam"
                          value="1"
                          class="hidden peer"
                          required
                        />
                        <label
                          for="metode_beragam1"
                          class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                        >
                          <div class="block">
                            <div class="w-full text-lg font-semibold">Yes</div>
                          </div>
                        </label>
                      </li>
                      <li>
                        <input
                          type="radio"
                          id="metode_beragam0"
                          name="metode_beragam"
                          value="0"
                          class="hidden peer"
                        />
                        <label
                          for="metode_beragam0"
                          class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                        >
                          <div class="block">
                            <div class="w-full text-lg font-semibold">No</div>
                          </div>
                        </label>
                      </li>
                    </ul>
                  </div>
                  <div class="mb-8">
                    <h3
                      class="mb-5 text-lg font-medium text-gray-900 dark:text-white"
                    >
                      Apakah Program dilakukan Secara Berkelanjutan ?
                    </h3>
                    <ul class="grid w-full gap-6 md:grid-cols-2">
                      <li>
                        <input
                          type="radio"
                          id="berkelanjutan1"
                          name="berkelanjutan"
                          value="1"
                          class="hidden peer"
                          required
                        />
                        <label
                          for="berkelanjutan1"
                          class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                        >
                          <div class="block">
                            <div class="w-full text-lg font-semibold">Yes</div>
                          </div>
                        </label>
                      </li>
                      <li>
                        <input
                          type="radio"
                          id="berkelanjutan0"
                          name="berkelanjutan"
                          value="0"
                          class="hidden peer"
                        />
                        <label
                          for="berkelanjutan0"
                          class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                        >
                          <div class="block">
                            <div class="w-full text-lg font-semibold">No</div>
                          </div>
                        </label>
                      </li>
                    </ul>
                  </div>
                  <div class="text-right">
                    <button
                      type="button"
                      onclick="prevStep()"
                      class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800"
                    >
                      Sebelum
                    </button>
                    <button
                      type="button"
                      onclick="nextStep()"
                      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-3 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    >
                      Selanjutnya
                    </button>
                  </div>
                </div>
              </div>
              <div id="step-3" class="step-content hidden">
                <ol
                  class="flex items-center w-full p-3 space-x-2 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse"
                >
                  <li
                    class="flex items-center text-green-600 dark:text-green-500"
                  >
                    <span
                      class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-green-600 rounded-full shrink-0 dark:border-green-500"
                    >
                      1
                    </span>
                    Document Check
                    <svg
                      class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180"
                      aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 12 10"
                    >
                      <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m7 9 4-4-4-4M1 9l4-4-4-4"
                      />
                    </svg>
                  </li>
                  <li
                    class="flex items-center text-green-600 dark:text-green-500"
                  >
                    <span
                      class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-green-600 rounded-full shrink-0 dark:border-green-500"
                    >
                      2
                    </span>
                    Program Remedial Check
                    <svg
                      class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180"
                      aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 12 10"
                    >
                      <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m7 9 4-4-4-4M1 9l4-4-4-4"
                      />
                    </svg>
                  </li>
                  <li
                    class="flex items-center text-blue-600 dark:text-blue-500"
                  >
                    <span
                      class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500"
                    >
                      3
                    </span>
                    Check Remedial Results
                  </li>
                </ol>
                <div
                  class="h-full mt-2 w-full px-3 py-6 space-x-2 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse"
                >
                  <div class="mb-8">
                    <h3
                      class="mb-5 text-lg font-medium text-gray-900 dark:text-white"
                    >
                      Apakah Hasil Program Mengalami Peningkatan Nilai ?
                    </h3>
                    <ul class="grid w-full gap-6 md:grid-cols-2">
                      <li>
                        <input
                          type="radio"
                          id="peningkatan1"
                          name="peningkatan"
                          value="1"
                          class="hidden peer"
                          required
                        />
                        <label
                          for="peningkatan1"
                          class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                        >
                          <div class="block">
                            <div class="w-full text-lg font-semibold">Yes</div>
                          </div>
                        </label>
                      </li>
                      <li>
                        <input
                          type="radio"
                          id="peningkatan0"
                          name="peningkatan"
                          value="0"
                          class="hidden peer"
                        />
                        <label
                          for="peningkatan0"
                          class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                        >
                          <div class="block">
                            <div class="w-full text-lg font-semibold">No</div>
                          </div>
                        </label>
                      </li>
                    </ul>
                  </div>
                  <div class="text-right">
                    <button
                      type="button"
                      onclick="prevStep()"
                      class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800"
                    >
                      Sebelum
                    </button>
                    <button
                      type="submit"
                      name="simpan"
                      value="true"
                      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-3 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    >
                      Submit
                    </button>
                  </div>
                </div>
              </div>
            </form>
            <!-- End -->
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script>
      let currentStep = 1;

      function showStep(step) {
        document.querySelectorAll(".step-content").forEach((content, index) => {
          content.classList.toggle("hidden", index + 1 !== step);
        });
        currentStep = step;
        updateStepper();
      }

      function nextStep() {
        if (currentStep < 3) showStep(currentStep + 1);
      }

      function prevStep() {
        if (currentStep > 1) showStep(currentStep - 1);
      }

      function updateStepper() {
        document
          .querySelectorAll("#stepper .step button")
          .forEach((btn, index) => {
            btn.classList.toggle("text-blue-500", index + 1 === currentStep);
            btn.classList.toggle("text-gray-500", index + 1 !== currentStep);
          });
      }
      showStep(1); // Start with step 1
    </script>
  </body>
</html>
