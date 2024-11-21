@extends('adminLayout.adminLayout')

@section('adminLayout')

<div class="font-bold">
    <h2 class="text-xl">Manajemen SK</h2>
    <br>
</div>

@if (session()->has('success'))
<div id="alertSuccess" class="p-4 mb-4 text-sm text-white rounded-lg bg-green-500 dark:bg-gray-800 dark:text-green-400" role="alert">
    <span class="font-medium">{{ session('success') }}</span>
</div>
@endif

<form action="/admin/imb/search" method="GET" class="max-w-lg mx-auto my-3">
    <div class="flex">
        <button id="dropdown-button" data-dropdown-toggle="dropdown"
            class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"
            type="button">Filter <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg></button>

        <div id="dropdown"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 max-h-60 overflow-auto"
                aria-labelledby="dropdown-button">
                <li>
                    <button type="button"
                        class="filter-item inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        data-filter="nomor_dp">No SK</button>
                </li>
                <li>
                    <button type="button"
                        class="filter-item inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        data-filter="nama_pemilik">Tahun</button>
                </li>
                <li>
                    <button type="button"
                        class="filter-item inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        data-filter="alamat">Tanggal Penetapan</button>
                </li>
                <li>
                    <button type="button"
                        class="filter-item inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        data-filter="lokasi">Tentang</button>
                </li>

            </ul>
        </div>

        <div class="relative w-full">
            <input type="search" id="search-dropdown"
                class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                placeholder="Search..... " name="query" />
            <input type="hidden" name="field" id="field" value="">
            <button type="submit"
                class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </div>

        <!-- tombol print -->
        <a href="{{ route('imb.printAll', ['query' => request()->input('query'), 'field' => request()->input('field')]) }}" onclick="printTable()"
            class="flex items-center text-white bg-gray-800 border border-gray-300 focus:outline-none hover:bg-gray-600 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
            <svg class="w-6 h-6 text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                    d="M16.444 18H19a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h2.556M17 11V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v6h10ZM7 15h10v4a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-4Z" />
            </svg>
            PRINT ALL
        </a>
    </div>
</form>


<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table id="dataTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">NO SK</th>
                <th scope="col" class="px-6 py-3">Tahun</th>
                <th scope="col" class="px-6 py-3">Tanggal Penetapan</th>
                <th scope="col" class="px-6 py-3">Tentang</th>
                <th scope="col" class="px-6 py-3 hidden-print">Lihat</th>
                <th scope="col" class="px-6 py-3 hidden-print">Edit</th>
                <th scope="col" class="px-6 py-3 hidden-print">Hapus</th>
                <th scope="col" class="px-6 py-3 hidden-print">Print</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($dataSK as $item)
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $item->nomor_sk }}
                </th>
                <td class="px-6 py-4">{{ $item->tahun }}</td>
                <td class="px-6 py-4">{{ $item->tanggal_penetapan }}</td>
                <td class="px-6 py-4">{{ $item->tentang }}</td>

                <td class="px-6 py-4 hidden-print">
                    <a href="/admin/lihat/sk/{{ $item->sk }}" target="_blank">
                        <svg id="eye-open" class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
                            style="cursor: pointer;">
                            <path stroke="currentColor" stroke-width="2"
                                d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </a>
                </td>
                <td class="px-6 py-4 hidden-print">
                    <a href="#" onclick="openEditModal({{ json_encode($item) }})"
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                        </svg>
                    </a>

                </td>
                <td class="px-6 py-4">
                    <a href="/admin/delete/imb/{{$item->id}}?page={{ $dataSK->currentPage() }}" onclick=" return confirmDelete({{$item->id}})">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </td>
                <td class="px-6 py-4 hidden-print">
                    <a href="#" class="print-pdf font-medium text-blue-600 dark:text-blue-500 hover:underline"
                        data-file="{{ asset('storage/sk/' . $item->sk) }}">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                d="M16.444 18H19a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h2.556M17 11V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v6h10ZM7 15h10v4a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-4Z" />
                        </svg>
                    </a>
                </td>

            </tr>
            @endforeach

            <!-- Edit Form  -->
            <div id="editModal"
                class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-800 bg-opacity-50">
                <div class="bg-gray-100 p-6 rounded-lg shadow-lg border">
                    <h2 class="text-lg font-bold mb-4">Edit Data</h2>

                    <form id="form_id" action="" method="POST">
                        @method('put')
                        @csrf
                        <input type="hidden" id="edit_id" name="id">

                        <!-- Menggunakan grid layout -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="nomor_sk" id="edit_nomor_sk"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " value="" required />
                                <label for="floating_nomor_sk"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600">Nomor
                                    SK</label>
                            </div>

                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="tahun" id="edit_tahun"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " value="" required />
                                <label for="floating_tahun"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600">Tahun</label>
                            </div>

                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="tanggal_penetapan" id="edit_tanggal_penetapan"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " value="" required />
                                <label for="floating_tanggal_penetapan"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600">Tanggal Penetapan</label>
                            </div>

                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="tentang" id="edit_tentang"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " value="" required />
                                <label for="floating_tentang"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600">Tentang</label>
                            </div>
                        </div>
                        <div class="mb-14">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="multiple_files">Upload
                                File
                                SK</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="multiple_files" name="sk[]" type="file" value="" multiple
                                accept=".pdf">
                            <input type="hidden" id="merge_sk" name="sk">
                        </div>

                        <div class="mb-14"></div>

                        <div class="flex justify-evenly">
                            <button type="button" onclick="closeModal()"
                                class="text-white bg-red-500 hover:bg-red-700 font-bold py-2 px-4 rounded">Cancel</button>
                            <button type="button" id="mergeButton"
                                class="text-white bg-green-500 hover:bg-green-700 font-bold py-2 px-4 rounded">
                                Gabungkan PDF
                            </button>
                            <button type="submit"
                                class="ml-2 text-white bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </tbody>
    </table>
    <div>

    </div>
</div>



<div class="mt-10">
    {{ $dataSK->links() }}
</div>

<script>
    function openEditModal(item) {
        // Simpan posisi scroll saat ini ke localStorage
        currentScrollPosition = window.pageYOffset || document.documentElement.scrollTop;
        localStorage.setItem('scrollPosition', currentScrollPosition);

        // Isi form dengan data item
        document.getElementById('form_id').action = `/admin/edit/sk/${item.id}`;
        document.getElementById('edit_id').value = item.id;
        document.getElementById('edit_nomor_sk').value = item.nomor_sk;
        document.getElementById('edit_tahun').value = item.tahun;
        document.getElementById('edit_tanggal_penetapan').value = item.tanggal_penetapan;
        document.getElementById('edit_tahun').value = item.tahun;

        // Tampilkan modal dan nonaktifkan scroll di body
        document.getElementById('editModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>
@endsection