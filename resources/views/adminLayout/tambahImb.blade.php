@extends('adminLayout.adminLayout')

@section('peminjamLayout')

<form method="post" action="/admin/tambahImb">
    @csrf
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div class="col-span-2">
            <h2 class="font-sans font-bold text-2xl">{{ $title }}</h2>
        </div>
        <div>
            <label for="nomor_dp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor DP</label>
            <input type="text" id="nomor_dp" name="nomor_dp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{old('nomor_dp')}}"  />
        </div>
        <div>
            <label for="nama_pemilik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pemilik</label>
            <input type="text" id="nama_pemilik" name="nama_pemilik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{old('nama_pemilik')}}"  />
        </div>
        <div>
            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
            <input type="text" id="alamat" name="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{old('alamat')}}" />
        </div>
        <div>
            <label for="lokasi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasi</label>
            <input type="text" id="lokasi" name="lokasi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{old('lokasi')}}" />
        </div>
        <div>
            <label for="box" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Box</label>
            <input type="number" id="box" name="box" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{old('box')}}" />
        </div>
    </div>
    <div class="mb-6">
        <label for="tahun" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun</label>
        <input type="number" id="tahun" name="tahun" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{old('tahun')}}" />
    </div>
    <div class="mb-6">
        <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
        <textarea id="keterangan" rows="4" name="keterangan" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Contoh: Salinan untuk Kadis"></textarea>
    </div>

    <div class="mb-14">

        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">Upload File
            IMB (.PDF)</label>
        <input
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            id="multiple_files" type="file" name="imbs[]" multiple accept=".pdf">
        <input type="hidden" id="merge_imbs" name="imbs">
    </div>

    <button type="button" id="mergeButton"
        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
        Gabungkan PDF
    </button>

    <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>


<!-- Tambahkan library pdf-lib dari CDN -->
<script src="https://cdn.jsdelivr.net/npm/pdf-lib/dist/pdf-lib.min.js"></script>

<script>
    document.getElementById('mergeButton').addEventListener('click', async () => {
        const files = document.getElementById('multiple_files').files;

        if (files.length === 0) {
            alert('Pilih setidaknya satu file PDF.');
            return;
        }

        // Gunakan PDFDocument dari pdf-lib yang diimpor melalui CDN
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
</script>

@endsection