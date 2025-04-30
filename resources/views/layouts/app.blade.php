<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'GainZone') }}</title>
    
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
                @apply bg-dark text-light font-['Inter'];
            }
        }
        
        @layer components {
            .btn-primary {
                @apply bg-primary text-dark font-semibold px-6 py-2 rounded-full hover:bg-primary-dark transition-all duration-300;
            }
            
            .nav-link {
                @apply text-gray-300 hover:text-light transition duration-300;
            }

            .card {
                @apply bg-gray-900 rounded-lg p-6 border border-gray-800 hover:border-primary/50 transition-all duration-300;
            }

            .input-field {
                @apply bg-gray-900 border border-gray-800 rounded-lg px-4 py-2 text-light focus:outline-none focus:border-primary transition-all duration-300;
            }

            .section-title {
                @apply text-4xl font-bold mb-8 text-center;
            }

            .page-header {
                @apply py-12 bg-gray-900 mb-12;
            }
        }
    </style>
    <style>
        .message-alert {
            transition: opacity 0.5s ease-in-out;
        }
        
        /* Styles spécifiques pour la navbar */
        .navbar-fixed {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 9999;
            background-color: rgba(0, 0, 0, 0.95);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Style pour le menu déroulant */
        .dropdown-menu {
            background-color: #000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Assurer que le contenu principal commence après la navbar */
        main {
            padding-top: 5rem;
        }

        /* Styles pour le menu mobile */
        #mobile-menu {
            background-color: rgba(0, 0, 0, 0.95);
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen">
    <!-- Navigation -->
    <nav class="navbar-fixed">
        <div class="container mx-auto px-10">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-2xl font-bold z-50 pl-8">
                    <span class="text-white">GAIN</span><span class="text-primary">ZONE</span>
                </a>
                
                <!-- Navigation Links - Desktop -->
                <div class="hidden md:flex items-center space-x-8 px-10">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">Tableau de bord</a>
                            <a href="{{ route('admin.products.index') }}" class="nav-link">Produits</a>
                            <a href="{{ route('admin.users.index') }}" class="nav-link">Utilisateurs</a>
                        @elseif(auth()->user()->role === 'coach')
                            <a href="{{ route('coach.dashboard') }}" class="nav-link">Tableau de bord</a>
                            <a href="{{ route('coach.programs.index') }}" class="nav-link">Programmes</a>
                            <a href="{{ route('coach.activities.index') }}" class="nav-link">Activités</a>
                        @else
                            <a href="{{ route('shop') }}" class="nav-link">Boutique</a>
                            <a href="{{ route('cart.index') }}" class="nav-link">Panier</a>
                            <a href="{{ route('programs.recommendations') }}" class="nav-link">Programmes Recommandés</a>
                            <a href="{{ route('client.activities.index') }}" class="nav-link">Activités</a>
                        @endif
                        <a href="{{ route('contact') }}" class="nav-link">Contact</a>

                        <!-- User Menu -->
                        <div class="relative group ">
                            <button class="nav-link flex items-center">
                                Mon Compte
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 dropdown-menu rounded-lg shadow-xl py-2 hidden group-hover:block">
                                <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm nav-link">Profil</a>
                                
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm nav-link">Tableau de bord</a>
                                    <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 text-sm nav-link">Gérer les produits</a>
                                    <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-sm nav-link">Gérer les utilisateurs</a>
                                @elseif(auth()->user()->role === 'coach')
                                    <a href="{{ route('coach.dashboard') }}" class="block px-4 py-2 text-sm nav-link">Tableau de bord</a>
                                    <a href="{{ route('coach.activities.create') }}" class="block px-4 py-2 text-sm nav-link">Ajouter une activité</a>
                                @else
                                    <a href="{{ route('cart.index') }}" class="block px-4 py-2 text-sm nav-link">Mon panier</a>
                                    <a href="{{ route('programs.recommendations') }}" class="block px-4 py-2 text-sm nav-link">Programmes Recommandés</a>
                                @endif

                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm nav-link">
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('shop') }}" class="nav-link">Boutique</a>
                        <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                        <a href="{{ route('login') }}" class="nav-link">Connexion</a>
                        <a href="{{ route('register') }}" class="btn-primary">Inscription</a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="md:hidden text-gray-300 hover:text-white z-50">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden hidden pb-4">
                <div class="flex flex-col space-y-4">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">Tableau de bord</a>
                            <a href="{{ route('admin.products.index') }}" class="nav-link">Produits</a>
                            <a href="{{ route('admin.users.index') }}" class="nav-link">Utilisateurs</a>
                        @elseif(auth()->user()->role === 'coach')
                            <a href="{{ route('coach.dashboard') }}" class="nav-link">Tableau de bord</a>
                            <a href="{{ route('coach.programs.index') }}" class="nav-link">Programmes</a>
                            <a href="{{ route('coach.activities.index') }}" class="nav-link">Activités</a>
                        @else
                            <a href="{{ route('shop') }}" class="nav-link">Boutique</a>
                            <a href="{{ route('cart.index') }}" class="nav-link">Panier</a>
                            <a href="{{ route('programs.recommendations') }}" class="nav-link">Programmes Recommandés</a>
                        @endif
                        <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                        <a href="{{ route('profile') }}" class="nav-link">Profil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link w-full text-left">
                                Déconnexion
                            </button>
                        </form>
                @else
                        <a href="{{ route('shop') }}" class="nav-link">Boutique</a>
                        <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                        <a href="{{ route('login') }}" class="nav-link">Connexion</a>
                        <a href="{{ route('register') }}" class="btn-primary inline-block">Inscription</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main >
        @if($errors->any())
            <div class="message-alert fixed top-24 right-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-black py-12 mt-20 pl-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 px-10">
                <div>
                    <h3 class="text-xl font-bold mb-4">
                        <span class="text-white">GAIN</span><span class="text-primary">ZONE</span>
                    </h3>
                    <p class="text-gray-400">Votre partenaire fitness de confiance</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Liens Rapides</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('shop') }}" class="nav-link">Boutique</a></li>
                        @auth
                            @if(auth()->user()->role === 'coach')
                                <li><a href="{{ route('coach.programs.index') }}" class="nav-link">Programmes</a></li>
                                <li><a href="{{ route('coach.activities.index') }}" class="nav-link">Activités</a></li>
                            @endif
                        @endauth
                        <li><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
                    </ul>
                </div>
                <div class="pl-">
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>contact@gainzone.com</li>
                        <li>+33 1 23 45 67 89</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Suivez-nous</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-gray-800 text-center text-gray-400">
                <p>&copy; 2024 GainZone. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
        
        // Hide mobile menu on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                document.getElementById('mobile-menu').classList.add('hidden');
            }
        });

        // Modifier le script pour cibler uniquement les messages d'alerte
        document.addEventListener('DOMContentLoaded', function() {
            const messages = document.querySelectorAll('.message-alert');
            messages.forEach(message => {
                setTimeout(() => {
                    message.style.opacity = '0';
                    setTimeout(() => message.remove(), 500);
                }, 3000);
            });
        });
    </script>
    @stack('scripts')
</body>
</html> 