<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex flex-col justify-center items-center min-h-screen">
    @if (session()->has('success'))
    <div id="alert" class="p-4 mb-4 text-sm text-white rounded-lg bg-green-500" role="alert">
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <!-- Alert message -->



        <!-- Form Title -->
        <h2 class="text-2xl font-semibold text-center mb-4">Forgot Password</h2>

        <!-- Form -->
        <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
            @csrf
            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email" required
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <!-- Error Message -->
            @if($errors->any())
            <div class="text-red-600 text-sm mt-1">{{ $errors->first('email') }}</div>
            @endif

            <!-- Submit Button -->
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full">
                Send Reset Link
            </button>
        </form>
    </div>
</body>


</html>