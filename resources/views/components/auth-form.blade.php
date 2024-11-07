<div>
    @if ($type == 'login')
    <!-- Alert Success Registration -->

    <div class=" relative bg-sky-200 flex flex-col lg:flex-row justify-center items-center min-h-screen">
        

        <!-- Alert Login Failed -->

        <!-- Left: Image -->
        <div class="w-full lg:w-1/2 h-48 sm:h-64 md:h-80 lg:h-screen hidden lg:block">
            <img src="https://img.freepik.com/fotos-premium/imagen-fondo_910766-187.jpg?w=826" alt="Placeholder Image"
                class="object-cover w-full h-full">
        </div>

        <!-- Right: Login Form -->
        <div class="relative lg:p-25 md:p-12 sm:p-8 p-4 w-full lg:w-1/2">
            @if (session()->has('success'))

            <div id="alert" class="p-4 mb-4 text-sm text-white rounded-lg bg-green-500 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            @endif

            @if (session()->has('loginError'))
            <div id="alert"
                class=" w-full p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert" role="alert">
                <span class="font-medium">{{ session('loginError') }}</span>
            </div>
            @endif
            <h1 class="font-mono text-center text-3xl font-semibold mb-4 lg:text-left">Login</h1>
            <form id="form" action="/login" method="POST">
                @csrf
                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="font-mono block text-gray-600">Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                        autocomplete="off">
                    @error('email')
                    <div class="text-red-600">
                        *{{ $message }}
                    </div>
                    @enderror
                </div>
                <!-- Password Input -->
                <div class="mb-4">
                    <label for="password" class="font-mono block text-gray-800">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                        autocomplete="off">
                    @error('password')
                    <div class="text-red-600">
                        *{{ $message }}
                    </div>
                    @enderror
                </div>


                <!-- Login Button -->
                <button type="submit" id="loginButton"
                    class="font-mono bg-red-500 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full">Login</button>
            </form>
            <!-- Sign up Link -->
            <div class="mt-6 text-green-500 text-center">
                <a href="/register" class="hover:underline">Belum punya akun? daftar</a>
            </div>
        </div>
    </div>
    @else
    <!-- Register Component -->

    <div class="bg-sky-200 flex flex-col lg:flex-row justify-center items-center min-h-screen">
        <!-- Left: Image -->
        <div class="w-full lg:w-1/2 h-48 sm:h-64 md:h-80 lg:h-screen hidden lg:block">
            <img src="https://img.freepik.com/fotos-premium/imagen-fondo_910766-187.jpg?w=826"
                alt="Placeholder Image" class="object-cover w-full h-full">
        </div>

        <!-- Right: Register Form -->
        <div class="lg:p-25 md:p-12 sm:p-8 p-4 w-full lg:w-1/2">
            <h1 class="font-mono text-2xl font-semibold mb-4">Register</h1>
            <form action="/register" method="POST">
                @csrf
                <!-- Nama Lengkap Input -->
                <div class="mb-4">
                    <label for="nama_lengkap" class="font-mono block text-gray-600">Nama lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                        autocomplete="off">
                    @error('nama_lengkap')
                    <div class="text-red-600">
                        *{{ $message }}
                    </div>
                    @enderror
                </div>
                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="font-mono block text-gray-800">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                        autocomplete="off">
                    @error('email')
                    <div class="text-red-600">
                        *{{ $message }}
                    </div>
                    @enderror
                </div>
                <!-- Password Input -->
                <div class="mb-4">
                    <label for="password" class="font-mono block text-gray-800">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                        autocomplete="off">
                    @error('password')
                    <div class="text-red-600">
                        *{{ $message }}
                    </div>
                    @enderror
                </div>
                <!-- Confirm Password Input -->
                <div class="mb-4">
                    <label for="confirm_password" class="font-mono block text-gray-800">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                        autocomplete="off">
                    @if (session()->has('registErr'))
                    <span class="text-red-600">*{{ session('registErr') }}</span>
                    @endif
                </div>
                <!-- penyetujuan Checkbox -->
                <div class="flex items-start mb-5">
                    <div class="flex items-center h-5">
                        <input id="terms" type="checkbox" value=""
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                            required />
                    </div>
                    <label for="terms" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">I agree
                        with the terms and conditions</label>
                </div>
                <!-- Register Button -->
                <button type="submit"
                    class="font-mono bg-red-500 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full">Register</button>
            </form>
            <!-- Login Link -->
            <div class="mt-6 text-green-500 text-center">
                <a href="/login" class="hover:underline">Sudah punya akun? Login</a>
            </div>
        </div>
    </div>
    @endif
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alert = document.getElementById('alert');

        if (alert) {
            setTimeout(() => {
                alert.style.display = 'none'
            }, 2000);
        }
    })
</script>