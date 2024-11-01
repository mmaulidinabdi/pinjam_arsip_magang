<div>
    @if ($type == 'login')
    <!-- Alert Success Registration -->

    <div class=" relative bg-sky-200 flex flex-col lg:flex-row justify-center items-center min-h-screen">
        @if (session()->has('success'))
        <div id="alert" class="absolute right-0 top-20 mr-4 mt-4 max-w-sm p-4 mb-4 text-sm text-blue-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">{{ session('success') }}</span>
        </div>
        @endif

        <!-- Alert Login Failed -->

        <!-- Left: Image -->
        <div class="w-full lg:w-1/2 h-48 sm:h-64 md:h-80 lg:h-screen hidden lg:block">
            <img src="https://img.freepik.com/fotos-premium/imagen-fondo_910766-187.jpg?w=826" alt="Placeholder Image" class="object-cover w-full h-full">
        </div>

        <!-- Right: Login Form -->
        <div class="relative lg:p-20 md:p-12 sm:p-8 p-4 w-full lg:w-1/2">
            @if (session()->has('loginError'))
            <div id="alert" class=" w-full p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert" role="alert">
                <span class="font-medium">{{ session('loginError') }}</span>
            </div>
            @endif
            <h1 class="font-mono text-center text-3xl font-semibold mb-4 lg:text-left">Login</h1>
            <form action="/login" method="POST">
                @csrf
                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="font-mono block text-gray-600">Email</label>
                    <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off">
                    @error('email')
                    <div class="text-red-600">
                        *{{ $message }}
                    </div>
                    @enderror
                </div>
                <!-- Password Input -->
                <div class="mb-4">
                    <label for="password" class="font-mono block text-gray-800">Password</label>
                    <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off">
                    @error('password')
                    <div class="text-red-600">
                        *{{ $message }}
                    </div>
                    @enderror
                </div>
                <!-- Remember Me Checkbox -->
                <div class="mb-4 flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="text-red-500 rounded-full">
                    <label for="remember" class="font-mono text-green-900 ml-2">Remember Me</label>
                </div>
            
                <!-- Login Button -->
                <button type="submit" class="font-mono bg-red-500 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full">Login</button>
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
            <img src="https://img.freepik.com/fotos-premium/imagen-fondo_910766-187.jpg?w=826" alt="Placeholder Image" class="object-cover w-full h-full">
        </div>

        <!-- Right: Register Form -->
        <div class="lg:p-20 md:p-12 sm:p-8 p-4 w-full lg:w-1/2">
            <h1 class="font-mono text-2xl font-semibold mb-4">Register</h1>
            <form action="/register" method="POST">
                @csrf
                <!-- Nama Lengkap Input -->
                <div class="mb-4">
                    <label for="nama_lengkap" class="font-mono block text-gray-600">Nama lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off">
                    @error('nama_lengkap')
                    <div class="text-red-600">
                        *{{ $message }}
                    </div>
                    @enderror
                </div>
                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="font-mono block text-gray-800">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off">
                    @error('email')
                    <div class="text-red-600">
                        *{{ $message }}
                    </div>
                    @enderror
                </div>
                <!-- Password Input -->
                <div class="mb-4">
                    <label for="password" class="font-mono block text-gray-800">Password</label>
                    <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off">
                    @error('password')
                    <div class="text-red-600">
                        *{{ $message }}
                    </div>
                    @enderror
                </div>
                <!-- Confirm Password Input -->
                <div class="mb-4">
                    <label for="confirm_password" class="font-mono block text-gray-800">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off">
                    @if (session()->has('registErr'))
                    <span class="text-red-600">*{{ session('registErr') }}</span>
                    @endif
                </div>
                <!-- Register Button -->
                <button type="submit" class="font-mono bg-red-500 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full">Register</button>
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
    const alert = document.getElementById('alert');
</script>