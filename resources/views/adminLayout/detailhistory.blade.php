@extends('adminLayout.adminLayout')

@section('adminLayout')

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
                    <td class="px-6 py-3">{{ $item->peminjam->nama_lengkap }}</td>
                </tr>
                @if ($item->status === 'diacc')
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                            Arsip
                        </th>
                        <td class="px-6 py-3">
                            @if ($item->status === 'diacc')
                                {{ $item->jenis_arsip }}
                                @if ($item->jenis_arsip === 'IMB')
                                    {{ $item->imb->nomor_dp }}
                                    {{ $item->imb->tahun }}
                                @elseif($item->jenis_arsip === 'SK')
                                    {{ $item->sk->nomor_sk }}
                                    {{ $item->sk->tahun }}
                                @elseif($item->jenis_arsip === 'Arsip2')
                                    {{ $item->arsip2->nomor_dp }}
                                    {{ $item->arsip2->tahun }}
                                @endif
                            @else
                                <p>Peminjaman di tolak</p>
                            @endif

                        </td>
                    </tr>
                @endif
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
                        @if ($item->peminjam->ktp)
                            <a href="{{ asset('storage/' . $item->peminjam->ktp) }}" target="_blank"
                                class="text-blue-600 hover:underline">
                                Lihat File KTP
                            </a>
                        @else
                            <p>Tidak Ada File</p>
                        @endif
                    </td>
                </tr>
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                        File Pendukung
                    </th>
                    <td class="px-6 py-3">
                        @if($item->dokumen_pendukung)
                        <a href="{{ asset('storage/'. $item->dokumen_pendukung) }}" target="_blank"
                            class="text-blue-600 hover:underline">
                            Lihat File
                        </a>
                        @else
                        <p>Tidak Ada File</p>
                        @endif
                    </td>
                </tr>
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                        Status
                    </th>
                    <td class="px-6 py-3">
                        {{ $item->status }}
                    </td>
                </tr>

                @if ($item->status === 'ditolak')
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                            Alasan Ditolak
                        </th>
                        <td class="px-6 py-3">
                            {{ $item->alasan_ditolak }}
                        </td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>

    <div id="alasanContainer" class="hidden mt-2">
        <label for="alasan" class="block text-sm font-medium text-gray-700">Alasan Penolakan</label>
        <textarea id="alasan" rows="3
        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring
            focus:ring-blue-200"></textarea>

    </div>


    <div class="mt-4">
        <a href="{{ url('admin/histori') }}"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
            Back
        </a>
    </div>

    <script>
        document.getElementById('statusSelect').addEventListener('change', function() {
            const alasanContainer = document.getElementById('alasanContainer');
            if (this.value === 'tolak') {
                alasanContainer.classList.remove('hidden');
            } else {
                alasanContainer.classList.add('hidden');
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
