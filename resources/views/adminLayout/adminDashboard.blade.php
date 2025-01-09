@extends('adminLayout.adminLayout')

@section('adminLayout')
<div class="grid md:grid-cols-4 gap-4 grid-flow-row-dense">

    <div class=" p-6 bg-blue-300 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h2 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">Selamat Datang Admin</h2>
        </div>
    </div>

    <!-- 2 -->
    <div
        class="md:col-span-2  p-6 bg-blue-400 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-5xl font-bold tracking-tight text-gray-900 dark:text-white">{{$jumlahPeminjam}}</h5>
        </div>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Jumlah Pengguna yang terdaftar di website
            peminjaman arsip Dinas Perpusatakaan dan Arsip Kota Banjarmasin</p>

    </div>
    <!-- 3 -->
    <div class=" p-6 bg-blue-500 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-5xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $jumlahArsip }}</h5>
        </div>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Jumlah Arsip yang sudah didata berada di Dinas
            Arsip dan Perpustakaan Banjarmasin</p>

    </div>

</div>

<!-- Kategori -->

<div class=" my-4 grid sm:grid-cols-2  md:grid-row-3 gap-4">
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
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$sk}}</h5>
        </div>
        <span class="text-2xl font-semibold">{{$jumlahSK}}</span>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Arsip yang tersimpan di Dinas Arsip dan
            Perpusatakaan Banjarmasin</p>

    </div>


    
</div>


<!-- chart -->
<!-- Chart Container -->


<!-- Table peminjaman yg baru diajukan hnaya 5 saja -->
<div class="flex flex-col sm:flex-row mt-4">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <caption
                class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
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
                    <th scope="col" class="px-6 py-3">
                        
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksiPending as $transaksi)

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
            <caption
                class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
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
                        Tanggal peminjaman
                    </th>
                    <th scope="col" class="px-6 py-3">
                        lama peminjaman
                    </th>
                    <th scope="col" class="px-6 py-3">
                        
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($histori as $historis)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $historis->peminjam->nama_lengkap }}
                        </th>
                        <td class="px-6 py-4">


                            @if($historis->status === 'diacc')
                                @if ($historis->jenis_arsip === 'IMB')
                                    {{ $historis->jenis_arsip }}
                                    {{ optional($historis->imb)->nomor_dp }}
                                    {{ optional($historis->imb)->tahun }}
                                @elseif ($historis->jenis_arsip === 'SK')
                                    {{ $historis->jenis_arsip }}
                                    {{ optional($historis->sk)->nomor_sk }}
                                    {{ optional($historis->sk)->tahun }}
                                @elseif ($historis->jenis_arsip === 'arsip2')
                                    {{ $historis->jenis_arsip }}
                                    {{ optional($historis->arsip2)->nomor_dp }}
                                    {{ optional($historis->arsip2)->tahun }}
                                @endif
                            @else
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($historis->tanggal_peminjaman)->translatedFormat('d F Y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ number_format(\Carbon\Carbon::parse($historis->tanggal_divalidasi)->diffInDays(\Carbon\Carbon::now()), 0, '.', ',') }}
                            hari
                        </td>
                        <td>
                            <form action="{{ route('pengembalian.konfirmasi', $historis->id) }}" method="POST"
                                class="inline">
                                @csrf
                                <button type="submit"
                                    class="min-w-[60px] whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                    Konfirmasi pengembalian
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection