@extends('adminLayout.adminLayout')

@section('adminLayout')
<style>
    /* Style for the search input box in the table header */
    .datatable-input {
        width: 120px;
        height: 30px;
        padding: 4px;
        font-size: 12px;
    }

    /* Style for modal */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<div class="font-bold">
    <h2 class="text-xl">User</h2>
    <br>
</div>

@if (session()->has('passBeda'))
    <div id="alert" class="p-4 mb-4 text-sm text-white rounded-lg bg-red-600 dark:bg-gray-800 dark:text-green-400"
        role="alert">
        <span class="font-medium">{{ session('passBeda') }}</span>
    </div>
@endif
@if (session()->has('success'))
    <div id="alert" class="p-4 mb-4 text-sm text-white rounded-lg bg-green-500 dark:bg-gray-800 dark:text-green-400"
        role="alert">
        <span class="font-medium">{{ session('success') }}</span>
    </div>
@endif

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
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Yakin Ingin Hapus User?</h3>

                <!-- Form Delete -->
                <form action="" method="POST" id="formDelete">
                    @csrf
                    @method('DELETE')
                    <button data-modal-hide="popup-modal" type="submit"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5">
                        Yes
                    </button>
                </form>

                <!-- Cancel Button -->
                <button data-modal-hide="popup-modal" type="button"
                    class="py-2.5 px-5 mt-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    No, cancel
                </button>
            </div>
        </div>
    </div>
</div>


<table id="filter-table">
    <thead>
        <tr>
            <th>
                <span class="flex items-center ">Nama User
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                    </svg>
                </span>
            </th>
            <th>Alamat</th>
            <th>Email</th>
            <th>No telp</th>
            <th>KTP</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($peminjams as $peminjam)
        <tr>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $peminjam->nama_lengkap }}
            </td>
            <td>{{ $peminjam->alamat }}</td>
            <td>{{ $peminjam->email }}</td>
            <td>{{ $peminjam->no_telp }}</td>
            <td>
                <a href="{{ asset('storage/' . $peminjam->ktp) }}" target="_blank"
                    class="text-blue-600 hover:underline">
                    Lihat File PDF
                </a>
            </td>
            <td>
                @if ($peminjam->isVerificate == 'diperiksa')
                <button
                    class="min-w-[60px] whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                    <a type="button" href="/admin/terima/{{ $peminjam->id }}">
                        PERIKSA
                    </a>
                    <button type="button" onclick="openModal('{{ $peminjam->id }}')"
                        class="min-w-[60px] whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                        Ditolak
                    </button>
                    @else
                        <button type="button"
                            class="min-w-[60px] whitespace-nowrap text-white bg-green-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                            DI ACC
                        </button>
                    @endif
            </td>
            <td>
                <!-- hapus -->
                <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                onclick="confirmDelete('{{ $peminjam->id, $peminjam->nama_lengkap }}')"
                    class="min-w-[60px] whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
                    type="button">
                    Hapus
                </button>

                    <!-- edit -->
                    <button data-modal-target="updateProductModal{{ $peminjam->id }}"
                        data-modal-toggle="updateProductModal{{ $peminjam->id }}"
                        class="min-w-[60px] whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
                        type="button">
                        Edit
                    </button>



                </td>
            </tr>


        <!-- Modal khusus untuk peminjam ini -->
        <div id="myModal-{{ $peminjam->id }}" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('{{ $peminjam->id }}')">&times;</span>
                <h3>Alasan Ditolak</h3>
                <form action="/admin/tolak/{{ $peminjam->id }}" method="POST">
                    @csrf
                    <textarea placeholder="Alasan ditolak..." name="alasan_ditolak"
                        class="w-full p-2 border rounded-md dark:bg-gray-800 dark:text-white"></textarea>
                    <button type="submit"
                        class="min-w-[60px] whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                        Konfirmasi
                    </button>
                </form>
            </div>
        </div>

            <!-- update modal -->
            <div id="updateProductModal{{ $peminjam->id }}" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                    <!-- Modal content -->
                    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                        <!-- Modal header -->
                        <div
                            class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Update
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="updateProductModal{{ $peminjam->id }}">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form action="/admin/updateUser/{{ $peminjam->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                <div>
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                        Pengguna</label>
                                    <input type="text" name="nama_lengkap" id="name" disabled
                                        value="{{ $peminjam->nama_lengkap }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                </div>
                                <div>
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                    <input type="text" name="email" id="email" value="{{ $peminjam->email }}" disabled
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Ex. Apple">
                                </div>
                                <div class="mb-6">
                                    <label for="password"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                    <div class="relative">
                                        <input type="password" id="password" name="password"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="•••••••••" required />
                                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer"
                                            onclick="togglePassword('password', this)">
                                            👁️
                                        </span>
                                    </div>
                                </div>

                                <div class="mb-6">
                                    <label for="confirm_password"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
                                        Password</label>
                                    <div class="relative">
                                        <input type="password" id="confirm_password" name="confirm_password"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="•••••••••" required />
                                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer"
                                            onclick="togglePassword('confirm_password', this)">
                                            👁️
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <button data-modal-hide="updateProductModal{{ $peminjam->id }}" type="submit"
                                    class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                    Simpan
                                </button>
                                <button data-modal-hide="updateProductModal{{ $peminjam->id }}" type="button"
                                    class=" bg-red-700 py-2.5 px-5 ms-3 text-sm font-medium focus:outline-none text-white rounded-lg border border-gray-200  hover:bg-red-800 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                                    Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

    </tbody>
</table>




<script>
    //  toggle password
    function togglePassword(inputId, icon) {
        const passwordInput = document.getElementById(inputId);


        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordInput.placeholder = '';
            icon.textContent = '🙈';

        } else {
            passwordInput.type = 'password';
            passwordInput.placeholder = '•••••••••';
            icon.textContent = '👁️';
        }
    }

    if (document.getElementById("filter-table") && typeof simpleDatatables.DataTable !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#filter-table", {
            tableRender: (_data, table, type) => {
                if (type === "print") {
                    return table;
                }
                const tHead = table.childNodes[0];
                const filterHeaders = {
                    nodeName: "TR",
                    attributes: {
                        class: "search-filtering-row"
                    },
                    childNodes: tHead.childNodes[0].childNodes.map((_th, index) => {
                        if (index >= tHead.childNodes[0].childNodes.length - 3) {
                            return {
                                nodeName: "TH"
                            };
                        }
                        return {
                            nodeName: "TH",
                            childNodes: [{
                                nodeName: "INPUT",
                                attributes: {
                                    class: "datatable-input",
                                    type: "search",
                                    "data-columns": "[" + index + "]"
                                }
                            }]
                        };
                    })
                };

                tHead.childNodes.push(filterHeaders);
                return table;
            }
        });
    }


    function openModal(id) {
        const modal = document.getElementById(`myModal-${id}`);
        modal.style.display = "block"; // Tampilkan modal yang sesuai
    }

    function closeModal(id) {
        const modal = document.getElementById(`myModal-${id}`);
        modal.style.display = "none"; // Sembunyikan modal yang sesuai
    }

    window.onclick = function (event) {
        const modals = document.getElementsByClassName("modal");
        for (let modal of modals) {
            if (event.target === modal) {
                modal.style.display = "none"; // Sembunyikan modal saat klik di luar modal
            }
        }
    }

    // Fungsi untuk mengirim form saat konfirmasi penghapusan
    function confirmDelete(id, nama) {
        // Update form action dynamically
        const formDelete = document.getElementById('formDelete');
        formDelete.action = `/admin/hapusUser/${id}`;

        // Update modal message dynamically
        // const modalMessage = document.querySelector('#popup-modal h3');
        // modalMessage.textContent = `Yakin Ingin Hapus User "${nama}"?`;
    }

    // modal update
    // document.addEventListener("DOMContentLoaded", function(event) {
    //     document.getElementById('updateUser').click();
    // });

    // kirim form update
    function updateUser() {
        document.getElementById('updateForm').submit();
    }

    document.addEventListener('DOMContentLoaded', function () {
        const alert = document.getElementById('alert');

        if (alert) {
            setTimeout(() => {
                alert.style.display = 'none'
            }, 2000);
        }
    })
</script>
@endsection