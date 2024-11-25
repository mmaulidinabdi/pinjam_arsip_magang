@extends('userLayout.userLayout')

@section('peminjamLayout')
<div class="grid md:grid-cols-4 gap-4 grid-flow-row-dense">

        <div
            class=" md:col-span-3  p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div>
                <h2 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">Selamat Datang
                    {{ Auth::user()->nama_lengkap }}</h2>
            </div>
            @if (Auth::user()->isVerificate == 'diperiksa')
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Lengkapi data anda terlebih dahulu sebelum
                    melakukan
                    melakukan peminjaman!</p>
                <div class="">
                    <a href="{{ Route('user.profile') }}"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Lengkapi Data Diri
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            @elseif (Auth::user()->isVerificate == 'diterima')
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Data Diri Anda Telah Diverifikasi Silahkan
                    Melakukan Peminjaman</p>
                <div class="">
                    <a href="{{ Route('user.peminjaman') }}"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Mulai Meminjam
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            @elseif (Auth::user()->isVerificate == 'ditolak')
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Data Diri Anda Sebelumnya Ditolak !! Mohon Isi
                    Kembali</p>
                <div class="">
                    <a href="{{ Route('user.profile') }}"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Lengkapi Data Diri Kembali
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            @endif
        </div>

    <!-- 2 -->
    <div class=" p-6 bg-blue-400 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $jumlahArsip }}</h5>
        </div>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Jumlah Arsip yang sudah didata berada di Dinas
            Arsip dan Perpustakaan Banjarmasin</p>

    </div>

</div>

<!-- Kategori -->

<div class=" my-4 grid sm:grid-cols-3  md:grid-row-3 gap-4">
    <!-- Kategtori section -->
    <!-- 3 -->
    <div class="p-6 bg-yellow-400 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $imb }}</h5>
        </div>
        <span class="text-2xl font-semibold">{{ $jumlahImb }}</span>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Arsip yang tersimpan di Dinas Arsip dan
            Perpusatakaan Banjarmasin</p>

    </div>
    <!-- 4 -->
    <div class="p-6 bg-green-400 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $sk }}</h5>
        </div>
        <span class="text-2xl font-semibold">{{ $jumlahSK }}</span>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Arsip yang tersimpan di Dinas Arsip dan
            Perpusatakaan Banjarmasin</p>

    </div>


    <div class="p-6 bg-purple-400 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $arsip2 }}</h5>
        </div>
        <span class="text-2xl font-semibold">{{$jumlahArsip2}}</span>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Arsip yang tersimpan di Dinas Arsip dan
            Perpusatakaan Banjarmasin</p>

    </div>
</div>



<!-- Table -->
<div class="flex flex-col sm:flex-row mt-4">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <caption
                class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                Proses peminjaman yang sedang berlangsung
            </caption>
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama Arsip
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jenis Arsip
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
                @foreach ($transaksis as $transaksi)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $transaksi->nama_arsip }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $transaksi->jenis_arsip }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $transaksi->tanggal_peminjaman }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $transaksi->status }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection