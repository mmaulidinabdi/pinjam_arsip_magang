@extends('userLayout.userLayout')

@section('peminjamLayout')
    @if (Auth::user()->isVerificate == 'ditolak')
        <p class="inset-x-0 top-0 p-4 mb-4 text-sm text-white rounded-lg bg-red-600 dark:bg-gray-800 dark:text-red-400">
            Verifikasi ditolak !! dengan alasan {{ Auth::user()->alasan_ditolak }}, Mohon isi kembali
        </p>
    @elseif (Auth::user()->isVerificate == 'diperiksa')
        <p class="inset-x-0 top-0 p-4 mb-4 text-sm text-white rounded-lg bg-red-600 dark:bg-gray-800 dark:text-red-400">
            Data belum diverifikasi
        </p>
    @else
        <p
            class="
            inset-x-0 top-0 p-4 mb-4 text-sm text-white rounded-lg bg-green-700 dark:bg-gray-800 dark:text-red-400">
            Data sudah diverifikasi
        </p>
    @endif

    <form action="/user/{{ Auth::user()->id }}/updateProfile" method="POST" enctype="multipart/form-data">
        @if (session()->has('success'))
            <div id="alert"
                class="top-0 w-full  mt-4 p-4 mb-4 text-sm text-white rounded-lg bg-green-500 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif
        @method('put')
        @csrf

        <div class="grid gap-6 mb-6 md:grid-cols-1">
            <div>
                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                <input type="text" id="nama" name="nama_lengkap"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ Auth::user()->nama_lengkap }}" placeholder="John" required />
                <!-- Status verifikasi -->
            </div>
            <div>
                <label for="nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIK</label>
                <input type="text" id="nik" name="nik"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ old('nik') ?? Auth::user()->nik }}"  required />
                    @error('nik')
                        <div class="text-red-600">
                            *{{ $message }}
                        </div>
                    @enderror
            </div>

            <div>
                <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                <input type="text" id="alamat" name="alamat"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ old('alamat') ?? Auth::user()->alamat}}" placeholder="" required />
            </div>
            <div>
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                    Telepon/Handphone</label>
                <input type="text" id="phone" name="no_telp"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ old('no_telp') ?? Auth::user()->no_telp }}" placeholder="" required />
                @error('no_telp')
                    <div class="text-red-600">
                        *{{ $message }}
                    </div>
                @enderror
            </div>

        </div>
        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
            <input type="email" id="email" name="email" disabled
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                value="{{ Auth::user()->email }}" placeholder="john.doe@company.com" required />
        </div>
        @error('email')
            <div class="text-red-600">
                *{{ $message }}
            </div>
        @enderror


        <div class="flex items-center justify-center w-full my-4">
            <input
                class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                id="file_input" type="file" onchange="previewFile(event)" name="ktp">
        </div>

        @error('ktp')
            <div class="text-red-600">
                *{{ $message }}
            </div>
        @enderror
        <div class="flex w-full items-center justify-center my-4" id="ktp_display">
            <img id="preview_image" class="max-w-xs rounded-lg" alt="Image preview"
                src="{{ Auth::user()->ktp ? asset('storage/' . Auth::user()->ktp) : '' }}"
                style="{{ Auth::user()->ktp ? '' : 'display: none;' }}" />
        </div>

        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

        <script>
            function previewFile(event) {
                const previewImage = document.getElementById('preview_image');
                const file = event.target.files[0];

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewImage.style.display = 'block'; // Show preview image
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewImage.style.display = 'none'; // Hide preview if not an image
                    previewImage.src = ''; // Clear the image source
                }
            }


            document.addEventListener('DOMContentLoaded', function() {
                const alert = document.getElementById('alert');

                if (alert) {
                    setTimeout(() => {
                        alert.style.display = 'none'
                    }, 2000);
                }
            })
            const alert = document.getElementById('alert');
        </script>
    @endsection
