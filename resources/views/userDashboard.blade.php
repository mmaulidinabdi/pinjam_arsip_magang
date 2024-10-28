@extends('userLayout.userLayout')

@section('peminjamLayout')
<div class="grid md:grid-cols-4 gap-4 grid-flow-row-dense">

    <div class=" md:col-span-3  p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h2 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">Selamat Datang {{ Auth::user()->nama_lengkap }}</h2>
        </div>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Lengkapi data anda terlebih dahulu sebelum melakukan melakukan peminjaman!</p>
        <div class="">
            <a href="{{Route('user.profile')}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Lengkapi Data Diri
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>

        </div>
    </div>

    <!-- 2 -->
    <div class=" p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">*Jumlah Arsip*</h5>
        </div>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Jumlah Arsip yang sudah didata berada di Dinas Arsip dan Perpustakaan Banjarmasin</p>
        <!-- <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Lebih Lengkap
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
            </svg>
        </a> -->
    </div>

</div>

<!-- Kategori -->
<div class=" my-4 grid sm:grid-cols-3  md:grid-row-3 gap-4">

    <!-- Kategtori section -->
    <!-- 3 -->
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">*Kategori 1*</h5>
        </div>
        <span class="text-2xl font-semibold">*Total*</span>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Arsip yang tersimpan di Dinas Arsip dan Perpusatakaan Banjarmasin</p>
        <!-- <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Lebih Lengkap
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
            </svg>
        </a> -->
    </div>
    <!-- 4 -->
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">*Kategori 1*</h5>
        </div>
        <span class="text-2xl font-semibold">*Total*</span>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Arsip yang tersimpan di Dinas Arsip dan Perpusatakaan Banjarmasin</p>
        <!-- <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Lebih Lengkap
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
            </svg>
        </a> -->
    </div>

    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">*Kategori 1*</h5>
        </div>
        <span class="text-2xl font-semibold">*Total*</span>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Arsip yang tersimpan di Dinas Arsip dan Perpusatakaan Banjarmasin</p>
        <!-- <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Lebih Lengkap
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
            </svg>
        </a> -->
    </div>

</div>

<div class="dashboard">

    <!-- Ringkasan Data -->
    <div class="summary">
        <h2>Overview</h2>
        <div>Total Peminjam: 150</div>
        <div>Total Peminjaman Aktif: 30</div>
        <div>Total Arsip: 200</div>
        <div>Total Kategori: 10</div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="recent-activity">
        <h3>Aktivitas Terbaru</h3>
        <ul>
            <li>Peminjaman oleh User A pada 2024-10-25</li>
            <li>Pengembalian oleh User B pada 2024-10-24</li>
            <li>Arsip baru ditambahkan ke kategori XYZ</li>
        </ul>
    </div>

    <!-- Notifikasi -->
    <div class="notifications">
        <h3>Notifikasi Penting</h3>
        <p>Peminjaman oleh User C melebihi batas waktu.</p>
    </div>

    <!-- Grafik Statistik -->
    <div class="charts">
        <div id="chart-peminjaman">Grafik Peminjaman Bulanan</div>
        <div id="chart-pengembalian">Grafik Pengembalian Bulanan</div>
    </div>

    <!-- Daftar Peminjaman Aktif -->
    <div class="ongoing-loans">
        <h3>Peminjaman yang Sedang Berjalan</h3>
        <table>
            <tr>
                <th>Nama Peminjam</th>
                <th>Tanggal Peminjaman</th>
                <th>Jatuh Tempo</th>
                <th>Status</th>
            </tr>
            <tr>
                <td>User A</td>
                <td>2024-10-20</td>
                <td>2024-11-01</td>
                <td>Aktif</td>
            </tr>
            <!-- Tambah baris sesuai data -->
        </table>
    </div>

</div>

@endsection