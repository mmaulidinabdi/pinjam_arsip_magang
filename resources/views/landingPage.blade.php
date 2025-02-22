<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Landing Page</title>
</head>

<body>
    <nav id="navbar" class="p-5 transition-all duration-300 ease-in-out bg-black md:bg-transparent fixed w-full z-20 top-0 start-0">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{asset('img/dispersip_logo.png')}}" class="h-8" alt="Flowbite Logo">
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                @if (Auth::guard('admin')->check() || Auth::guard('web')->check())
                <a id="btnName" href="{{ Auth::guard('admin')->check() ? '/admin/dashboard' : '/user/dashboard' }}" class="text-white bg-blue-500 md:bg-transparent hover:bg-blue-800 focus:ring-4  font-medium rounded-lg text-sm px-4 py-2 text-center">
                    {{ Auth::guard('web')->check() ? Auth::user()->nama_lengkap : 'Admin'  }}
                </a>
                @else
                <a href="{{Route('login')}}" id="btnLogin" class="text-white bg-blue-500 md:bg-transparent hover:bg-blue-800 focus:ring-4  font-medium rounded-lg text-sm px-4 py-2 text-center">
                    Login
                </a>
                @endif
                <button id="hamburgerBtn" data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>

            <!-- Navbar Menu -->
            <div class="items-center mt-5 md:mt-0 justify-between hidden w-full md:flex md:w-auto md:order-1 bg-black md:bg-transparent" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium bg-black md:bg-transparent md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 ">
                    @if (Auth::guard('admin')->check() || Auth::guard('web')->check())
                    <li>
                        <a href="{{Auth::guard('admin')->check() ? '/admin/dashboard' : '/user/dashboard'}}" class="block py-2 px-3 text-white hover:text-black hover:bg-gray-100 rounded md:hover:bg-transparent md:p-0 md:hover:text-blue-700" aria-current="page">Dashboard</a>
                    </li>
                    @endif

                    <li>
                        <a href="#about" class="block py-2 px-3 text-white rounded hover:text-black hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
                    </li>
                    <li>
                        <a href="#article" class="block py-2 px-3 text-white rounded hover:text-black hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Article</a>
                    </li>
                    <li>
                        <a href="#contact" class="block py-2 px-3 text-white rounded hover:text-black hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>





    <div class="relative pt-[8rem] ">

        <!-- Background gradient bar -->
        <div class="absolute h-[480px] w-full p-[3rem] -z-[1] top-0 left-0 bg-gradient-to-r from-black to-indigo-800">
        </div>

        <!-- Main content container -->
        <div id="about"
            class="z-10 bg-white max-w-[90%] md:max-w-[1144px] mt-10 mx-auto mb-10 rounded-lg p-4 md:p-12 border-2 shadow-lg">
            <h1 class="mb-4 text-2xl font-extrabold text-center text-gray-900 dark:text-white sm:text-3xl md:text-4xl lg:text-5xl">
                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
                    Selamat Datang di Website Resmi
                </span>
                <br>
                Dinas Perpustakaan dan Arsip Kota Banjarmasin
            </h1>

            <img src="{{ asset('img/bg-login-arsip.jpg') }}" class="border rounded-xl" alt="">
            
        </div>


        <!-- card tengah -->

        <div class="flex flex-wrap justify-center gap-4 p-4 ">
            <img src="{{ asset('img/Logo-Anri.png') }}" class="w-40 h-28 md:w-72 md:h-44" alt="Logo ANRI">
            <img src="{{ asset('img/Logo-BEL.png') }}" class="w-40 h-28 md:w-72 md:h-44" alt="Logo BEL">
            <img src="{{ asset('img/Logo-Perpusnas.png') }}" class="w-40 h-28 md:w-72 md:h-44" alt="Logo Perpusnas">
            <img src="{{ asset('img/Logo-Srikandi.png') }}" class="w-40 h-28 md:w-72 md:h-44" alt="Logo Srikandi">
        </div>
    </div>

    <div class="flex flex-wrap justify-center gap-4 p-4 ">
        <img src="{{ asset('img/alurpeminjamanarsip.png') }}" class="md:size-2/4 " alt="" srcset="">
    </div>
    <!-- card -->
    <div id="article" class="max-w-[1144px] mt-8 mx-auto mb-20 rounded-lg p-5">
        <section class="flex flex-col flex-wrap">
            <h2
                class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">
                Article</h2>
            <ul class="w-full">
                <li class="flex flex-col md:flex-row w-full items-start md:items-center mb-10">
                    <a href="https://dispersip.banjarmasinkota.go.id/2021/05/peringatan-hari-kearsipan-ke-50.html" class="inline-flex w-full">
                        <div class="flex flex-col md:flex-row flex-grow gap-5 md:gap-10 items-start md:items-center">
                            <div class="p-4 overflow-hidden rounded-lg shadow-lg w-full md:w-auto md:flex-shrink-0">
                                <img src="{{ asset('img/Logo-Srikandi.png') }}" class="w-full md:max-w-xs rounded-lg"
                                    alt="">
                            </div>
                            <div class="flex-1">
                                <h4 class="mb-4 text-lg font-medium leading-snug">PERINGATAN HARI KEARSIPAN KE- 50</h4>
                                <div class="mb-2 text-sky-400/75">Mei 18, 2021</div>
                                <p class="text-gray-700 dark:text-gray-300 mb-4">Dengan tema "Satukan Langkah Menuju Arsip Digital", rangkaian peringatan Hari Kearsipan Nasional ke 50 yang bertepatan pada hari selasa tanggal 18 Mei 2021, Pemerintah Kota Banjarmasin melalui Dinas Perpustakaan dan Arsip melakukan rangkaian acara dan kegiatan antara lain sosialisasi tentang Hari kearsipan secara online baik melalui situs/web pemerin...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                <li class="flex flex-col md:flex-row w-full items-start md:items-center mb-10">
                    <a href="https://dispersip.banjarmasinkota.go.id/2024/08/standar-pelayanan-pada-dinas.html" class="inline-flex w-full">
                        <div class="flex flex-col md:flex-row flex-grow gap-5 md:gap-10 items-start md:items-center">
                            <div class="p-4 overflow-hidden rounded-lg shadow-lg w-full md:w-auto md:flex-shrink-0">
                                <img src="{{ asset('img/Logo-Srikandi.png') }}" class="w-full md:max-w-xs rounded-lg"
                                    alt="">
                            </div>
                            <div class="flex-1">
                                <h4 class="mb-4 text-lg font-medium leading-snug">Standar Pelayanan pada Dinas Perpusatakaan dan Arsip Kota Banjarmasin</h4>
                                <div class="mb-2 text-sky-400/75">Agustus 23, 2024</div>
                                <p class="text-gray-700 dark:text-gray-300 mb-4">Banjarmasin - Berikut kami sampaikan terkait standar pelayanan yang dilaksanakan di Dinas Perpustakaan dan Kearsipan Kota Banjarmasin.</p>
                            </div>
                        </div>
                    </a>
                </li>
                <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                <li class="flex flex-col md:flex-row w-full items-start md:items-center mb-10">
                    <a href="https://dispersip.banjarmasinkota.go.id/2021/05/penerimaan-para-juara-1-lomba-bercerita.html" class="inline-flex w-full">
                        <div class="flex flex-col md:flex-row flex-grow gap-5 md:gap-10 items-start md:items-center">
                            <div class="p-4 overflow-hidden rounded-lg shadow-lg w-full md:w-auto md:flex-shrink-0">
                                <img src="{{ asset('img/Logo-Srikandi.png') }}" class="w-full md:max-w-xs rounded-lg"
                                    alt="">
                            </div>
                            <div class="flex-1">
                                <h4 class="mb-4 text-lg font-medium leading-snug">Penerimaan Para Juara 1 Lomba Bercerita Tingkat Kota Banjarmasin oleh Plh. Sekda Kota Banjarmasin</h4>
                                <div class="mb-2 text-sky-400/75">Mei 06, 2021</div>
                                <p class="text-gray-700 dark:text-gray-300 mb-4">
                                    Pada hari rabu, tanggal 5 Mei 2021, Plh. Sekretaris Daerah Kota Banjarmasin Bapak H. Muhyar menerima kedatangan para juara 1lomba bercerita utk SD, SMP dan SMA sederajat Tingkat Kota Banjarmasin diruang kerja Beliau yang Didampingi oleh Kepala Dinas Perpustakaan dan Arsip kota Banjarmasin, dan Plt. Kabid Perpusta...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                <li class="flex flex-col md:flex-row w-full items-start md:items-center mb-10">
                    <a href="https://dispersip.banjarmasinkota.go.id/2021/04/kota-banjarmasin-juara-lomba-bertutur.html" class="inline-flex w-full">
                        <div class="flex flex-col md:flex-row flex-grow gap-5 md:gap-10 items-start md:items-center">
                            <div class="p-4 overflow-hidden rounded-lg shadow-lg w-full md:w-auto md:flex-shrink-0">
                                <img src="{{ asset('img/Logo-Srikandi.png') }}" class="w-full md:max-w-xs rounded-lg"
                                    alt="">
                            </div>
                            <div class="flex-1">
                                <h4 class="mb-4 text-lg font-medium leading-snug">KOTA BANJARMASIN JUARA LOMBA BERTUTUR TINGKAT PROVINSI KALIMANTAN SELATAN</h4>
                                <div class="mb-2 text-sky-400/75">April 14, 2021</div>
                                <p class="text-gray-700 dark:text-gray-300 mb-4">Wakil peserta Lomba Bertutur bagi siswa-siswi SD/MI Tingkat Provinsi Kalimantan Selatan dari Kota Banjarmasin Keyra Ameera Shafa berhasil menduduki peringkat pertama pada perlombaan tersebut. Hal ini diketahui setelah para Dewa...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            </ul>
        </section>
    </div>





    <!-- footer -->
    <footer id="contact" class="bg-gray-900 ">
        <div class="mx-auto w-full  max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class=" max-w-sm  w-full mb-6 md:mb-0 flex  flex-col">
                    <a href="" class="flex items-center">
                        <img src="{{ asset('img/dispersip_logo.png') }}" class="h-10 me-3" alt="DISPERSIP Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap text-white"></span>
                    </a>
                    <p class="text-gray-300 mt-4 break-before-right">
                    Jl. Kapten Piere Tendean No.5, Gadang, Kec. Banjarmasin Tengah, Kota Banjarmasin, Kalimantan Selatan 70123 dan Jl. K. S. Tubun, RT.05/RW.01, Pekauman, Kec. Banjarmasin Sel., Kota Banjarmasin, Kalimantan Selatan 70234
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-6 text-sm font-bold text-gray-500  dark:text-white">Layanan Kami</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Pemerintah Kota Banjarmasin</a>
                            </li>
                          
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-white">Legal</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a
                        href="https://dispersip.banjarmasinkota.go.id/" target="_blank" class="hover:underline">DISPERSIP™</a>. All
                    Rights Reserved.
                </span>
            </div>
        </div>
    </footer>




    <script>
        // Fungsi saat halaman di-scroll
        window.addEventListener('scroll', function() {
            const btn = document.getElementById('btnLogin');
            const navbar = document.getElementById('navbar');
            const btnName = document.getElementById('btnName');
            const navbarSticky = document.getElementById('navbar-sticky');


            if (navbar) {
                if (window.scrollY > 5) {
                    navbar.classList.add('bg-black', 'text-white');
                    navbar.classList.remove('md:bg-transparent');
                    if (btnName) {
                        btnName.classList.remove('md:bg-transparent')
                    }

                } else {
                    if (btnName) {
                        btnName.classList.add('md:bg-transparent')
                    }
                    navbar.classList.add('md:bg-transparent');

                }
            }


            // Cek apakah btnLogin ada
            if (btn) {
                if (window.scrollY > 5) {
                    btn.classList.add('md:bg-blue-500');
                    btn.classList.remove('md:bg-transparent');
                } else {
                    btn.classList.remove('md:bg-blue-500');
                    btn.classList.add('md:bg-transparent');
                }
            }

        });
    </script>
</body>

</html>