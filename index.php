<?php
// index.php

// Include Koneksi.php
require_once 'src/koneksi.php';

// Initialize the error variable
$error = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check for default admin credentials
    if ($email === 'admin@admin.disdindik.sch.id' && $password === '#Admin123') {
        session_start();
        $_SESSION['nama'] = 'Admin';
        $_SESSION['jabatan'] = 'admin';
        
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
        $nama = $user_data['nama'];
        $jabatan = $user_data['jabatan'];

        session_start();
        $_SESSION['nama'] = $nama;
        $_SESSION['jabatan'] = $jabatan;

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
        <?php if (isset($error)): ?>
            <p class="text-red-500 text-center mb-4"><?= $error ?></p>
        <?php endif; ?>
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
              class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
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
              class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="Enter your password"
              required
            />
            <a
              href="#"
              class="text-xs text-gray-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              >Forgot Password?</a
            >
          </div>
          <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
              <input
                type="checkbox"
                id="remember"
                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 focus:outline-none"
                checked
              />
              <label
                for="remember"
                class="ml-2 block text-sm text-gray-700 dark:text-gray-300"
                >Remember me</label
              >
            </div>
          </div>
          <button
            type="submit" name="login" value="Login"
            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          >
            Login
          </button>
        </form>
        <?php if (isset($error)) { echo $error; } ?>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
  </body>
</html>
