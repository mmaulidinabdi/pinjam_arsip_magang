@extends('userLayout.userLayout')

@section('peminjamLayout')
    <table id="search-table">
        <thead>
            <tr>
                <th>
                    <span class="flex items-center">
                        Nama Arsip saat pengajuan
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Jenis Arsip
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Tanggal Peminjaman
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Status
                    </span>
                </th>
                <th>
                    <span class="flex items-center">

                    </span>
                </th>

            </tr>
        </thead>
        <tbody>
            @foreach ($histories as $history)
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        
                    {{ $history->nama_arsip }}
                    </td>
                    <td>{{ $history->jenis_arsip }}</td>
                    <td>{{ $history->tanggal_peminjaman }}</td>
                    <td>{{ $history->status }}</td>
                    <td>
                    <a href="{{ url('user/detail', $history->id) }}"
                        class="whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                        details
                    </a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
