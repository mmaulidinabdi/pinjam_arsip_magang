@extends('adminLayout.adminLayout')

@section('adminLayout')
<meta name="csrf-token" content="{{ csrf_token() }}">

@if (session()->has('success'))
<div id="alert" class="p-4 mb-4 text-sm text-white rounded-lg bg-green-500 dark:bg-gray-800 dark:text-green-400" role="alert">
    <span class="font-medium">{{ session('success') }}</span>
</div>
@endif

<div class=" font-bold">
    <h2 class="text-xl">
        Data Peminjam
    </h2>
    <br>
</div>
<form action="/admin/kelola/simpan-ke-history/{{ $item->id }}" method="POST">
    @csrf

    <!-- delete modal -->
    <div id="popup-modal" tabindex="-1"
        class="fixed inset-0 z-50 hidden overflow-y-auto overflow-x-hidden flex justify-center items-center bg-gray-900 bg-opacity-50">
        <div class="relative w-full max-w-md p-4">
            <!-- Modal Content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Close Button -->
                <button type="button"
                    class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>

                <!-- Modal Body -->
                <div class="p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Sudah Yakin?</h3>

                    <!-- Form Delete -->

                    <button data-modal-hide="popup-modal" type="submit"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5">
                        Yes
                    </button>

                    <!-- Cancel Button -->
                    <button data-modal-hide="popup-modal" type="button"
                        class="py-2.5 px-5 mt-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        No, cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

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
                    Nama Arsip
                </th>
                <td class="px-6 py-3">{{ $item->nama_arsip }}</td>
            </tr>
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    jenis
                </th>
                <td class="px-6 py-3">{{ $item->jenis_arsip }}</td>
                <input type="hidden" value="{{ $item->jenis_arsip }}" name="jenis_arsip" id="jenis_arsip">
            </tr>
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    Alamat
                </th>
                <td class="px-6 py-3">{{ $item->peminjam->alamat }}</td>
            </tr>
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    No Telp
                </th>
                <td class="px-6 py-3">{{ $item->peminjam->no_telp }}</td>
            </tr>
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    Tujuan
                </th>
                <td class="px-6 py-3">{{ $item->tujuan_peminjam }}</td>
            </tr>
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    Tanggal Peminjaman
                </th>
                <td class="px-6 py-3">{{ $item->tanggal_peminjaman }}</td>
            </tr>
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    File KTP
                </th>
                <td class="px-6 py-3">
                    <a href="{{ asset( 'storage/' . $item->peminjam->ktp) }}" target="_blank"
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
                    <a href="{{ asset('storage/' . $item->dokumen_pendukung) }}" target="_blank"
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
                    <select id="statusSelect" name="status"
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
                    File
                </th>
                <td class="px-6 py-3">
                    <div class="flex items-center space-x-4">
                        <!-- Search Box -->
                        <div class="w-full">
                            <form class="w-full mx-auto">
                                <label for="search"
                                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                    </div>
                                    <input type="search" id="search" name="arsip"
                                        class="block w-full px-4 py-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Search files..." autocomplete="off">
                                    <ul id="autocomplete-results"
                                        class="absolute z-50 w-full bg-white border border-gray-300 rounded-lg shadow-md dark:bg-gray-700 dark:border-gray-600 dark:text-white mt-1 hidden max-h-56 overflow-y-auto">
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </td>
                <td>

                </td>

            </tr>

        </tbody>
    </table>




    <div class="mt-4">
        <a href="{{ url('admin/kelola') }}"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
            Back
        </a>
        <button type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Save</button>
    </div>

</form>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const alert = document.getElementById('alert');

    if (alert) {
        setTimeout(() => {
            alert.style.display = 'none'
        }, 4000);
    }

    $(document).ready(function() {
        $('#search').on('input', function() {
            let query = $(this).val(); // Ambil nilai input
            let jenisArsip = $('#jenis_arsip').val(); // Jenis arsip dari dropdown (sesuaikan jika berbeda)

            if (query.length > 2) { // Minimal panjang query untuk pencarian
                $.ajax({
                    url: "{{ url('cari') }}",
                    method: 'GET',
                    data: {
                        query: query,
                        jenis_arsip: jenisArsip
                    },
                    success: function(data) {
                        let resultsDiv = $('#autocomplete-results');
                        resultsDiv.empty(); // Hapus hasil sebelumnya

                        if (data.length > 0) {
                            // Tampilkan hasil berdasarkan jenis arsip
                            data.forEach(item => {
                                if (jenisArsip === 'IMB') {
                                    resultsDiv.append(`
                                    <li class="px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer">
                                        <span class="font-bold">${item.nomor_dp}</span> - ${item.tahun} - ${item.nama_pemilik}
                                    </li>
                                `);
                                } else if (jenisArsip === 'SK') {
                                    resultsDiv.append(`
                                    <li class="px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer">
                                        <span class="font-bold">${item.nomor_sk}</span> - ${item.tahun}
                                    </li>
                                `);
                                }
                            });

                            resultsDiv.removeClass('hidden'); // Tampilkan hasil
                        } else {
                            resultsDiv.html(
                                `<li class="px-4 py-2 text-gray-500">No results found</li>`
                            );
                            resultsDiv.removeClass('hidden'); // Tampilkan "No results found"
                        }
                    },
                    error: function() {
                        console.error('Error fetching data.');
                    }
                });
            } else {
                $('#autocomplete-results').addClass('hidden'); // Sembunyikan jika input pendek
            }
        });

        // Klik pada item hasil pencarian
        $('#autocomplete-results').on('click', 'li', function() {
            $('#search').val($(this).text()); // Masukkan teks hasil ke input
            $('#autocomplete-results').addClass('hidden'); // Sembunyikan autocomplete
        });

        // Klik di luar untuk menyembunyikan autocomplete
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#search').length && !$(e.target).closest('#autocomplete-results').length) {
                $('#autocomplete-results').addClass('hidden');
            }
        });
    });


    document.getElementById('statusSelect').addEventListener('change', function() {
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


    document.getElementById('confirmButton').addEventListener('click', function() {
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