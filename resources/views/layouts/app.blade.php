<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SiSantri')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/preline@1.0.0/dist/preline.min.css" />
</head>

<body>
    {{-- Sidebar --}}
    <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg">
        <div class="p-4 border-b">
            <h1 class="text-xl font-bold text-gray-800">SiSantri</h1>
        </div>
        <nav class="mt-4">
            <a href="{{ route('dashboard') }}"
                class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('dashboard') ? 'bg-blue-50' : 'hover:bg-blue-50' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>

            <a href="{{ route('absensi.index') }}"
                class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('absensi.*') ? 'bg-blue-50' : 'hover:bg-blue-50' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                Absensi
            </a>

            <a href="{{ route('sesi.index') }}"
                class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('sesi.*') ? 'bg-blue-50' : 'hover:bg-blue-50' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Sesi Absen
            </a>

            <a href="{{ route('report.index') }}"
                class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('report.*') ? 'bg-blue-50' : 'hover:bg-blue-50' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Report
            </a>
        </nav>



    </div>
    <!-- Main Content -->
    <div class="ml-64 p-8">
        <!-- Navbar -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">@yield('header', 'Dashboard')</h2>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">Mentor: {{ Auth::guard('mentor')->user()->nama }}</span>
                <form method="POST" action="{{ route('mentor.logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-100 text-red-600 rounded-md">Logout</button>
                </form>
            </div>
        </div>

        <!-- Content -->
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/preline@1.0.0/dist/preline.min.js"></script>
    @yield('scripts')
</body>

</html>
