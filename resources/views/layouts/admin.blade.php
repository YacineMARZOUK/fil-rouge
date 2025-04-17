<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'GainZone') }} - Administration</title>
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/your-code.js" crossorigin="anonymous"></script>
    @stack('styles')
</head>
<body class="bg-gray-900 text-white min-h-screen">
    <!-- Navbar -->
    <nav class="bg-dark border-b border-gray-700 fixed w-full z-10">
        <div class="container mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-primary">
                            GainZone Admin
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 
                                  {{ request()->routeIs('admin.dashboard') ? 'text-primary border-b-2 border-primary' : 'text-gray-400 hover:text-white' }}">
                            Tableau de bord
                        </a>
                        <a href="{{ route('admin.products.index') }}" 
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5
                                  {{ request()->routeIs('admin.products.*') ? 'text-primary border-b-2 border-primary' : 'text-gray-400 hover:text-white' }}">
                            Produits
                        </a>
                        <a href="{{ route('admin.users.index') }}" 
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5
                                  {{ request()->routeIs('admin.users.*') ? 'text-primary border-b-2 border-primary' : 'text-gray-400 hover:text-white' }}">
                            Utilisateurs
                        </a>
                    </div>
                </div>

                <!-- Right Side -->
                <div class="flex items-center">
                    <div class="ml-3 relative">
                        <div class="flex items-center">
                            <span class="text-gray-400 mr-4">{{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-gray-400 hover:text-white">
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="pt-16">
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white p-4 mb-4">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    @stack('scripts')
</body>
</html> 