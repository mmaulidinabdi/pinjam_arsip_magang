@extends('userLayout.userLayout')

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
                    Nama Arsip
                </th>
                <td class="px-6 py-3">
                    @if($history->status === 'diacc')
                    {{ $history->jenis_arsip }}
                    @if (($history->jenis_arsip = 'imb'))
                    {{ $history->imb->nomor_dp }}
                    {{ $history->imb->tahun }}
                    @elseif(($history->jenis_arsip = 'Arsip1'))
                    {{ $history->arsip1->nomor_dp }}
                    {{ $history->arsip1->tahun }}
                    @elseif(($history->jenis_arsip = 'Arsip2'))
                    {{ $history->arsip2->nomor_dp }}
                    {{ $history->arsip2->tahun }}
                    @endif
                    @else
                    <p>Peminjaman di tolak</p>
                    @endif
                </td>
            </tr>
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    jenis Arsip
                </th>
                <td class="px-6 py-3">{{ $history->jenis_arsip }}</td>
            </tr>
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    Tanggal Peminjaman
                </th>
                <td class="px-6 py-3">{{ $history->tanggal_peminjaman }}</td>
            </tr>
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    Status
                </th>
                <td class="px-6 py-3">{{ $history->status }}</td>
            </tr>
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    Tanggal Pengembalian
                </th>
                <td class="px-6 py-3">{{ $history->tanggal_peminjaman }}</td>
            </tr>
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    File Pendukung
                </th>
                <td class="px-6 py-3">
                    <a href="{{ asset($history->dokumen_pendukung) }}" target="_blank"
                        class="text-blue-600 hover:underline">
                        Lihat File PDF
                    </a>
                </td>
            </tr>

            @if($history->status === 'ditolak')
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                    Alasan Ditolak
                </th>
                <td class="px-6 py-3">
                    {{ $history->alasan_ditolak }}
                </td>
            </tr>
            @endif

        </tbody>
    </table>
</div>



<div class="mt-4">
    <a href="/user/history/{{ Auth()->user()->id }}"
        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
        Back
    </a>
</div>

<script>
    document.getElementById('statusSelect').addEventListener('change', function () {
        const alasanContainer = document.getElementById('alasanContainer');
        if (this.value === 'tolak') {
            alasanContainer.classList.remove('hidden');
        } else {
            alasanContainer.classList.add('hidden');
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