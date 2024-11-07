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
                    <select id="statusSelect"
                        class="border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        <option value="">Pilih Status</option>
                        <option value="diperiksa">Diperiksa</option>
                        <option value="acc">Acc</option>
                        <option value="tolak">Tolak</option>
                    </select>

                </td>
            <tr id="alasanContainer" class="hidden mt-2">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    Alasan penolakan
                </th>
                <td class="px-6 py-3">
                    <div>
                        <textarea id="alasan" rows="3"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"></textarea>
                    </div>
                </td>
            </tr>
            <tr id="accContainer" class="hidden mt-2">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    file
                </th>
                <td class="px-6 py-3">
                    <div>
                        <form class="w-full mx-auto">
                            <label for="default-search"
                                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="search" id="default-search"
                                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search Mockups, Logos..." required />
                                
                            </div>
                        </form>

                    </div>
                </td>
            </tr>

            </tr>
        </tbody>
    </table>
</div>




<div class="mt-4">
    <button onclick="location.href='kelolapeminjaman'" type="button"
        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Back</button>
    <button type="button"
        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Save</button>
</div>

<script>
    document.getElementById('statusSelect').addEventListener('change', function () {
        const alasanContainer = document.getElementById('alasanContainer');
        const accContainer = document.getElementById('accContainer'); // Tambahkan ini

        if (this.value === 'tolak') {
            alasanContainer.classList.remove('hidden');
            accContainer.classList.add('hidden'); // Sembunyikan accContainer jika pilih "tolak"
        } else if (this.value === 'acc') {
            accContainer.classList.remove('hidden');
            alasanContainer.classList.add('hidden'); // Sembunyikan alasanContainer jika pilih "acc"
        } else {
            alasanContainer.classList.add('hidden');
            accContainer.classList.add('hidden');
        }
    });


    document.getElementById('confirmButton').addEventListener('click', function () {
        const alasan = document.getElementById('alasan').value;
        if (alasan) {
            console.log('Alasan Penolakan:', alasan);
            alert('Alasan Penolakan berhasil disimpan!');
            document.getElementById('alasan').value = '';
            document.getElementById('alasanContainer').classList.add('hidden');
            document.getElementById('statusSelect').value = '';
        } else {
            alert('Silakan isi alasan penolakan.');
        }
    });
</script>
@endsection