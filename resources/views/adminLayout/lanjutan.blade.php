@extends('adminLayout.adminLayout')

@section('peminjamLayout')

<div class=" font-bold">
    <h2 class="text-xl">
        Data Peminjam
    </h2>
    <br>
</div>
<form action="/admin/kelola/simpan-ke-history/{{ $item->id }}" method="POST">
    @csrf
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <tbody class="text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                        Nama Peminjam
                    </th>
                    <td class="px-6 py-3">{{ $item->peminjam->nama_lengkap }}</td>
                </tr>
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                        jenis
                    </th>
                    <td class="px-6 py-3">{{ $item->jenis_arsip }}</td>
                </tr>
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                        Alamat
                    </th>
                    <td class="px-6 py-3">{{ $item->peminjam->alamat}}</td>
                </tr>
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                        No Telp
                    </th>
                    <td class="px-6 py-3">{{ $item->peminjam->no_telp}}</td>
                </tr>
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                        Tujuan
                    </th>
                    <td class="px-6 py-3">{{ $item->tujuan_peminjam}}</td>
                </tr>
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                        Tanggal Peminjaman
                    </th>
                    <td class="px-6 py-3">{{ $item->tanggal_peminjaman}}</td>
                </tr>
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                        File KTP
                    </th>
                    <td class="px-6 py-3">
                        <a href="{{ asset($item->peminjam->ktp) }}" target="_blank"
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
                        <a href="{{ asset($item->dokumen_pendukung) }}" target="_blank"
                            class="text-blue-600 hover:underline">
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
                            <option value="diperiksa" {{ $item->status === 'diperiksa' ? 'selected' : '' }}>Diperiksa
                            </option>
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
                            <textarea id="alasan" rows="3" name="alasan_ditolak"
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
                                    <!-- <input type="search" id="default-search"
                                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Search Mockups, Logos..." required /> -->

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
        <a href="{{ url('admin/kelola') }}"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
            Back
        </a>

        <button type="submit"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Save</button>
    </div>

</form>
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