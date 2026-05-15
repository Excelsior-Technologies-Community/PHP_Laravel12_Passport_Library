<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Laravel Passport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen">

    <nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-black text-indigo-600 tracking-tight">PassportApp</h1>

            <div class="flex items-center gap-6">
                <div class="hidden md:flex gap-5">
                    <a href="/dashboard" class="text-sm font-bold text-indigo-600">Dashboard</a>
                    <a href="/users" class="text-sm font-bold text-gray-500 hover:text-indigo-600 transition">Users</a>
                    <a href="/profile" class="text-sm font-bold text-gray-500 hover:text-indigo-600 transition">Profile</a>
                </div>

                <div class="h-8 w-[1px] bg-gray-200"></div>

                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-black text-gray-800 leading-none">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Authorized</p>
                    </div>
                    <a href="/profile">
                        <img src="{{ auth()->user()->avatar_url }}" class="w-10 h-10 rounded-full object-cover border-2 border-indigo-50 shadow-sm hover:border-indigo-500 transition">
                    </a>
                </div>

                <a href="/logout" class="bg-red-50 text-red-600 px-4 py-2 rounded-xl text-xs font-black hover:bg-red-600 hover:text-white transition uppercase tracking-widest">
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 p-10 border border-gray-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-8 opacity-10">
                        <svg class="w-32 h-32 text-indigo-600" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                    </div>
                    
                    <div class="relative z-10">
                        <h2 class="text-4xl font-black text-gray-800 mb-2">
                            Welcome, {{ auth()->user()->name }}!
                        </h2>
                        <p class="text-gray-400 font-medium text-lg mb-8">
                            Control your application and manage API access from here.
                        </p>

                        <div class="flex flex-wrap gap-4">
                            <a href="/users" class="bg-indigo-600 text-white px-8 py-4 rounded-2xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                Manage Users
                            </a>
                            <a href="/profile" class="bg-white border border-gray-200 text-gray-700 px-8 py-4 rounded-2xl font-bold hover:bg-gray-50 transition flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-indigo-50 p-8 rounded-3xl border border-indigo-100 group hover:bg-indigo-600 transition duration-300">
                        <h3 class="font-black text-indigo-700 mb-2 group-hover:text-white transition">OAuth Security</h3>
                        <p class="text-sm text-indigo-600/80 group-hover:text-indigo-50 transition font-medium">
                            Your sessions are encrypted using Laravel Passport's secure internal grant system.
                        </p>
                    </div>

                    <div class="bg-green-50 p-8 rounded-3xl border border-green-100 group hover:bg-green-600 transition duration-300">
                        <h3 class="font-black text-green-700 mb-2 group-hover:text-white transition">Active Status</h3>
                        <p class="text-sm text-green-600/80 group-hover:text-green-50 transition font-medium">
                            System is fully operational. Logged in as: <span class="font-bold underline">{{ auth()->user()->email }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white p-8 rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100">
                    <h3 class="font-black text-gray-800 mb-6 uppercase text-xs tracking-widest border-b pb-4">User Statistics</h3>
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 font-bold">Account Level</span>
                            <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-[10px] font-black uppercase">Administrator</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 font-bold">Member Since</span>
                            <span class="text-gray-800 font-black text-sm">{{ auth()->user()->created_at->format('M Y') }}</span>
                        </div>
                        <div class="pt-4 border-t border-gray-50">
                            <p class="text-xs text-gray-400 font-medium italic text-center">
                                "Ready to scale your API infrastructure with Passport."
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-indigo-600 to-indigo-800 p-8 rounded-3xl shadow-xl shadow-indigo-200 text-white">
                    <h3 class="font-black mb-2 uppercase text-[10px] tracking-widest opacity-80">Quick Tip</h3>
                    <p class="text-sm font-medium leading-relaxed">
                        Use the Export CSV feature in the Users section to download your database records instantly.
                    </p>
                </div>
            </div>

        </div>
    </main>

    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Welcome Back!',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        @endif
    </script>

</body>
</html>