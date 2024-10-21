<?php
// index.php

// Include Koneksi.php
require_once 'src/koneksi.php';
session_start();
session_unset();
session_destroy();
// Initialize the error variable
$error = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check for default admin credentials
    if ($email === 'admin@admin.disdindik.sch.id' && $password === '#Admin123') {
        session_start();
        $_SESSION['id'] = 'Admin';
        $_SESSION['nama'] = 'Admin';
        $_SESSION['jabatan'] = 'admin';
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        
        header('Location: src/admin/dashboard.php');
        exit;
    }

    // Query to retrieve user data
    $query = "SELECT * FROM tendik WHERE email = ? AND password = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, get name, jabatan, and set session
        $user_data = $result->fetch_assoc();
        $id = $user_data['id'];
        $nama = $user_data['nama'];
        $jabatan = $user_data['jabatan'];

        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['nama'] = $nama;
        $_SESSION['jabatan'] = $jabatan;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;


        // Redirect to specific page based on jabatan
        switch ($jabatan) {
            case 'Kepsek':
                header('Location: src/kepsek/dashboard.php');
                break;
            case 'Guru':
                header('Location: src/guru/dashboard.php');
                break;
            case 'Pengawas':
                header('Location: src/pengawas/dashboard.php');
                break;
            default:
                $error = 'Invalid jabatan';
        }
        exit;
    } else {
        // User not found, display error message
        $error = 'Email or password is incorrect';
    }

    $stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en">
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
    <script>
      // Menghapus isi form saat halaman dimuat
        window.onload = function() {
        document.getElementById("email").value = '';
        document.getElementById("password").value = '';
      }
    </script>
  </head>
  <body class="flex items-center h-screen">
    <!-- component -->
    <div
      class="min-h-screen flex items-center justify-center w-full dark:bg-gray-950"
    >
      <div
        class="bg-white dark:bg-gray-900 shadow-md rounded-lg px-8 py-6 max-w-md"
      >
        <h1 class="text-2xl font-bold text-center mb-4 dark:text-gray-200">
          Welcome Back!
        </h1>
        <?php if ($error !== ''): echo"
          <div class='flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400' role='alert'>
            <svg class='flex-shrink-0 inline w-4 h-4 me-3' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='currentColor' viewBox='0 0 20 20'>
              <path d='M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z'/>
            </svg>
            <span class='sr-only'>Info</span>
            <div>
              <span class='font-medium'> $error!</span> make sure to fill it in correctly.
            </div>
          </div>";
         endif; ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="mb-4">
            <label
              for="email"
              class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
              >Email Address</label
            >
            <input
              type="email"
              name="email"
              id="email"
              class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
              placeholder="your@email.com"
              required
            />
          </div>
          <div class="mb-4">
            <label
              for="password"
              class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
              >Password</label
            >
            <input
              type="password"
              id="password"
              name="password"
              class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
              placeholder="Enter your password"
              required
            />
            <a
              href="#"
              class="text-xs text-gray-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
              >Forgot Password?</a
            >
          </div>
          <div class="flex items-center justify-between mb-4">
          </div>
          <button
            type="submit" name="login" value="Login"
            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
          >
            Login
          </button>
        </form>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
  </body>
</html>
