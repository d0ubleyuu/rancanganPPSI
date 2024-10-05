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
                      href="#"
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

    <div class="p-4 h-full">
      <div
        class="px-4 py-8 flex flex-col items-center justify-center border-2 border-gray-200 border-dashed rounded-lg h-full dark:border-gray-700 mt-14 text-center"
      >
        <span class="font-semibold text-2xl underline"
          >Hasil Penilaian Capaian Program Remedial dan Pengayaan</span
        >
        <div class="flex items-center mt-8">
          <svg
            class="w-8 h-8 ms-3 text-yellow-300"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="currentColor"
            viewBox="0 0 22 20"
          >
            <path
              d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"
            />
          </svg>
          <svg
            class="w-8 h-8 ms-3 text-yellow-300"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="currentColor"
            viewBox="0 0 22 20"
          >
            <path
              d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"
            />
          </svg>
          <svg
            class="w-8 h-8 ms-3 text-gray-300 dark:text-gray-500"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="currentColor"
            viewBox="0 0 22 20"
          >
            <path
              d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"
            />
          </svg>
          <svg
            class="w-8 h-8 ms-3 text-gray-300 dark:text-gray-500"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="currentColor"
            viewBox="0 0 22 20"
          >
            <path
              d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"
            />
          </svg>
        </div>

        <div class="flex gap-6 items-start mt-8 mb-16 w-full">
          <div class="bg-white overflow-hidden shadow rounded-lg border w-full">
            <div class="px-4 py-5 sm:px-6">
              <h3 class="text-lg leading-6 font-medium text-gray-900">
                Detail Mata Pelajaran
              </h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
              <dl class="sm:divide-y sm:divide-gray-200">
                <div
                  class="py-3 sm:py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6"
                >
                  <dt class="text-sm font-medium text-gray-500">Nama Mapel</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    Fisika
                  </dd>
                </div>
                <div
                  class="py-3 sm:py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6"
                >
                  <dt class="text-sm font-medium text-gray-500">
                    Guru Pengajar
                  </dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    Jonathan
                  </dd>
                </div>
                <div
                  class="py-3 sm:py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6"
                >
                  <dt class="text-sm font-medium text-gray-500">Kelas</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    XI
                  </dd>
                </div>
                <div
                  class="py-3 sm:py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6"
                >
                  <dt class="text-sm font-medium text-gray-500">Tahun Ajar</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    2024/2025
                  </dd>
                </div>
              </dl>
            </div>
          </div>
          <div
            class="bg-white overflow-hidden shadow rounded-lg border w-full h-full"
          >
            <div class="px-4 py-5 sm:px-6">
              <h3 class="text-lg leading-6 font-medium text-gray-900">
                Detail Penilaian Program
              </h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
              <dl class="sm:divide-y sm:divide-gray-200">
                <div
                  class="py-3 sm:py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6"
                >
                  <dt class="text-sm font-medium text-gray-500">
                    Waktu Penilaian
                  </dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    Senin 23/09/2024 15:02:00
                  </dd>
                </div>
                <div
                  class="py-3 sm:py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6"
                >
                  <dt class="text-sm font-medium text-gray-500">Penilai</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    Suarti
                  </dd>
                </div>
              </dl>
            </div>
          </div>
        </div>
        <div class="flex gap-6 items-start mt-8 w-full">
          <div class="bg-white overflow-hidden shadow rounded-lg border w-full">
            <div class="px-4 py-5 sm:px-6">
              <h3 class="text-lg leading-6 font-medium text-gray-900">
                Hasil Penilaian
              </h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
              <dl class="sm:divide-y sm:divide-gray-200">
                <div
                  class="py-3 sm:py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6"
                >
                  <dt class="text-lg font-medium text-gray-500">
                    Program Dilaksanakan Sesuai Kebutuhan
                  </dt>
                  <dd class="mt-1 text-lg text-gray-900 sm:mt-0 sm:col-span-2">
                    ✅
                  </dd>
                </div>
                <div
                  class="py-3 sm:py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6"
                >
                  <dt class="text-lg font-medium text-gray-500">
                    Program Dilaksanakan Secara Sistematis dan Terstruktur
                  </dt>
                  <dd class="mt-1 text-lg text-gray-900 sm:mt-0 sm:col-span-2">
                    ✅
                  </dd>
                </div>
                <div
                  class="py-3 sm:py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6"
                >
                  <dt class="text-lg font-medium text-gray-500">
                    Program Terintegrasi Secara Berkelanjutan
                  </dt>
                  <dd class="mt-1 text-lg text-gray-900 sm:mt-0 sm:col-span-2">
                    ❌
                  </dd>
                </div>
                <div
                  class="py-3 sm:py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6"
                >
                  <dt class="text-lg font-medium text-gray-500">
                    Program Dilaksanakan dengan Berbagai Strategi dan Metode
                  </dt>
                  <dd class="mt-1 text-lg text-gray-900 sm:mt-0 sm:col-span-2">
                    ✅
                  </dd>
                </div>
                <div
                  class="py-3 sm:py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6"
                >
                  <dt class="text-lg font-medium text-gray-500">
                    Program Berpengaruh Kepada Peningkatan Hasil Belajar
                  </dt>
                  <dd class="mt-1 text-lg text-gray-900 sm:mt-0 sm:col-span-2">
                    ⚠️
                  </dd>
                </div>
              </dl>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>