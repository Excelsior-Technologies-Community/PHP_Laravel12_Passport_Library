<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 text-gray-800 flex justify-center items-start min-h-screen py-10">

    <div class="max-w-6xl w-full bg-white rounded-2xl shadow-xl p-8">
        <h1 class="text-3xl font-bold mb-6 text-center text-indigo-600">Users</h1>

        <div class="mb-6 flex flex-col md:flex-row gap-3">
            <div class="relative flex-1">
                <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search users"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <div id="loader" class="hidden absolute right-3 top-2.5">
                    <div class="animate-spin h-5 w-5 border-2 border-indigo-600 border-t-transparent rounded-full"></div>
                </div>
            </div>
            <a href="/users/export"
                class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition text-center flex items-center justify-center">
                Export CSV
            </a>
        </div>

        <div id="userData">
            <div class="overflow-x-auto">
                <table class="w-full table-auto rounded-xl border border-gray-200 shadow-md overflow-hidden">
                    <thead>
                        <tr class="bg-indigo-600 text-white text-left">
                            <th class="px-6 py-3 text-center">Avatar</th>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b hover:bg-gray-50 @if($user->trashed()) bg-red-50 @endif">
                                <td class="px-6 py-3 flex justify-center">
                                    <img src="{{ $user->avatar_url }}" class="w-10 h-10 rounded-full object-cover border-2 border-indigo-100">
                                </td>
                                <td class="px-6 py-3 font-medium">{{ $user->name }}</td>
                                <td class="px-6 py-3 text-gray-600">{{ $user->email }}</td>
                                <td class="px-6 py-3 text-sm">
                                    @if($user->trashed())
                                        <span class="text-red-600 font-bold uppercase text-xs">Deleted</span>
                                    @else
                                        <span class="{{ $user->status ? 'text-green-600' : 'text-gray-500' }} font-bold uppercase text-xs">
                                            {{ $user->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-3 space-x-2 text-center">
                                    @if(!$user->trashed())
                                        <a href="/users/toggle-status/{{ $user->id }}"
                                            class="bg-yellow-500 text-white px-3 py-1 rounded text-xs hover:bg-yellow-600 transition">
                                            Toggle Status
                                        </a>
                                        <a href="/users/delete/{{ $user->id }}"
                                            class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600 transition delete-btn">
                                            Delete
                                        </a>
                                    @else
                                        <a href="/users/restore/{{ $user->id }}"
                                            class="bg-green-500 text-white px-3 py-1 rounded text-xs hover:bg-green-600 transition">
                                            Restore
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-center">
                {{ $users->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </div>

    <style>
        nav[role="navigation"] { @apply flex flex-col items-center; }
        nav svg { @apply w-5 h-5; }
        .pagination span, .pagination a { 
            @apply mx-1 px-3 py-1 rounded-lg text-gray-700 hover:text-white hover:bg-indigo-600 transition;
        }
        .active span { @apply bg-indigo-600 text-white font-semibold; }
        .disabled span { @apply text-gray-400; }
    </style>

    <script>
        let timer;
        const searchInput = document.getElementById('search');
        const loader = document.getElementById('loader');
        const userData = document.getElementById('userData');

        searchInput.addEventListener('keyup', function() {
            clearTimeout(timer);
            loader.classList.remove('hidden');

            timer = setTimeout(() => {
                let query = this.value;
                fetch(`/users?search=${query}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(res => res.text())
                .then(data => {
                    userData.innerHTML = data;
                    loader.classList.add('hidden');
                });
            }, 400);
        });

        document.addEventListener('click', function(e) {
            if (e.target.closest('.pagination a')) {
                e.preventDefault();
                loader.classList.remove('hidden');
                let url = e.target.closest('a').getAttribute('href');

                fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(res => res.text())
                .then(data => {
                    userData.innerHTML = data;
                    loader.classList.add('hidden');
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }

            if (e.target.classList.contains('delete-btn')) {
                e.preventDefault();
                const url = e.target.getAttribute('href');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete this user!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#4f46e5',
                    cancelButtonColor: '#ef4444',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            }
        });

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                timer: 2500,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        @endif
    </script>

</body>
</html>