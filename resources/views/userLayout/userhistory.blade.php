@extends('userLayout.userLayout')

@section('peminjamLayout')
    <table id="search-table">
        <thead>
            <tr>
                <th>
                    <span class="flex items-center">
                        Nama Peminjaman
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Arsip
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Tanggal
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Status
                    </span>
                </th>

            </tr>
        </thead>
        <tbody>
            @foreach ($histories as $history)
            
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $history->nama_arsip }}</td>
                    <td>{{ $history->jenis_arsip }}</td>
                    <td>{{ $history->tanggal_peminjaman }}</td>
                    <td>{{ $history->status }}</td>
                    <td>husein</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
