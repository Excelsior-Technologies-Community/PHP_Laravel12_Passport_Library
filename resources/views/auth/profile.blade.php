<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | Laravel Passport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

<div class="max-w-md w-full bg-white rounded-3xl shadow-2xl p-8 border border-gray-100">
    
    <div class="flex items-center justify-between mb-8">
        <a href="/dashboard" class="text-gray-400 hover:text-indigo-600 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h2 class="text-2xl font-black text-gray-800">Edit Profile</h2>
        <div class="w-6"></div>
    </div>

    <form action="/profile" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="flex flex-col items-center">
            <div class="relative group">
                <img id="avatarPreview" 
                     src="{{ auth()->user()->avatar_url }}" 
                     class="w-32 h-32 rounded-full object-cover border-4 border-indigo-500 shadow-xl transition duration-300 group-hover:brightness-90">
                
                <label for="avatarInput" class="absolute bottom-0 right-0 bg-indigo-600 p-2.5 rounded-full cursor-pointer hover:bg-indigo-700 transition shadow-xl border-4 border-white">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </label>
            </div>
            <input type="file" name="avatar" id="avatarInput" class="hidden" accept="image/*">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-3">Click icon to change photo</p>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-1 ml-1">Full Name</label>
                <input type="text" name="name" value="{{ auth()->user()->name }}"
                    class="w-full bg-gray-50 border border-gray-100 p-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition font-semibold text-gray-700" required>
            </div>

            <div>
                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-1 ml-1">Email Address</label>
                <input type="email" value="{{ auth()->user()->email }}"
                    class="w-full bg-gray-100 border border-gray-100 p-3 rounded-2xl text-gray-400 cursor-not-allowed outline-none font-semibold" disabled>
                <p class="text-[10px] text-gray-400 mt-1 ml-1">* Email cannot be changed for security reasons.</p>
            </div>
        </div>

        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-2xl shadow-indigo-200 shadow-lg transform transition active:scale-95 uppercase tracking-widest text-sm">
            Update Profile
        </button>
    </form>
</div>

<script>
    document.getElementById('avatarInput').onchange = evt => {
        const [file] = document.getElementById('avatarInput').files;
        if (file) {
            document.getElementById('avatarPreview').src = URL.createObjectURL(file);
        }
    }

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Updated!',
            text: "{{ session('success') }}",
            timer: 2500,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    @endif

    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{{ $errors->first() }}",
            confirmButtonColor: '#4f46e5'
        });
    @endif
</script>

</body>
</html>