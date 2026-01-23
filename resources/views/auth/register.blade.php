<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Laravel Passport</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8 space-y-6">
            <h2 class="text-2xl font-bold text-center text-indigo-600">Create Your Account</h2>

            <!-- Success / Error Messages -->
            @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded text-sm">
                {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Form -->
            <form method="POST" action="/register" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium mb-1">Name</label>
                    <input type="text" name="name"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Enter your full name" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Email Address</label>
                    <input type="email" name="email"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="you@example.com" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Password</label>
                    <input type="password" name="password"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="••••••••" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="••••••••" required>
                </div>

                <button type="submit"
                        class="w-full bg-indigo-600 text-white text-lg font-semibold rounded-lg px-4 py-2 hover:bg-indigo-700 transition">
                    REGISTER
                </button>
            </form>

            <p class="text-center text-sm text-gray-600">
                Already have an account?
                <a href="/login" class="text-indigo-600 hover:underline font-medium">Login here</a>
            </p>
        </div>
    </div>
</body>
</html>
