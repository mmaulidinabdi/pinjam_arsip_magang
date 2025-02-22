@extends('adminLayout.adminLayout')

@section('adminLayout')

@if (session()->has('success'))
<div id="alert" class="p-4 mb-4 text-sm text-white rounded-lg bg-green-500 dark:bg-gray-800 dark:text-green-400" role="alert">
    <span class="font-medium">{{ session('success') }}</span>
</div>
@endif

<div class=" font-bold">
    <h2 class="text-xl">
        KELOLA PEMINJAMAN
    </h2>
    <br>
</div>
<table id="filter-table">
    <thead>
        <tr>
            <th>
                <span class="flex items-center ">
                    Nama Peminjam
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                    </svg>
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Arsip
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                    </svg>
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Tanggal
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                    </svg>
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Status
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                    </svg>
                </span>
            </th>
            <th>
                <span class="flex items-center">


                </span>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
        <tr>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->peminjam->nama_lengkap }}
            </td>
            <td>{{ $item->tujuan_peminjam }}</td>
            <td>{{ $item->tanggal_peminjaman }}</td>
            <td>{{ $item->status }}</td>
            <td>
                <a href="{{ url('admin/lanjutan', $item->id) }}"
                    class="whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                    Tindak Lanjut
                </a>

            </td>
        </tr>
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

                        if (index === tHead.childNodes[0].childNodes.length - 1) {
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

    const alert = document.getElementById('alert');

    if (alert) {
        setTimeout(() => {
            alert.style.display = 'none'
        }, 4000);
    }
</script>

@endsection