@extends('adminLayout.adminLayout')

@section('peminjamLayout')
    <div class="font-bold">
        <h2 class="text-xl">User</h2>
        <br>
    </div>

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
                            <button class="min-w-[60px] whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                <a type="button" href="/admin/terima/{{ $peminjam->id }}">
                                    PERIKSA
                                </a>
                            </button>
                            <button type="button" onclick="openModal({{ $peminjam->id }})"
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
                        <form action="/admin/hapusUser/{{ $peminjam->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="min-w-[60px] whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                Hapus
                            </button>
                        </form>
                        <button type="button"
                            class="min-w-[60px] whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                            edit
                        </button>
                    </td>
                </tr>
                <!-- Modal khusus untuk peminjam ini -->
                <div id="myModal-{{ $peminjam->id }}" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal({{ $peminjam->id }})">&times;</span>
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
            @endforeach

        </tbody>
    </table>


    <script>
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

        window.onclick = function(event) {
            const modals = document.getElementsByClassName("modal");
            for (let modal of modals) {
                if (event.target === modal) {
                    modal.style.display = "none"; // Sembunyikan modal saat klik di luar modal
                }
            }
        }
    </script>
@endsection
