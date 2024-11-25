@extends('adminLayout.adminLayout')

@section('adminLayout')

<form method="post" action="{{route('admin.tambahSK')}}">
    @method('post')
    @csrf
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div class="col-span-2">
            <h2 class="font-sans font-bold text-2xl">{{ $title }}</h2>
        </div>
        <div>
            <label for="nomor_sk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Surat Keputusan </label>
            <input type="text" id="nomor_sk" name="nomor_sk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{old('nomor_sk')}}" />
        </div>
        <div>
            <label for="tahun" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun </label>
            <input type="number" id="tahun" name="tahun" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{old('tahun')}}" />
        </div>
    </div>

    <div class="mb-6">
        <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Penetapan</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
            </div>
            <input datepicker id="tanggal" type="text" name="tanggal_penetapan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="bulan/tanggal/tahun" value="{{old('tanggal_penetapan')}}" >
        </div>

    </div>
    <div class="mb-6">
        <label for="tentang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tentang</label>
        <textarea id="tentang" rows="4" name="tentang" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Contoh: TIM PENYUSUN...."></textarea>
    </div>

    <div class="mb-14">

        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">Upload File
            SK (.PDF)</label>
        <input
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            id="multiple_files" type="file" name="sk[]" multiple accept=".pdf">
        <input type="hidden" id="merge_sk" name="sk">
    </div>

    <button type="button" id="mergeButton"
        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
        Gabungkan PDF
    </button>

    <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>



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
            document.getElementById('merge_sk').value = base64data;
            alert('File PDF berhasil digabungkan dan siap untuk disubmit.');
        };
    });
</script>

@endsection