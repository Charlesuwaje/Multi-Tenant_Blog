<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Multi-Tenant Blog Admin</h1>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 hover:bg-blue-700 rounded">Dashboard</a>
                <a href="{{ route('admin.posts') }}" class="px-4 py-2 hover:bg-blue-700 rounded">Posts</a>
                {{-- <a href="{{ route('logout') }}" class="px-4 py-2 hover:bg-red-600 bg-red-500 rounded">Logout</a> --}}
                <a href="{{ route('login') }}" class="px-4 py-2 hover:bg-red-600 bg-red-500 rounded">Logout</a>

            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-8">
        @yield('content')
    </div>
</body>
</html>
