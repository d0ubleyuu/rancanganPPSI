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
$id_kepsek = $_SESSION['id'];
$sql_detail = mysqli_query($koneksi, "SELECT * FROM tendik WHERE id = '$id_kepsek'");
$detail_kepsek = mysqli_fetch_array($sql_detail);
$id_sekolah = $detail_kepsek['id_sekolah'];

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
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Penilaian Mutu | Sistem Informasi Mutu Program Remedial dan Pengayaan</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="..\css\output.css" rel="stylesheet" />
    <script src="node_modules\flowbite\dist\flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-minimal@4/minimal.css" rel="stylesheet">
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
                alt="Logo Dinas Kelas dan Kebudayaan"
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
    <div class="sm:ml-64">
      <div
        class="border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14"
      >
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
                       <span class="ms-1 text-sm font-medium text-gray-700 md:ms-2 dark:text-gray-400 dark:hover:text-white">Penilaian</a>
                     </div>
                   </li>
                 </ol>
               </nav>
               <h2 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">Kelola Penilaian Program & Pengayaan</h2>
            </div>
            <div
              class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden"
            >
              <div
                class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4"
              >
                <div class="flex-1 flex items-center space-x-2">
                  <h5>
                    <span class="text-gray-500">Result:</span>
                    <span class="dark:text-white"><?=(isset($_GET['KataKunci'])) ? $_GET['KataKunci'] : "Semua Mata Pelajaran";?></span>
                  </h5>
                </div>
              </div>
              <div
                class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700"
              >
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
                    "<a href='penilaian.php' class='absolute inset-y-0 end-0 flex items-center pe-3'>
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
              </div>
              <div class="overflow-x-auto">
                <table
                  class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                >
                  <thead
                  class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                  >
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
                    $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
                    $kolomCari = (isset($_GET['Kolom'])) ? $_GET['Kolom'] : "";
                    $kolomKataKunci = (isset($_GET['KataKunci'])) ? $_GET['KataKunci'] : "";
    
                    // Jumlah data per halaman
                    $limit = 5;
    
                    $limitStart = ($page - 1) * $limit;
    
                    //kondisi jika parameter pencarian kosong
                    if ($kolomKataKunci == "") {
                      $mapel = mysqli_query($koneksi, "SELECT mapel.id AS id, mapel.kode_mapel AS kode_mapel, mapel.nama AS nama_mapel, tendik.nama AS nama_guru, mapel.kkm AS kkm, mapel.kelas AS kelas, mapel.ta AS ta, mapel.mutu FROM `mapel` INNER JOIN tendik ON mapel.id_guru = tendik.id JOIN sekolah ON tendik.id_sekolah = sekolah.id WHERE sekolah.id = $id_sekolah LIMIT " . $limitStart . "," . $limit);
                    } else {
                        //kondisi jika parameter kolom pencarian diisi
                      $mapel = mysqli_query($koneksi, "SELECT mapel.id AS id, mapel.kode_mapel AS kode_mapel, mapel.nama AS nama_mapel, tendik.nama AS nama_guru, mapel.kkm AS kkm, mapel.kelas AS kelas, mapel.ta AS ta, mapel.mutu FROM `mapel` INNER JOIN tendik ON mapel.id_guru = tendik.id JOIN sekolah ON tendik.id_sekolah = sekolah.id WHERE sekolah.id = $id_sekolah AND mapel.nama LIKE '%$kolomKataKunci%' OR mapel.kode_mapel LIKE '%$kolomKataKunci%' OR tendik.nama LIKE '%$kolomKataKunci%' OR mapel.kode_mapel LIKE '%$kolomKataKunci%' OR mapel.kelas LIKE '%$kolomKataKunci%' OR mapel.ta LIKE '%$kolomKataKunci%' OR mapel.kkm LIKE '%$kolomKataKunci%' LIMIT " . $limitStart . "," . $limit);
                    }
                    $no = $limitStart + 1;
    
                    $no = 1;
                    foreach ($mapel as $row) {
                      
                  ?>
                    <tr
                      class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700"
                    >
                      <th
                        scope="row"
                        class="pl-8 px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
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
                      <?php echo $row['kelas'];?>
                    </td>
                    <td
                      class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    >
                      <?php echo $row['ta'];?>
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
                        <?php 
                          $id_mapel = $row['id'];
                          $mapel = mysqli_query($koneksi, "SELECT * FROM penilaian_mutu WHERE id_mapel = '$id_mapel'");
                          $jumlah_data = mysqli_num_rows($mapel);
                        ?>
                        <div class="flex items-center space-x-4">
                            <!-- Tombol Menilai -->
                            <form action="penilaian1.php" method="POST">
                                <input type="hidden" name="id_mapel" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="id_kepsek" value="<?=$_SESSION['id']?>">
                                <button
                                    type="submit"
                                    name="btn-menilai"
                                    aria-controls="drawer-update-product"
                                    class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 <?php if ($jumlah_data > 0) echo 'cursor-not-allowed'; ?> "
                                    <?php if ($jumlah_data > 0) echo 'disabled'; ?> 
                                >
                                    <svg
                                        viewBox="0 0 20 20"
                                        class="h-4 w-4 mr-2 -ml-0.5"
                                        fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M15.879 5H4C3.46957 5 2.96086 5.21071 2.58579 5.58578C2.21071 5.96086 2 6.46957 2 7V13C2 13.5304 2.21071 14.0391 2.58579 14.4142C2.96086 14.7893 3.46957 15 4 15H16C16.5304 15 17.0391 14.7893 17.4142 14.4142C17.7893 14.0391 18 13.5304 18 13V7.121L13.56 11.561C13.277 11.8341 12.898 11.9851 12.5047 11.9815C12.1114 11.9779 11.7353 11.82 11.4573 11.5417C11.1793 11.2635 11.0217 10.8872 11.0185 10.4939C11.0153 10.1006 11.1666 9.72177 11.44 9.439L15.879 5ZM4 8.5C4 8.36739 4.05268 8.24021 4.14645 8.14644C4.24021 8.05268 4.36739 8 4.5 8H6.5C6.63261 8 6.75979 8.05268 6.85355 8.14644C6.94732 8.24021 7 8.36739 7 8.5C7 8.63261 6.94732 8.75978 6.85355 8.85355C6.75979 8.94732 6.63261 9 6.5 9H4.5C4.36739 9 4.24021 8.94732 4.14645 8.85355C4.05268 8.75978 4 8.63261 4 8.5ZM4 11.5C4 11.3674 4.05268 11.2402 4.14645 11.1464C4.24021 11.0527 4.36739 11 4.5 11H9C9.13261 11 9.25979 11.0527 9.35355 11.1464C9.44732 11.2402 9.5 11.3674 9.5 11.5C9.5 11.6326 9.44732 11.7598 9.35355 11.8536C9.25979 11.9473 9.13261 12 9 12H4.5C4.36739 12 4.24021 11.9473 4.14645 11.8536C4.05268 11.7598 4 11.6326 4 11.5ZM17.854 5.854C17.9479 5.76011 18.0006 5.63277 18.0006 5.5C18.0006 5.36722 17.9479 5.23989 17.854 5.146C17.7601 5.05211 17.6328 4.99937 17.5 4.99937C17.3672 4.99937 17.2399 5.05211 17.146 5.146L12.146 10.146C12.0521 10.2399 11.9994 10.3672 11.9994 10.5C11.9994 10.6328 12.0521 10.7601 12.146 10.854C12.2399 10.9479 12.3672 11.0006 12.5 11.0006C12.6328 11.0006 12.7601 10.9479 12.854 10.854L17.854 5.854Z"
                                        />
                                    </svg>
                                    Menilai
                                </button>
                            </form>

                            <!-- Tombol Preview -->
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
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <?php
              //kondisi jika parameter pencarian kosong
              if ($kolomKataKunci == "") {
                $countStmt = mysqli_query($koneksi,"SELECT COUNT(*) AS total_baris FROM mapel INNER JOIN tendik ON mapel.id_guru = tendik.id JOIN sekolah ON tendik.id_sekolah = sekolah.id WHERE sekolah.id = $id_sekolah");
              } else {
                $countStmt = mysqli_query($koneksi,"SELECT COUNT(*) AS total_baris from mapel INNER JOIN tendik ON mapel.id_guru = tendik.id JOIN sekolah ON tendik.id_sekolah = sekolah.id WHERE sekolah.id = $id_sekolah AND mapel.nama LIKE '%$kolomKataKunci%' OR tendik.nama LIKE '%$kolomKataKunci%' OR mapel.kode_mapel LIKE '%$kolomKataKunci%' OR mapel.kode_mapel LIKE '%$kolomKataKunci%' OR mapel.kelas LIKE '%$kolomKataKunci%' OR mapel.ta LIKE '%$kolomKataKunci%' OR mapel.kkm LIKE '%$kolomKataKunci%'"); 

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
                      href="penilaian.php?page=<?php echo $LinkPrev; ?>"
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
                      href="penilaian.php?KataKunci=<?php echo $kolomKataKunci; ?>&page=<?php echo $LinkPrev; ?>"
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
                                href="penilaian.php?page=<?php echo $i; ?>"
                                class="flex items-center justify-center text-sm py-2 px-3 leading-tight"
                                ><?php echo $i; ?></a
                              >
                            </li>
                            <?php
                        } else {
                            ?>
                                <li <?php echo $linkActive; echo $linkNonActive;?>>
                                <a href="penilaian.php?KataKunci=<?php echo $kolomKataKunci; ?>&page=<?php echo $i; ?>"
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
                              href="penilaian.php?page=<?php echo $linkNext; ?>"
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
                              href="penilaian.php?KataKunci=<?php echo $kolomKataKunci; ?>&page=<?php echo $linkNext; ?>"
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
      </div>
    </div>
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
  </body>
</html>
