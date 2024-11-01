@extends('adminLayout.adminLayout')

@section('peminjamLayout')
<div class="grid md:grid-cols-4 gap-4 grid-flow-row-dense">

    <div class=" md:col-span-3  p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h2 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">Selamat Datang Atmin</h2>
        </div>
        <!-- <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Lengkapi data anda terlebih dahulu sebelum melakukan melakukan peminjaman!</p> -->
        <!-- <div class="">
            <a href="{{Route('user.profile')}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Lengkapi Data Diri
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>

        </div> -->
    </div>

    <!-- 2 -->
    <div class=" p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">*Jumlah Arsip*</h5>
        </div>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Jumlah Arsip yang sudah didata berada di Dinas Arsip dan Perpustakaan Banjarmasin</p>

    </div>

</div>

<!-- Kategori -->

<div class=" my-4 grid sm:grid-cols-3  md:grid-row-3 gap-4">
    <!-- Kategtori section -->
    <!-- 3 -->
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">*Jenis 1*</h5>
        </div>
        <span class="text-2xl font-semibold">*Total*</span>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Arsip yang tersimpan di Dinas Arsip dan Perpusatakaan Banjarmasin</p>

    </div>
    <!-- 4 -->
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">*Jenis 1*</h5>
        </div>
        <span class="text-2xl font-semibold">*Total*</span>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Arsip yang tersimpan di Dinas Arsip dan Perpusatakaan Banjarmasin</p>

    </div>


    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">*Jenis 1*</h5>
        </div>
        <span class="text-2xl font-semibold">*Total*</span>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Arsip yang tersimpan di Dinas Arsip dan Perpusatakaan Banjarmasin</p>

    </div>
</div>


<!-- chart -->
<!-- Chart Container -->
<div class="my-4 grid md:grid-cols-3 gap-4 grid-flow-row-dense">

    <!-- Bar Chart -->
    <div class="md:col-span-2">
        <canvas class="h-48 sm:h-64 md:h-80 lg:h-96 w-full" id="myChart"></canvas>
    </div>

    <!-- Donut Chart -->
    <div>
        <canvas class="h-48 sm:h-64 md:h-80 lg:h-96 w-full" id="donutChart"></canvas>
    </div>
</div>
@endsection