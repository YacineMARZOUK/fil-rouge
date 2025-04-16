<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GainZone - Votre partenaire fitness</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#CDFB47',
                        'primary-dark': '#B8E235',
                        'dark': '#000000',
                        'light': '#FFFFFF',
                        'gray': {
                            100: '#F3F4F6',
                            200: '#E5E7EB',
                            300: '#D1D5DB',
                            400: '#9CA3AF',
                            500: '#6B7280',
                            600: '#4B5563',
                            700: '#374151',
                            800: '#1F2937',
                            900: '#111827',
                        }
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer base {
            body {
                @apply bg-dark text-light;
            }
        }
        
        @layer components {
            .btn-primary {
                @apply bg-primary text-dark font-semibold px-6 py-2 rounded-full hover:bg-primary-dark transition-all duration-300;
            }
            
            .nav-link {
                @apply text-gray-300 hover:text-light transition duration-300;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-dark bg-opacity-90 backdrop-blur-sm">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-2xl font-bold text-primary">
                    GainZone
                </a>
                
                <!-- Navigation Links - Desktop -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#services" class="nav-link">Services</a>
                    <a href="#about" class="nav-link">À Propos</a>
                    <a href="#contact" class="nav-link">Contact</a>
                    @auth
                        @if(auth()->user()->role === 'coach')
                            <a href="{{ route('coach.dashboard') }}" class="nav-link">Tableau de bord</a>
                        @else
                            <a href="{{ route('shop') }}" class="nav-link">Boutique</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="nav-link">
                                Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">Connexion</a>
                        <a href="{{ route('register') }}" class="btn-primary">
                            Inscription
                        </a>
                    @endauth
                </div>
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="md:hidden text-gray-300 hover:text-light">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden hidden pb-4">
                <div class="flex flex-col space-y-4">
                    <a href="#services" class="nav-link">Services</a>
                    <a href="#about" class="nav-link">À Propos</a>
                    <a href="#contact" class="nav-link">Contact</a>
                    @auth
                        @if(auth()->user()->role === 'coach')
                            <a href="{{ route('coach.dashboard') }}" class="nav-link">Tableau de bord</a>
                        @else
                            <a href="{{ route('shop') }}" class="nav-link">Boutique</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link">
                                Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">Connexion</a>
                        <a href="{{ route('register') }}" class="btn-primary inline-block">
                            Inscription
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                    // Close mobile menu if open
                    document.getElementById('mobile-menu').classList.add('hidden');
                }
            });
        });
        
        // Hide mobile menu on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                document.getElementById('mobile-menu').classList.add('hidden');
            }
        });
    </script>
</body>
</html> 