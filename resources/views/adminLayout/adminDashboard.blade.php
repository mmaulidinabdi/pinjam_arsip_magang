@extends('adminLayout.adminLayout')

@section('adminLayout')
<div class="grid md:grid-cols-4 gap-4 grid-flow-row-dense">

    <div class=" p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h2 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">Selamat Datang Atmin</h2>
        </div>
    </div>

    <!-- 2 -->
    <div class="md:col-span-2  p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-5xl font-bold tracking-tight text-gray-900 dark:text-white">{{$jumlahPeminjam}}</h5>
        </div>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Jumlah Pengguna yang terdaftar di website peminjaman arsip Dinas Perpusatakaan dan Arsip Kota Banjarmasin</p>

    </div>
    <!-- 3 -->
    <div class=" p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-5xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $jumlahArsip }}</h5>
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
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $imb }}</h5>
        </div>
        <span class="text-2xl font-semibold">{{ $jumlahImb }}</span>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Arsip yang tersimpan di Dinas Arsip dan Perpusatakaan Banjarmasin</p>

    </div>
    <!-- 4 -->
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$arsip1}}</h5>
        </div>
        <span class="text-2xl font-semibold">{{$jumlahArsip1}}</span>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Arsip yang tersimpan di Dinas Arsip dan Perpusatakaan Banjarmasin</p>

    </div>


    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $arsip2 }}</h5>
        </div>
        <span class="text-2xl font-semibold">{{$jumlahArsip2}}</span>
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

<!-- Table peminjaman yg baru diajukan hnaya 5 saja -->
<div class="flex flex-col sm:flex-row mt-4">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                Proses peminjaman yang belum ditindak lanjuti
            </caption>
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama Peminjamn
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Arsip
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksiPending as $transaksi )

                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $transaksi->peminjam->nama_lengkap }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $transaksi->nama_arsip }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $transaksi->tanggal_peminjaman }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $transaksi->status }}
                    </td>
                    <td>
                        <a href="{{Route('admin.kelola')}}"
                            class="whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                            Tindak Lanjut
                        </a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

<!-- Table peminjaman yg tenggat nya 10 hari -->
<div class="flex flex-col sm:flex-row mt-4">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                Proses peminjaman yang belum dikembalikan (-10 hari)
            </caption>
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama Peminjamn
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Arsip
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody>

                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        p </th>
                    <td class="px-6 py-4">
                        o
                    </td>
                    <td class="px-6 py-4">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere, adipisci.
                    </td>
                    <td class="px-6 py-4">
                        fiohsd
                    </td>
                    <td>
                        <a href="{{Route('admin.kelola')}}"
                            class="whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                            Tindak Lanjut
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>


@endsection