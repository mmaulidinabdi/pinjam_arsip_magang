<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-semibold text-center mb-4">Reset Password</h2>
        <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
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
            <label for="password" class="font-mono block text-gray-800">Password</label>
            <div class="relative mb-4">
                <input type="password" id="password" name="password"
                    class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                    autocomplete="off" placeholder="•••••••••">
                <span class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" onclick="togglePassword('password', this)">
                    👁️
                </span>
            </div>
            @error('password')
            <div class="text-red-600 mb-2">
                *{{ $message }}
            </div>
            @enderror

            <!-- Confirm Password Input -->
            <label for="password_confirmation" class="font-mono block text-gray-800">Confirm Password</label>
            <div class="relative mb-4">
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                    autocomplete="off" placeholder="•••••••••">
                <span class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" onclick="togglePassword('password_confirmation', this)">
                    👁️
                </span>
            </div>
            @if (session()->has('registErr'))
            <div class="text-red-600 mb-2">*{{ session('registErr') }}</div>
            @endif
            <button type="submit"
                class="font-mono bg-red-500 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full">Submit</button>
        </form>
    </div>

    <script>
        function togglePassword(inputId, icon) {
            const passwordInput = document.getElementById(inputId);


            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordInput.placeholder = '';
                icon.textContent = '🙈';

            } else {
                passwordInput.type = 'password';
                passwordInput.placeholder = '•••••••••';
                icon.textContent = '👁️';
            }
        }
    </script>
</body>

</html>