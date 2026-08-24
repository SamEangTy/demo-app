<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - My Project</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 text-gray-900">
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-8">
                    <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-800">My Project</a>
                    <a href="{{ route('customers.index') }}"
                       class="text-sm font-medium {{ request()->routeIs('customers.*') ? 'text-indigo-600' : 'text-gray-600 hover:text-gray-900' }}">
                        Customers
                    </a>
                    <a href="{{ route('products.index') }}"
                       class="text-sm font-medium {{ request()->routeIs('products.*') ? 'text-indigo-600' : 'text-gray-600 hover:text-gray-900' }}">
                        Products
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                 class="mb-6 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700 flex items-center justify-between">
                <span>{{ session('success') }}</span>
                <button type="button" @click="show = false" class="text-green-500 hover:text-green-700">&times;</button>
            </div>
        @endif

        @if (session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                 class="mb-6 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700 flex items-center justify-between">
                <span>{{ session('error') }}</span>
                <button type="button" @click="show = false" class="text-red-500 hover:text-red-700">&times;</button>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
