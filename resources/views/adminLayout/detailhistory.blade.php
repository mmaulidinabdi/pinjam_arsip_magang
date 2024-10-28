@extends('adminLayout.adminLayout')

@section('peminjamLayout')

<div class=" font-bold">
    <h2 class="text-xl">
        Data Peminjam
    </h2>
    <br>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <tbody class="text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    Nama Peminjam
                </th>
                <td class="px-6 py-3">Muhammad Azhar Sadikin</td>
            </tr>
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    Arsip
                </th>
                <td class="px-6 py-3">IMB-124 1999</td>
            </tr>
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    Alamat
                </th>
                <td class="px-6 py-3">Jl trans kalimantan komplek kebun jeruk 3 rt 9 rw 2 no 31</td>
            </tr>
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    No Telp
                </th>
                <td class="px-6 py-3">083141560647</td>
            </tr>
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    Tujuan
                </th>
                <td class="px-6 py-3">Menjual rumah</td>
            </tr>
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    Tanggal Peminjaman
                </th>
                <td class="px-6 py-3">25 September 2024</td>
            </tr>
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    File KTP
                </th>
                <td class="px-6 py-3">
                    <a href="{{ asset('storage/ktp/imb_1_1999.pdf') }}" target="_blank"
                        class="text-blue-600 hover:underline">
                        Lihat File PDF
                    </a>
                </td>
            </tr>
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    File Pendukung
                </th>
                <td class="px-6 py-3">
                    <a href="{{ asset('storage/ktp/imb_1_1999.pdf') }}" target="_blank"
                        class="text-blue-600 hover:underline">
                        Lihat File PDF
                    </a>
                    <a href="{{ asset('storage/ktp/imb_1_1999.pdf') }}" target="_blank"
                        class="text-blue-600 hover:underline mt-2 block">
                        Lihat File PDF
                    </a>
                </td>
            </tr>
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    Status
                </th>
                <td class="px-6 py-3">
                    diacc
                </td>
                
            </tr>
        </tbody>
    </table>
</div>

<div id="alasanContainer" class="hidden mt-2">
            <label for="alasan" class="block text-sm font-medium text-gray-700">Alasan Penolakan</label>
            <textarea id="alasan" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"></textarea>

        </div>


<div class="mt-4">
<button  onclick="location.href='adminhistory'"  type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Back</button>
</div>

@endsection