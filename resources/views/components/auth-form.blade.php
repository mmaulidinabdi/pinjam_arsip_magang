<div>
    @if ($type == 'login')
        <!-- component -->
        <div class="bg-sky-100 flex flex-col lg:flex-row justify-center items-center min-h-screen">
            <!-- Left: Image -->
            <div class="w-full lg:w-1/2 h-64 lg:h-screen hidden lg:block">
                <img src="https://img.freepik.com/fotos-premium/imagen-fondo_910766-187.jpg?w=826" alt="Placeholder Image"
                    class="object-cover w-full h-full">
            </div>
            <!-- Right: Login Form -->
            <div class="lg:p-36 md:p-24 sm:p-16 p-8 w-full lg:w-1/2">
                <h1 class="text-2xl font-semibold mb-4">Login</h1>
                <form action="/login" method="POST">
                    @csrf
                    <!-- Email Input -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-600">Email</label>
                        <input type="email" id="email" name="email"
                            class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                            autocomplete="off">
                        @error('email')
                            <div class="">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <!-- Password Input -->
                    <div class="mb-4">
                        <label for="password" class="block text-gray-800">Password</label>
                        <input type="password" id="password" name="password"
                            class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                            autocomplete="off">
                    </div>
                    <!-- Remember Me Checkbox -->
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="text-red-500 rounded-full">
                        <label for="remember" class="text-green-900 ml-2">Remember Me</label>
                    </div>
                    <!-- Forgot Password Link -->
                    <div class="mb-6 text-blue-500">
                        <a href="#" class="hover:underline">Forgot Password?</a>
                    </div>
                    <!-- Login Button -->
                    <button type="submit"
                        class="bg-red-500 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full">Login</button>
                </form>
                <!-- Sign up Link -->
                <div class="mt-6 text-green-500 text-center">
                    <a href="/register" class="hover:underline">Belum punya akun? daftar</a>
                </div>
            </div>
        </div>
    @else
        <!-- component -->
        <div class="bg-sky-100 flex flex-col lg:flex-row justify-center items-center min-h-screen">
            <!-- Left: Image -->
            <div class="w-full lg:w-1/2 h-64 lg:h-screen hidden lg:block">
                <img src="https://img.freepik.com/fotos-premium/imagen-fondo_910766-187.jpg?w=826"
                    alt="Placeholder Image" class="object-cover w-full h-full">
            </div>
            <!-- Right: Register Form -->
            <div class="lg:p-20 md:p-12 sm:p-8 p-4 w-full lg:w-1/2">
                <h1 class="text-2xl font-semibold mb-4">Register</h1>
                <form action="/register" method="POST">
                    @csrf
                    <!-- nama_lengkap_lengkap Input -->
                    <div class="mb-4">
                        <label for="nama_lengkap" class="block text-gray-600">nama lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                            class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                            autocomplete="off">
                        @error('nama_lengkap')
                            <div class="">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <!-- Email Input -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-800">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                            autocomplete="off">
                        @error('email')
                            <div class="">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <!-- Password Input -->
                    <div class="mb-4">
                        <label for="password" class="block text-gray-800">Password</label>
                        <input type="password" id="password" name="password"
                            class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                            autocomplete="off">
                        @error('password')
                            <div class="">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <!-- Confirm Password Input -->
                    <div class="mb-4">
                        <label for="confirm_password" class="block text-gray-800">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password"
                            class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                            autocomplete="off">
                        @if (session()->has('registErr'))
                            {{ session('registErr') }}
                        @endif
                    </div>
                    <!-- Register Button -->
                    <button type="submit"
                        class="bg-red-500 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full">Register</button>
                </form>
                <!-- Login Link -->
                <div class="mt-6 text-green-500 text-center">
                    <a href="/login" class="hover:underline">Sudah punya akun? Login</a>
                </div>
            </div>
        </div>
    @endif
</div>
