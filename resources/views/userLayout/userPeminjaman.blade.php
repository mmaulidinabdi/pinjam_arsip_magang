@extends('userLayout.userLayout')

@section('peminjamLayout')
<section class="bg-white dark:bg-gray-900">
    @if (session()->has('success'))
    <div id="alert"
        class="top-0 w-full  mt-4 p-4 mb-4 text-sm text-white rounded-lg bg-green-500 dark:bg-gray-800 dark:text-red-400"
        role="alert">
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif
    <div class=" mx-auto">
        <form action="/user/peminjaman" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="w-full mb-5">
                <p class="text-red-600">* Wajib di isi</p>
            </div>
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <!-- <div class="sm:col-span-2">
                                          <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
                                          <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                                      </div> -->
                <input type="hidden" name="peminjam_id" value="{{ Auth::user()->id }}">
                <div class="w-full">
                    <label for="nama"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                    <input type="text" id="disabled-input-2" aria-label="disabled input 2"
                        class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ Auth::user()->nama_lengkap }}" name="nama" disabled readonly>
                </div>
                <div class="w-full">
                    <label for="alamat"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                    <input type="text" id="disabled-input-2" aria-label="disabled input 2"
                        class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ Auth::user()->alamat }}" name="alamat" disabled readonly>
                </div>
                <div class="w-full">
                    <label for="nomor_hp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                        Handphone</label>
                    <input type="text" id="disabled-input-2" aria-label="disabled input 2"
                        class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ Auth::user()->no_telp }}" name="nomor_hp" disabled readonly>
                </div>
                <div class="w-full">
                    <label for="email"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="text" id="disabled-input-2" aria-label="disabled input 2"
                        class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ Auth::user()->email }}" name="email" disabled readonly>
                </div>

                <div class="w-full">
                    <label for="jenis_arsip" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span
                            class="text-red-600">*</span> Jenis
                        Arsip</label>
                    <select id="category" name="jenis_arsip"
                        class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="SK">SK</option>
                        <option value="IMB">IMB</option>
                    </select>
                </div>
                <div class="w-full">
                    <label for="no_arsip" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> No arsip
                    </label>
                    <input type="text" id="no_arsip" name="no_arsip"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ old('no_arsip') }}" />
                    @error('no_arsip')
                    <div class="text-red-600">
                        *{{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="w-full">
                    <label for="nama_arsip" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> <span
                            class="text-red-600">*</span> Nama Pada Arsip </label>
                    <input type="text" id="nama_arsip" name="nama_arsip" value="{{ old('nama_arsip') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required />
                    @error('nama_arsip')
                    <div class="text-red-600">
                        *{{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="w-full">
                    <label for="data_arsip" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data
                        yang diketahui pada arsip
                    </label>
                    <input type="text" id="first_name" name="data_arsip" value="{{ old('data_arsip') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    @error('data_arsip')
                    <div class="text-red-600">
                        *{{ $message }}
                    </div>
                    @enderror
                </div>



                <div class="sm:col-span-2">
                    <label for="dokumen_pendukung"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dokumen Pendukung</label>
                    <input
                        class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="file_input" type="file" onchange="previewFile(event)" name="dokumen_pendukung">
                    @error('dokumen_pendukung')
                    <div class="text-red-600">
                        *{{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="tujuan_peminjam"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span
                            class="text-red-600">*</span>Tujuan
                        Peminjaman</label>
                    <textarea id="description" rows="8" name="tujuan_peminjam"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Your description here" required></textarea>
                    @error('tujuan_peminjam')
                    <div class="text-red-600">
                        *{{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <button type="submit"
                class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                Kirim
            </button>
        </form>

    </div>
</section>

<script>
    let alert = document.getElementById('alert');
    if (alert) {
        setTimeout(() => {
            alert.style.display = 'none';
        }, 3000);
    }
</script>
@endsection