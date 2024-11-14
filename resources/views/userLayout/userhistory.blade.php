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
            <tr>
                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Apple Inc.</td>
                <td>AAPL</td>
                <td>$192.58</td>
                <td>$3.04T</td>
            </tr>
            @foreach ($histories as $history)
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $history->nama }}</td>
                    <td>AAPL</td>
                    <td>$192.58</td>
                    <td>$3.04T</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
