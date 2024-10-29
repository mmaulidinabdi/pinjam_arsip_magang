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
        <tr>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Microsoft Corporation</td>
            <td>MSFT</td>
            <td>$340.54</td>
            <td>$2.56T</td>
        </tr>
        <tr>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Alphabet Inc.</td>
            <td>GOOGL</td>
            <td>$134.12</td>
            <td>$1.72T</td>
        </tr>
        <tr>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Amazon.com Inc.</td>
            <td>AMZN</td>
            <td>$138.01</td>
            <td>$1.42T</td>
        </tr>
        <tr>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">NVIDIA Corporation</td>
            <td>NVDA</td>
            <td>$466.19</td>
            <td>$1.16T</td>
        </tr>
        <tr>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Tesla Inc.</td>
            <td>TSLA</td>
            <td>$255.98</td>
            <td>$811.00B</td>
        </tr>
        <tr>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Meta Platforms Inc.</td>
            <td>META</td>
            <td>$311.71</td>
            <td>$816.00B</td>
        </tr>
        <tr>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Berkshire Hathaway Inc.</td>
            <td>BRK.B</td>
            <td>$354.08</td>
            <td>$783.00B</td>
        </tr>
        <tr>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">TSMC</td>
            <td>TSM</td>
            <td>$103.51</td>
            <td>$538.00B</td>
        </tr>
        
    </tbody>
</table>





@endsection