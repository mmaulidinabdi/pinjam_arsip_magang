<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Landing Page</title>
</head>

<body>
    <nav id="navbar" class="p-5 transition-all duration-300 ease-in-out bg-transparent fixed w-full z-20 top-0 start-0 ">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{asset('img/dispersip_logo.png')}}" class="h-8" alt="Flowbite Logo">
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <button type="button" id="btnLogin" class="text-white hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center">Login</button>
                <button id="hamburgerBtn" data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>

            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium sm:bg-red-700 md:bg-transparent md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 ">
                    <li>
                        <a href="#" class="block py-2 px-3 text-white hover:text-black hover:bg-gray-100 rounded md:hover:bg-transparent md:p-0 md:hover:text-blue-700" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-white rounded hover:text-black hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-white rounded hover:text-black hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Services</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-white rounded hover:text-black hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <div class="relative pt-[8rem] ">

        <!-- Background gradient bar -->
        <div class="absolute h-[480px] w-full p-[3rem] -z-[1] top-0 left-0 bg-gradient-to-r from-black to-indigo-800"></div>

        <!-- Main content container -->
        <div class="z-10 bg-white max-w-[90%] md:max-w-[1144px] mt-10 mx-auto mb-10 rounded-lg p-4 md:p-12 border-2 shadow-lg">
            <h1 class="mb-4 text-2xl font-extrabold text-gray-900 dark:text-white sm:text-3xl md:text-4xl lg:text-5xl">
                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
                    Selamat Datang di Website Resmi
                </span>
                Dinas Perpustakaan dan Arsip Kota Banjarmasin
            </h1>

            <!-- Text paragraph -->
            <p class="mb-3 text-gray-500 dark:text-gray-400 text-base sm:text-lg">
                Sumber informasi terkini dan terpercaya mengenai pengelolaan arsip serta pelayanan perpustakaan di kota kita. Kami hadir untuk membantu masyarakat Banjarmasin dalam mengakses berbagai sumber literasi dan dokumentasi, yang tidak hanya mendukung kebutuhan edukasi, namun juga menjaga jejak sejarah serta warisan budaya lokal. Melalui kolaborasi dengan berbagai instansi, kami memastikan pengelolaan arsip berjalan dengan baik dan dapat diakses secara luas. Selain itu, perpustakaan kami menawarkan koleksi buku yang terus diperbarui untuk meningkatkan minat baca dan mendukung literasi masyarakat di semua kalangan.
            </p>

            <!-- Second text paragraph -->
            <p class="text-gray-500 dark:text-gray-400 text-base sm:text-lg">
                Dengan inovasi dalam sistem manajemen informasi, kami menggunakan platform terbuka dan kolaboratif untuk melacak dan mengelola data, sehingga setiap perubahan dan pengelolaan arsip tercatat secara rapi. Pendekatan ini memungkinkan kami untuk merespon permintaan dan kebutuhan masyarakat dengan lebih cepat, serta memberikan pengalaman layanan yang efisien tanpa kerumitan. Kami berkomitmen untuk mempercepat alur kerja penting, mengurangi beban administratif, dan menyediakan jejak audit yang lengkap pada setiap perubahan. Hal ini tidak hanya meningkatkan keandalan pelayanan, tetapi juga memberikan jaminan akuntabilitas pada setiap proses yang dilakukan. Terima kasih atas kepercayaan Anda, dan kami siap mendukung perjalanan literasi dan informasi Anda di Kota Banjarmasin.
            </p>
        </div>


        <!-- card tengah -->

        <div class="flex flex-wrap justify-center gap-4 p-4 ">
            <img src="{{asset('img/Logo-Anri.png')}}" class="w-40 h-28 md:w-72 md:h-44" alt="Logo ANRI">
            <img src="{{asset('img/Logo-BEL.png')}}" class="w-40 h-28 md:w-72 md:h-44" alt="Logo BEL">
            <img src="{{asset('img/Logo-Perpusnas.png')}}" class="w-40 h-28 md:w-72 md:h-44" alt="Logo Perpusnas">
            <img src="{{asset('img/Logo-Srikandi.png')}}" class="w-40 h-28 md:w-72 md:h-44" alt="Logo Srikandi">
        </div>

    </div>

    <!-- card -->
    <div class="max-w-[1144px] mt-8 mx-auto mb-20 rounded-lg p-5">
        <section class="flex flex-col flex-wrap">
            <h2 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">Article</h2>
            <ul class="w-full">
                <li class="flex flex-col md:flex-row w-full items-start md:items-center mb-10">
                    <a href="#" class="inline-flex w-full">
                        <div class="flex flex-col md:flex-row flex-grow gap-5 md:gap-10 items-start md:items-center">
                            <div class="p-4 overflow-hidden rounded-lg shadow-lg w-full md:w-auto md:flex-shrink-0">
                                <img src="{{ asset('img/Logo-Srikandi.png') }}" class="w-full md:max-w-xs rounded-lg" alt="">
                            </div>
                            <div class="flex-1">
                                <h4 class="mb-4 text-lg font-medium leading-snug">Judul Article Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aut, mollitia unde natus quae, recusandae ad maiores vero similique excepturi necessitatibus fugiat sunt ipsum tenetur! Iure, possimus. Perferendis labore quasi optio eius veniam odio, neque eligendi, recusandae autem eos cumque dolore nemo dolores culpa...</h4>
                                <div class="mb-2 text-sky-400/75">Jumat Agustus 2024</div>
                                <p class="text-gray-700 dark:text-gray-300 mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi veritatis reiciendis maxime esse repudiandae? Odit, est dolorum! Nobis a provident veritatis exercitationem porro, similique ducimus repellat, aliquid temporibus accusamus omnis necessitatibus neque deleniti totam eum soluta aliquam culpa minus perspiciatis...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                <li class="flex flex-col md:flex-row w-full items-start md:items-center mb-10">
                    <a href="#" class="inline-flex w-full">
                        <div class="flex flex-col md:flex-row flex-grow gap-5 md:gap-10 items-start md:items-center">
                            <div class="p-4 overflow-hidden rounded-lg shadow-lg w-full md:w-auto md:flex-shrink-0">
                                <img src="{{ asset('img/Logo-Srikandi.png') }}" class="w-full md:max-w-xs rounded-lg" alt="">
                            </div>
                            <div class="flex-1">
                                <h4 class="mb-4 text-lg font-medium leading-snug">Judul Article Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aut, mollitia unde natus quae, recusandae ad maiores vero similique excepturi necessitatibus fugiat sunt ipsum tenetur! Iure, possimus. Perferendis labore quasi optio eius veniam odio, neque eligendi, recusandae autem eos cumque dolore nemo dolores culpa...</h4>
                                <div class="mb-2 text-sky-400/75">Jumat Agustus 2024</div>
                                <p class="text-gray-700 dark:text-gray-300 mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi veritatis reiciendis maxime esse repudiandae? Odit, est dolorum! Nobis a provident veritatis exercitationem porro, similique ducimus repellat, aliquid temporibus accusamus omnis necessitatibus neque deleniti totam eum soluta aliquam culpa minus perspiciatis...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                <li class="flex flex-col md:flex-row w-full items-start md:items-center mb-10">
                    <a href="#" class="inline-flex w-full">
                        <div class="flex flex-col md:flex-row flex-grow gap-5 md:gap-10 items-start md:items-center">
                            <div class="p-4 overflow-hidden rounded-lg shadow-lg w-full md:w-auto md:flex-shrink-0">
                                <img src="{{ asset('img/Logo-Srikandi.png') }}" class="w-full md:max-w-xs rounded-lg" alt="">
                            </div>
                            <div class="flex-1">
                                <h4 class="mb-4 text-lg font-medium leading-snug">Judul Article Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aut, mollitia unde natus quae, recusandae ad maiores vero similique excepturi necessitatibus fugiat sunt ipsum tenetur! Iure, possimus. Perferendis labore quasi optio eius veniam odio, neque eligendi, recusandae autem eos cumque dolore nemo dolores culpa...</h4>
                                <div class="mb-2 text-sky-400/75">Jumat Agustus 2024</div>
                                <p class="text-gray-700 dark:text-gray-300 mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi veritatis reiciendis maxime esse repudiandae? Odit, est dolorum! Nobis a provident veritatis exercitationem porro, similique ducimus repellat, aliquid temporibus accusamus omnis necessitatibus neque deleniti totam eum soluta aliquam culpa minus perspiciatis...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                <li class="flex flex-col md:flex-row w-full items-start md:items-center mb-10">
                    <a href="#" class="inline-flex w-full">
                        <div class="flex flex-col md:flex-row flex-grow gap-5 md:gap-10 items-start md:items-center">
                            <div class="p-4 overflow-hidden rounded-lg shadow-lg w-full md:w-auto md:flex-shrink-0">
                                <img src="{{ asset('img/Logo-Srikandi.png') }}" class="w-full md:max-w-xs rounded-lg" alt="">
                            </div>
                            <div class="flex-1">
                                <h4 class="mb-4 text-lg font-medium leading-snug">Judul Article Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aut, mollitia unde natus quae, recusandae ad maiores vero similique excepturi necessitatibus fugiat sunt ipsum tenetur! Iure, possimus. Perferendis labore quasi optio eius veniam odio, neque eligendi, recusandae autem eos cumque dolore nemo dolores culpa...</h4>
                                <div class="mb-2 text-sky-400/75">Jumat Agustus 2024</div>
                                <p class="text-gray-700 dark:text-gray-300 mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi veritatis reiciendis maxime esse repudiandae? Odit, est dolorum! Nobis a provident veritatis exercitationem porro, similique ducimus repellat, aliquid temporibus accusamus omnis necessitatibus neque deleniti totam eum soluta aliquam culpa minus perspiciatis...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            </ul>
        </section>
    </div>





    <!-- footer -->
    <footer class="bg-gray-900 ">
        <div class="mx-auto w-full  max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0 flex items-center">
                    <a href="" class="flex items-center">
                        <img src="{{ asset('img/dispersip_logo.png') }}" class="h-10 me-3" alt="DISPERSIP Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap text-white"></span>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-white">Resources</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="https://flowbite.com/" class="hover:underline">Flowbite</a>
                            </li>
                            <li>
                                <a href="https://tailwindcss.com/" class="hover:underline">Tailwind CSS</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-white">Follow us</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="https://github.com/themesberg/flowbite" class="hover:underline ">Github</a>
                            </li>
                            <li>
                                <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Discord</a>
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
                <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a href="https://dispersip.banjarmasinkota.go.id/" class="hover:underline">DISPERSIP™</a>. All Rights Reserved.
                </span>
            </div>
        </div>
    </footer>




    <script>
       // Fungsi saat halaman di-scroll
window.addEventListener('scroll', function() {
    const btn = document.getElementById('btnLogin');
    const navbar = document.getElementById('navbar');
    const navbarSticky = document.getElementById('navbar-sticky');

    if (window.scrollY > 5) {
        navbar.classList.add('bg-black', 'text-white');
        btn.classList.add('bg-blue-500');
        navbar.classList.remove('bg-transparent');
    } else {
        navbar.classList.add('bg-transparent');
        btn.classList.remove('bg-blue-500');
    }
});

// Fungsi saat tombol hamburger diklik
document.getElementById('hamburgerBtn').addEventListener('click', function() {
    const navbar = document.getElementById('navbar');
    const navbarSticky = document.getElementById('navbar-sticky');

    // Toggle navbar sticky visibility
    navbarSticky.classList.toggle('hidden');

    // Atur background navbar hanya jika navbar sticky terlihat
    if (!navbarSticky.classList.contains('hidden')) {
        navbar.classList.add('bg-black');
    } else {
        navbar.classList.remove('bg-black');
    }
});

    </script>
</body>

</html>