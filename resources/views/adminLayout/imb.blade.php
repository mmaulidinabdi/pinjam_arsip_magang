@extends('adminLayout.adminLayout')

@section('peminjamLayout')
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
    <h2 class="text-xl">Manajemen IMB</h2>
    <br>
</div>

@if (session()->has('success'))
<div id="alertSuccess" class="p-4 mb-4 text-sm text-white rounded-lg bg-green-500 dark:bg-gray-800 dark:text-green-400" role="alert">
    <span class="font-medium">{{ session('success') }}</span>
</div>
@endif


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
                    <input type="text" name="nomor_dp" id="edit_nomor_dp"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " value=""  />
                    <label for="floating_nomor_dp"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600">Nomor
                        DP</label>
                </div>

                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="nama_pemilik" id="edit_nama"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " value=""  />
                    <label for="floating_nama"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600">Nama</label>
                </div>

                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="alamat" id="edit_alamat"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " value=""  />
                    <label for="floating_alamat"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600">Alamat</label>
                </div>

                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="lokasi" id="edit_lokasi"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " value=""  />
                    <label for="floating_lokasi"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600">Lokasi</label>
                </div>

                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="box" id="edit_box"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " value=""  />
                    <label for="floating_box"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600">Box</label>
                </div>

                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="keterangan" id="edit_keterangan"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " value="" />
                    <label for="floating_keterangan"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600">Keterangan</label>
                </div>

                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="tahun" id="edit_tahun"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " value=""  />
                    <label for="floating_tahun"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600">Tahun</label>
                </div>
            </div>
            <div class="mb-14">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    for="multiple_files">Upload
                    File
                    IMB</label>
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="multiple_files" name="imbs[]" type="file" value="" multiple
                    accept=".pdf">
                <input type="hidden" id="merge_imbs" name="imbs">
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

<table id="filter-table">
    <thead>
        <tr>
            <th>
                <span class="flex items-center">
                    Nomor DP
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                    </svg>
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Pemilik
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                    </svg>
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    alamat
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Lokasi
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                    </svg>
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Box
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                    </svg>
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Keterangan

                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Tahun
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                    </svg>
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    File
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Edit
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Hapus
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Print
                </span>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataImb as $imb )

        <tr>
            <!-- <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white"></td> -->
            <td>{{$imb->nomor_dp}}</td>
            <td>{{$imb->nama_pemilik}}</td>
            <td>{{ $imb->alamat }}</td>
            <td>{{ $imb->lokasi }}</td>
            <td>{{ $imb->box }}</td>
            <td>{{$imb->keterangan}}</td>
            <td>{{$imb->tahun}}</td>
            <td class="px-6 py-4 hidden-print">
                <a href="/admin/lihat/{{ $imb->imbs }}" target="_blank">
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
                <a href="#" onclick="openEditModal({{ json_encode($imb) }})"
                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                    </svg>
                </a>

            </td>
            <td class="px-6 py-4">
                <a href="/admin/delete/imb/{{$imb->id}}" onclick=" return confirmDelete({{$imb->id}})">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd" />
                    </svg>

                </a>
            </td>
            <td class="px-6 py-4 hidden-print">
                <a href="#" class="print-pdf font-medium text-blue-600 dark:text-blue-500 hover:underline"
                    data-file="{{ asset('storage/imbs/' . $imb->imbs) }}">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                            d="M16.444 18H19a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h2.556M17 11V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v6h10ZM7 15h10v4a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-4Z" />
                    </svg>
                </a>
            </td>
        </tr>
        @endforeach


    </tbody>
</table>


<script>

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('mergeButton').addEventListener('click', async () => {
            const files = document.getElementById('multiple_files').files;

            if (files.length === 0) {
                alert('Pilih setidaknya satu file PDF.');
                return;
            }

            const {
                PDFDocument
            } = PDFLib;
            const mergedPdf = await PDFDocument.create();

            for (const file of files) {
                const pdfBytes = await file.arrayBuffer();
                const pdfDoc = await PDFDocument.load(pdfBytes);
                const pages = await mergedPdf.copyPages(pdfDoc, pdfDoc.getPageIndices());
                pages.forEach(page => mergedPdf.addPage(page));
            }

            const mergedPdfBytes = await mergedPdf.save();
            const mergedPdfBlob = new Blob([mergedPdfBytes], {
                type: 'application/pdf'
            });

            // Convert Blob to Base64
            const reader = new FileReader();
            reader.readAsDataURL(mergedPdfBlob);
            reader.onloadend = function() {
                const base64data = reader.result;
                document.getElementById('merge_imbs').value = base64data;
                alert('File PDF berhasil digabungkan dan siap untuk disubmit.');
            };
        });
    })

    

    // delay alert
    const alertSuccess = document.getElementById("alertSuccess");

    if (alertSuccess) {
        setTimeout(() => {
            alertSuccess.style.display = "none";
        }, 2000);
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
                        if (index >= tHead.childNodes[0].childNodes.length - 4) {
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




    function openEditModal(item) {
        // Simpan posisi scroll saat ini ke localStorage
        currentScrollPosition = window.pageYOffset || document.documentElement.scrollTop;
        localStorage.setItem('scrollPosition', currentScrollPosition);

        // Isi form dengan data item
        document.getElementById('form_id').action = `/admin/edit/imb/${item.id}`;
        document.getElementById('edit_id').value = item.id;
        document.getElementById('edit_nomor_dp').value = item.nomor_dp;
        document.getElementById('edit_nama').value = item.nama_pemilik;
        document.getElementById('edit_alamat').value = item.alamat;
        document.getElementById('edit_lokasi').value = item.lokasi;
        document.getElementById('edit_keterangan').value = item.keterangan;
        document.getElementById('edit_box').value = item.box;
        document.getElementById('edit_tahun').value = item.tahun;

        // Tampilkan modal dan nonaktifkan scroll di body
        document.getElementById('editModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        // Sembunyikan modal
        document.getElementById('editModal').classList.add('hidden');

        // Aktifkan kembali scroll di body
        document.body.style.overflow = 'auto';

        // Kembalikan posisi scroll ke posisi yang disimpan sebelumnya
        const savedScrollPosition = localStorage.getItem('scrollPosition');
        if (savedScrollPosition) {
            window.scrollTo(0, parseInt(savedScrollPosition));
            localStorage.removeItem('scrollPosition');
        }
    }

    document.querySelectorAll('.print-pdf').forEach(function(element) {
        element.addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah link default
            let pdfFile = this.getAttribute('data-file'); // Ambil URL PDF dari data-file

            // Buka PDF di tab baru
            let win = window.open(pdfFile, '_blank');

            // Cek jika jendela tidak terbuka (misalnya popup diblokir)
            if (!win) {
                alert("Silakan izinkan popup untuk membuka dokumen.");
                return;
            }

            // Periksa apakah file PDF dapat dimuat
            win.onload = function() {
                win.print();

            };

            win.onerror = function() {
                console.error("Gagal memuat PDF.");

            };
        });
    });


    // Hapus
    function confirmDelete(id) {
        const isConfirmed = confirm("Yakin Ingin Mengahapus?")

        if (isConfirmed) {
            return true;
        } else {
            // Batal, tidak ada tindakan
            return false;
        }
    }

    // print 
    function printTable() {
        let table = document.getElementById('dataTable');
        if (table) {
            printWindow.onload = function() {
                printWindow.print();

            };
        }
    }
</script>
@endsection