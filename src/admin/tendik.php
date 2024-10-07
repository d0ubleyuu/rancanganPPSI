<?php
// Include Koneksi.php
require_once '../koneksi.php';

// Bagian Insert (Create)
if (isset($_POST['submit_add'])) {
  $id_sekolah = $_POST['id_sekolah'];
  $nama = $_POST['nama'];
  $nip = $_POST['nip'];
  $jk = $_POST['jk'];
  $jabatan = $_POST['jabatan'];
  $pendidikan = $_POST['pendidikan'];
  $password = substr($nip, -8);
  $username = str_replace('. ', '.', $nama);
  $username = str_replace(' ', '.', $username) . substr($nip, -4);
  $email = "$username@$jabatan.disdindik.sch.id";
  $email = strtolower($email);

  $sql = "INSERT INTO tendik (id_sekolah, nama, nip, jk, jabatan, pendidikan, email, password) 
          VALUES ('$id_sekolah', '$nama', '$nip', '$jk', '$jabatan', '$pendidikan', '$email', '$password')";

  if ($koneksi->query($sql) === TRUE) {
      // Redirect to tendikk.php after successful insertion
      header("Location: tendik.php");
      exit();
  } else {
      echo "Error: " . $sql . "<br>" . $koneksi->error;
  }
}


// Update existing record
if (isset($_POST['submit_edit'])) {
    $id = $_POST['id'];
    $id_sekolah = $_POST['id_sekolah'];
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $jk = $_POST['jk'];
    $jabatan = $_POST['jabatan'];
    $pendidikan = $_POST['pendidikan'];

    $sql = "UPDATE tendik SET id_sekolah='$id_sekolah', nama='$nama', nip='$nip', jk='$jk', 
            jabatan='$jabatan', pendidikan='$pendidikan' WHERE id='$id'";

    if ($koneksi->query($sql) === TRUE) {
        // Redirect to tendikk.php after successful update
        header("Location: tendik.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

// Reset Password
if (isset($_POST['reset_password'])) {
    $id = $_POST['id'];
    $pass = $_POST['nip'];
    $password = substr($pass, -8);

    $sql = "UPDATE tendik SET password='$password' WHERE id='$id'";

    if ($koneksi->query($sql) === TRUE) {
        // Redirect to tendikk.php after successful update
        header("Location: tendik.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

// Delete record
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM tendik WHERE id='$id'";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

// Fetch record for editing
$edit_row = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM tendik WHERE id='$id'";
    $result = $koneksi->query($sql);
    $edit_row = $result->fetch_assoc();
}

// Fetch all records (Read)
$sql = "SELECT * FROM tendik";
$result = $koneksi->query($sql);

// Query untuk menghitung jumlah ID dalam tabel tendik
$queryTendik = "SELECT COUNT(id) as total FROM tendik";
$resultTendik = $koneksi->query($queryTendik);
$totalTendik = 0;

if ($resultTendik->num_rows > 0) {
    $data = $resultTendik->fetch_assoc();
    $totalTendik = $data['total'];
}
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
                alt="Logo Dinas Jabatan dan Kebudayaan"
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
    <div class="sm:ml-64">
      <div
        class="border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14"
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
                    <span class="text-gray-500">Semua Guru dan Tendik:</span>
                    <span class="dark:text-white"><?= $totalTendik ?></span>
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
                        placeholder="Cari Guru dan Tendik"
                        required=""
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      />
                    </div>
                  </form>
                </div>
                <div
                  class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0"
                >
                  <button
                    type="button"
                    id="createProductModalButton"
                    data-modal-target="createProductModal"
                    data-modal-toggle="createProductModal"
                    class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                  >
                    <svg
                      class="h-3.5 w-3.5 mr-2"
                      fill="currentColor"
                      viewbox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg"
                      aria-hidden="true"
                    >
                      <path
                        clip-rule="evenodd"
                        fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                      />
                    </svg>
                    Tambah Guru dan Tendik
                  </button>
                  <div
                    id="filterDropdown"
                    class="z-10 hidden px-3 pt-1 bg-white rounded-lg shadow w-80 dark:bg-gray-700 right-0"
                  >
                    <div class="flex items-center justify-between pt-2">
                      <h6
                        class="text-sm font-medium text-black dark:text-white"
                      >
                        Filters
                      </h6>
                      <div class="flex items-center space-x-3">
                        <a
                          href="#"
                          class="flex items-center text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline"
                          >Save view</a
                        >
                        <a
                          href="#"
                          class="flex items-center text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline"
                          >Clear all</a
                        >
                      </div>
                    </div>
                    <div class="pt-3 pb-2">
                      <label for="input-group-search" class="sr-only"
                        >Search</label
                      >
                      <div class="relative">
                        <div
                          class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none"
                        >
                          <svg
                            class="w-4 h-4 text-gray-500 dark:text-gray-400"
                            aria-hidden="true"
                            fill="currentColor"
                            viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              fill-rule="evenodd"
                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                              clip-rule="evenodd"
                            />
                          </svg>
                        </div>
                        <input
                          type="text"
                          id="input-group-search"
                          class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          placeholder="Search keywords..."
                        />
                      </div>
                    </div>
                  </div>
                  <div class="flex items-center space-x-3 w-full md:w-auto">
                    <button
                      id="actionGururopdownButton"
                      data-dropdown-toggle="actionGururopdown"
                      class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                      type="button"
                    >
                      Actions
                      <svg
                        class="-mr-1 ml-1.5 w-5 h-5"
                        fill="currentColor"
                        viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true"
                      >
                        <path
                          clip-rule="evenodd"
                          fill-rule="evenodd"
                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        />
                      </svg>
                    </button>
                    <div
                      id="actionGururopdown"
                      class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                    >
                      <ul
                        class="py-1 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="actionGururopdownButton"
                      >
                        <li>
                          <a
                            href="#"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            >Mass Edit</a
                          >
                        </li>
                      </ul>
                      <div class="py-1">
                        <a
                          href="#"
                          class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                          >Delete all</a
                        >
                      </div>
                    </div>
                  </div>
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
                      <th scope="col" class="p-4">Nama</th>
                      <th scope="col" class="p-4">NIP</th>
                      <th scope="col" class="p-4">Jabatan</th>
                      <th scope="col" class="p-4">JK</th>
                      <th scope="col" class="p-4">TTL</th>
                      <th scope="col" class="p-4">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php while($row = $result->fetch_assoc()): ?>
                    <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                              <td class="p-4 w-4">
                                  <div class="flex items-center">
                                      <input
                                          id="checkbox-table-search-<?php echo $row['id']; ?>"
                                          type="checkbox"
                                          onclick="event.stopPropagation()"
                                          class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                      />
                                      <label for="checkbox-table-search-<?php echo $row['id']; ?>" class="sr-only">checkbox</label>
                                  </div>
                              </td>
                              <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                  <div class="flex items-center mr-3"><?php echo $row['nama']; // Menampilkan nama dari tabel tendikk ?></div>
                              </th>
                              <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                  <?php echo $row['nip']; ?>
                              </td>
                              <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                  <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                      <?php echo $row['jabatan']; ?>
                                  </span>
                              </td>
                              <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                  <?php echo $row['jk']; ?>
                              </td>
                              <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                  <?php echo $row['pendidikan']; ?>
                              </td>
                              <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                  <div class="flex items-center space-x-4">
                                  <button 
                                    type="button" 
                                    data-modal-target="updateProductModal<?php echo $row['id']; ?>" 
                                    data-modal-toggle="updateProductModal<?php echo $row['id']; ?>"
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
                                      <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?');" class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                          d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                          clip-rule="evenodd" />
                                      </svg>
                                      Delete</a>
                                      <!-- Tombol Preview -->
                            <form action="" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="nip" value="<?php echo $row['nip']; ?>">
                                <button
                                    type="submit"
                                    name="reset_password"
                                    aria-controls="drawer-update-product"
                                    class="py-2 px-3 flex items-center text-sm font-medium text-center rounded-lg text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 me-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 "
                                >
                                    <svg class="h-4 w-4 mr-2 -ml-0.5" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 6V7.998H15V6H5ZM11.998 11V14H14.998V11H11.998ZM2 5.754C2 5.02465 2.28973 4.32518 2.80546 3.80945C3.32118 3.29373 4.02065 3.004 4.75 3.004H15.25C15.9792 3.004 16.6785 3.29359 17.1942 3.8091C17.7099 4.32461 17.9997 5.02383 18 5.753V14.253C18 14.9823 17.7103 15.6818 17.1945 16.1975C16.6788 16.7133 15.9793 17.003 15.25 17.003H4.75C4.02065 17.003 3.32118 16.7133 2.80546 16.1975C2.28973 15.6818 2 14.9823 2 14.253V5.754ZM4 5.5V8.498C4 8.63061 4.05268 8.75778 4.14645 8.85155C4.24021 8.94532 4.36739 8.998 4.5 8.998H15.5C15.6326 8.998 15.7598 8.94532 15.8536 8.85155C15.9473 8.75778 16 8.63061 16 8.498V5.5C16 5.36739 15.9473 5.24021 15.8536 5.14645C15.7598 5.05268 15.6326 5 15.5 5H4.5C4.36739 5 4.24021 5.05268 4.14645 5.14645C4.05268 5.24021 4 5.36739 4 5.5Z"></path>
                                    </svg>
                                    Reset Password
                                </button>
                            </form>
                                    </div>
                              </td>
                          </tr>
                          <!-- Modal Edit -->
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
                                    Update Data Tendik
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
                                <form method="POST">
                                  <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                    <input type="hidden" name="id" value=<?php echo $row['id']?> class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Insert Nama" required>
                                    <!-- ID Sekolah -->
                                    <div>
                                      <label for="id_sekolah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Sekolah</label>
                                      <select name="id_sekolah" id="id_sekolah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <?php 
                                        $sql_sekolah = "SELECT id, nama FROM sekolah";
                                        $result_sekolah = $koneksi->query($sql_sekolah);
                                        while($sekolah = $result_sekolah->fetch_assoc()): ?>
                                          <option value="<?php echo $sekolah['id']; ?>" <?php if (@$row['id_sekolah']  == $sekolah['id']) echo 'selected'; ?>><?php echo $sekolah['nama']; ?></option>
                                        <?php endwhile; ?>
                                      </select>
                                    </div>

                                    <!-- Nama -->
                                    <div>
                                      <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                      <input type="text" name="nama" id="nama" value=<?php echo $row['nama']?> class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Insert Nama" required>
                                    </div>

                                    <!-- NIP -->
                                    <div>
                                      <label for="nip" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIP</label>
                                      <input type="text" name="nip" id="nip" value=<?php echo $row['nip']; ?> class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Insert NIP" required>
                                    </div> 

                                    <!-- Jenis Kelamin -->
                                    <div>
                                      <label for="jk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</label>
                                      <select name="jk" id="jk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="L" <?php if ($row['jk']== 'L') echo 'selected'; ?>>Laki-laki</option>
                                        <option value="P"  <?php if ($row['jk']== 'P') echo 'selected'; ?>>Perempuan</option>
                                      </select>
                                    </div>

                                    <!-- Jabatan -->
                                    <div>
                                      <label for="jabatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan</label>
                                      <select name="jabatan" id="jabatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="Kepsek" <?php if ($row['jabatan']== 'Kepsek') echo 'selected'; ?>>Kepsek</option>
                                        <option value="Guru">Guru</option>
                                      </select>
                                    </div>

                                    <!-- Pendidikan -->
                                    <div>
                                      <label for="pendidikan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pendidikan</label>
                                      <select name="pendidikan" id="pendidikan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="SMAS/SMK" <?php if ($row['pendidikan']== 'SMAS/SMK') echo 'selected'; ?>>SMAS/SMK</option>
                                        <option value="D1" <?php if ($row['pendidikan']== 'D1') echo 'selected'; ?>>D1</option>
                                        <option value="D2" <?php if ($row['pendidikan']== 'D2') echo 'selected'; ?>>D2</option>
                                        <option value="D3" <?php if ($row['pendidikan']== 'D3') echo 'selected'; ?>>D3</option>
                                        <option value="D4" <?php if ($row['pendidikan']== 'D4') echo 'selected'; ?>>D4</option>
                                        <option value="S1" <?php if ($row['pendidikan']== 'S1') echo 'selected'; ?>>S1</option>
                                        <option value="S2" <?php if ($row['pendidikan']== 'S2') echo 'selected'; ?>>S2</option>
                                        <option value="S3" <?php if ($row['pendidikan']== 'S3') echo 'selected'; ?>>S3</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="flex items-center space-x-4">
                                    <button
                                      type="submit"
                                      name="submit_edit"
                                      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    >
                                      Update
                                    </button>
                                    </button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                      <?php endwhile; ?>
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
        <!-- End block -->
        <div
          id="createProductModal"
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
                  Tambah Guru dan Tendik
                </h3>
                <button
                  type="button"
                  class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                  data-modal-target="createProductModal"
                  data-modal-toggle="createProductModal"
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
              <form method="POST" action="tendik.php">
              <div class="grid gap-4 mb-4 sm:grid-cols-2">
                
                <!-- ID Sekolah -->
                <div>
                  <label for="id_sekolah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sekolah</label>
                  <select name="id_sekolah" id="id_sekolah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" >Pilih Sekolah</option>
                    <?php 
                    $sql_sekolah = "SELECT id, nama FROM sekolah";
                    $result_sekolah = $koneksi->query($sql_sekolah);
                    while($sekolah = $result_sekolah->fetch_assoc()): ?>
                      <option value="<?php echo $sekolah['id']; ?>"><?php echo $sekolah['nama']; ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>

                <!-- Nama -->
                <div>
                  <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                  <input type="text" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Insert Nama" required>
                </div>

                <!-- NIP -->
                <div>
                  <label for="nip" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIP</label>
                  <input type="text" name="nip" id="nip" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Insert NIP" required>
                </div>

                <!-- Jenis Kelamin -->
                <div>
                  <label for="jk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</label>
                  <select name="jk" id="jk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </div>

                <!-- Jabatan -->
                <div>
                  <label for="jabatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan</label>
                  <select name="jabatan" id="jabatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="Kepsek">Kepsek</option>
                    <option value="Guru">Guru</option>
                    <option value="Pengawas">Pengawas</option>
                  </select>
                </div>

                <!-- Pendidikan -->
                <div>
                  <label for="pendidikan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pendidikan</label>
                  <select name="pendidikan" id="pendidikan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="SMAS/SMK">SMAS/SMK</option>
                    <option value="D1">D1</option>
                    <option value="D2">D2</option>
                    <option value="D3">D3</option>
                    <option value="D4">D4</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                  </select>
                </div>
              </div>
              <div class="flex items-center space-x-4">
                <button
                  type="submit" name="submit_add"
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
                </div>
            </form>
            </div>
          </div>
        </div>
        <!-- Delete Modal -->
        <div
          id="deleteModal"
          tabindex="-1"
          aria-hidden="true"
          class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
        >
          <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div
              class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5"
            >
              <button
                type="button"
                class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-toggle="deleteModal"
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
              <svg
                class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto"
                aria-hidden="true"
                fill="currentColor"
                viewbox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                  clip-rule="evenodd"
                />
              </svg>
              <p class="mb-4 text-gray-500 dark:text-gray-300">
                Are you sure you want to delete this item?
              </p>
              <div class="flex justify-center items-center space-x-4">
                <button
                  data-modal-toggle="deleteModal"
                  type="button"
                  class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                >
                  No, cancel
                </button>
                <button
                  type="submit"
                  class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900"
                >
                  Yes, I'm sure
                </button>
              </div>
            </div>
          </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
  </body>
</html>
