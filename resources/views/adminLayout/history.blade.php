@extends('adminLayout.adminLayout')

@section('adminLayout')
<div class=" font-bold">
    <h2 class="text-xl">
        <h2 class="text-xl">
            HISTORY PEMINJAMAN
        </h2>
        <br>
</div>

<style>
    .datatable-input {
        width: 120px;
        height: 30px;
        padding: 4px;
        font-size: 12px;
    }
</style>

<table id="filter-table" class="">
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
                    Tanggal peminjaman
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
                    Tanggal pengambilan
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                    </svg>
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Tanggal pengembalian
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
                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $item->peminjam->nama_lengkap }}
                </td>

                <td>
                    @if($item->status !== 'ditolak')
                        @if ($item->jenis_arsip === 'IMB')
                            {{ $item->jenis_arsip }}
                            {{ optional($item->imb)->nomor_dp }}
                            {{ optional($item->imb)->tahun }}
                        @elseif ($item->jenis_arsip === 'SK')
                            {{ $item->jenis_arsip }}
                            {{ optional($item->sk)->nomor_sk }}
                            {{ optional($item->sk)->tahun }}
                        @elseif ($item->jenis_arsip === 'arsip2')
                            {{ $item->jenis_arsip }}
                            {{ optional($item->arsip2)->nomor_dp }}
                            {{ optional($item->arsip2)->tahun }}
                        @endif
                    @else
                    @endif

                </td>


                </t>


                <td>
                    {{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->translatedFormat('d F Y') }}
                </td>
                <td>
                    @if($item->tanggal_pengambilan === null && $item->status === 'diacc')
                        <p>belum di ambil</p>
                    @else
                        {{ $item->status }}
                    @endif
                </td>
                <td>
                    @if($item->tanggal_pengambilan === null && $item->status === 'diacc')
                        <div class="flex flex-col">
                            <form action="{{ route('pengambilan', $item->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    class=" w-full text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                    Konfirmasi pengambilan
                                </button>
                            </form>
                            <form action="{{ route('pembatalan', $item->id) }}" method="POST" class="inline">
                                @csrf
                            <button type="submit"
                                class=" whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                batalkan
                            </button>
                            </form>
                        </div>
                    @elseif($item->status !== 'diacc')

                    @else
                        {{ \Carbon\Carbon::parse($item->tanggal_pengambilan)->translatedFormat('d F Y') }}
                    @endif
                </td>
                <td>
                    @if($item->tanggal_pengambilan !== null)
                        @if ($item->status === 'diacc')
                            @if ($item->tanggal_pengembalian !== null)
                                {{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->translatedFormat('d F Y') }}
                            @else
                                <form action="{{ route('konfirmasi.pengembalian', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="min-w-[60px] whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                        Konfirmasi pengembalian
                                    </button>
                                </form>
                            @endif
                        @endif
                    @else
                    @endif
                </td>

                <td>
                    <a href="{{ url('admin/detail', $item->id) }}"
                        class="whitespace-nowrap text-white bg-gray-700 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                        details
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

                        if (index >= tHead.childNodes[0].childNodes.length - 1) {
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
</script>
@endsection