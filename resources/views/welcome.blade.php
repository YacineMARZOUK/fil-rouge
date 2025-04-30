@extends('layouts.home')

@section('content')
<section id="hero" class="min-h-screen flex items-center justify-center relative">
    <!-- Image d'arrière-plan avec superposition -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/home/pexels-photo-791763 1.png') }}" 
             alt="Fitness background" 
             class="w-full h-full object-cover object-center"
        >
        <!-- Superposition sombre avec dégradé -->
        <div class="absolute inset-0 bg-gradient-to-b from-dark/70 via-dark/50 to-dark/90"></div>
    </div>

    <!-- Contenu du hero -->
    <div class="container mx-auto px-4 z-10 text-center">
        <h1 class="text-5xl md:text-7xl font-bold mb-6">
            <span class="text-primary">GAIN</span>ZONE
        </h1>
        <p class="text-xl md:text-2xl mb-8 max-w-2xl mx-auto">
            Transformez votre corps, renforcez votre esprit. 
            Rejoignez la communauté GainZone pour atteindre vos objectifs fitness.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ route('register') }}" class="btn-primary text-lg px-8 py-3">
                Commencer maintenant
            </a>
            <a href="#about" class="text-light hover:text-primary transition duration-300 flex items-center gap-2">
                En savoir plus
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L10 14.586l5.293-5.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Indicateur de défilement -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
        </svg>
    </div>
</section>

<!-- Transform Section -->
<section class="bg-dark py-20">
    <div class="container mx-auto px-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16">
            <!-- Left Content -->
            <div>
                <h2 class="text-5xl font-bold mb-6">
                    <span class="text-primary">Transform</span> Your<br>
                    Fitness Journey
                </h2>
                <p class="text-gray-400 mb-8">
                    Offers customized workout programs designed to help clients
                    achieve their fitness goals, such as weight loss, strength and
                    conditioning, and body shaping
                </p>
            </div>

            <!-- Right Content - GAINZONE Logo -->
            <div class="bg-gray-900 rounded-lg p-8 relative overflow-hidden">
                <div class="text-4xl font-bold text-center relative z-10">
                    <span class="text-white">GAIN</span>
                    <span class="text-primary">ZONE</span>
                    <div class="text-gray-400 text-lg mt-2">PUSH YOUR LIMITS</div>
                </div>
                <!-- Glow Effect -->
                <div class="absolute inset-0 bg-gradient-to-r from-primary/10 to-primary-dark/10 blur-xl"></div>
            </div>
        </div>

        <!-- GYM Section -->
        <div class="mb-16">
            <h3 class="text-4xl font-bold mb-4">GYM</h3>
            <p class="text-gray-400">
                We offer a wide range of state-of-the-art equipment and facilities to help you get in the best shape of your life
            </p>
        </div>

        <!-- Activities Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Zumba -->
            <div class="relative h-[500px] group overflow-hidden rounded-lg">
                <div class="absolute inset-0 bg-gradient-to-t from-dark via-dark/50 to-transparent z-10"></div>
                <img src="{{ asset('images/home/zumba.jpg') }}" 
                     alt="Zumba" 
                     class="w-full h-full object-cover object-center transform transition-transform duration-700 ease-out group-hover:scale-105"
                >
                <div class="absolute bottom-0 left-0 right-0 p-8 z-20 transform transition-transform duration-500 translate-y-2 group-hover:translate-y-0">
                    <h4 class="text-3xl font-bold mb-3 text-primary">ZUMBA</h4>
                    <p class="text-gray-200 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        Dansez et brûlez des calories avec nos cours de Zumba énergiques
                    </p>
                </div>
            </div>

            <!-- Yoga -->
            <div class="relative h-[500px] group overflow-hidden rounded-lg">
                <div class="absolute inset-0 bg-gradient-to-t from-dark via-dark/50 to-transparent z-10"></div>
                <img src="{{ asset('images/home/yoga.jpg') }}" 
                     alt="Yoga" 
                     class="w-full h-full object-cover object-center transform transition-transform duration-700 ease-out group-hover:scale-105"
                >
                <div class="absolute bottom-0 left-0 right-0 p-8 z-20 transform transition-transform duration-500 translate-y-2 group-hover:translate-y-0">
                    <h4 class="text-3xl font-bold mb-3 text-primary">YOGA</h4>
                    <p class="text-gray-200 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        Trouvez votre équilibre intérieur avec nos séances de yoga
                    </p>
                </div>
            </div>

            <!-- Martial Art -->
            <div class="relative h-[500px] group overflow-hidden rounded-lg">
                <div class="absolute inset-0 bg-gradient-to-t from-dark via-dark/50 to-transparent z-10"></div>
                <img src="{{ asset('images/home/martial-art.jpg') }}" 
                     alt="Martial Art" 
                     class="w-full h-full object-cover object-center transform transition-transform duration-700 ease-out group-hover:scale-105"
                >
                <div class="absolute bottom-0 left-0 right-0 p-8 z-20 transform transition-transform duration-500 translate-y-2 group-hover:translate-y-0">
                    <h4 class="text-3xl font-bold mb-3 text-primary">MARTIAL ART</h4>
                    <p class="text-gray-200 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        Développez force et discipline avec nos arts martiaux
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-20 bg-black">
    <div class="container mx-auto px-20">
        <h2 class="text-4xl font-bold text-center mb-16">Nos Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Objectifs Personnalisés -->
            <div class="relative group overflow-hidden rounded-lg">
                <div class="absolute inset-0">
                    <img src="{{ asset('images/home/objectifs.jpg') }}" 
                         alt="Objectifs Personnalisés" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                    >
                    <div class="absolute inset-0 bg-dark/80 group-hover:bg-dark/70 transition-colors duration-500"></div>
                </div>
                <div class="relative p-8 h-full flex flex-col items-center text-center z-10">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Objectifs Personnalisés</h3>
                    <p class="text-gray-300">Définissez vos objectifs et suivez votre progression avec l'aide de nos coachs experts.</p>
                </div>
            </div>

            <!-- Programmes Adaptés -->
            <div class="relative group overflow-hidden rounded-lg">
                <div class="absolute inset-0">
                    <img src="{{ asset('images/home/programme-sport.jpg') }}" 
                         alt="Programmes Adaptés" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                    >
                    <div class="absolute inset-0 bg-dark/80 group-hover:bg-dark/70 transition-colors duration-500"></div>
                </div>
                <div class="relative p-8 h-full flex flex-col items-center text-center z-10">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Programmes Adaptés</h3>
                    <p class="text-gray-300">Des programmes d'entraînement sur mesure pour atteindre vos objectifs efficacement.</p>
                </div>
            </div>

            <!-- Suivi Personnalisé -->
            <div class="relative group overflow-hidden rounded-lg">
                <div class="absolute inset-0">
                    <img src="{{ asset('images/home/téléchargement.jpeg') }}" 
                         alt="Suivi Personnalisé" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                    >
                    <div class="absolute inset-0 bg-dark/80 group-hover:bg-dark/70 transition-colors duration-500"></div>
                </div>
                <div class="relative p-8 h-full flex flex-col items-center text-center z-10">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Suivi Personnalisé</h3>
                    <p class="text-gray-300">Un accompagnement continu pour vous motiver et vous guider vers la réussite.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-20 bg-black">
    <div class="container mx-auto px-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-20">
            <div>
                <h2 class="text-4xl font-bold mb-6">À Propos de GainZone</h2>
                <p class="text-lg mb-6">GainZone est votre partenaire de confiance pour atteindre vos objectifs de fitness. Notre plateforme combine expertise professionnelle et technologie pour vous offrir une expérience d'entraînement unique.</p>
                <ul class="space-y-4">
                    <li class="flex items-center">
                        <span class="text-primary mr-2">✓</span>
                        Coachs certifiés et expérimentés
                    </li>
                    <li class="flex items-center">
                        <span class="text-primary mr-2">✓</span>
                        Programmes personnalisés
                    </li>
                    <li class="flex items-center">
                        <span class="text-primary mr-2">✓</span>
                        Suivi de progression détaillé
                    </li>
                </ul>
            </div>
            <div class="relative h-96">
                <img src="{{ asset('images/home/pexels-photo-3112004 1.png') }}" 
                     alt="À propos de GainZone" 
                     class="w-full h-full object-cover rounded-lg"
                >
                <div class="absolute inset-0 "></div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="relative h-[300px] overflow-hidden">
            <!-- Image d'arrière-plan -->
            <div class="absolute inset-0">
                <img src="{{ asset('images/home/pexels-photo-791763 1.png') }}" 
                     alt="Background" 
                     class="w-full h-full object-cover brightness-50"
                >
            </div>

            <!-- Statistiques superposées -->
            <div class="absolute inset-0 bg-black/30">
                <div class="container mx-auto h-full">
                    <div class="grid grid-cols-4 h-full items-center">
                        <!-- Working Days -->
                        <div class="text-center">
                            <span class="counter text-primary text-5xl font-bold block" data-target="583">0</span>
                            <span class="text-white text-sm uppercase tracking-wider">Working Days</span>
                        </div>

                        <!-- Happy Clients -->
                        <div class="text-center">
                            <span class="counter text-primary text-5xl font-bold block" data-target="2392">0</span>
                            <span class="text-white text-sm uppercase tracking-wider">Happy Clients</span>
                        </div>

                        <!-- Success Stories -->
                        <div class="text-center">
                            <span class="counter text-primary text-5xl font-bold block" data-target="871">0</span>
                            <span class="text-white text-sm uppercase tracking-wider">Success Stories</span>
                        </div>

                        <!-- Successful Stories -->
                        <div class="text-center">
                            <span class="counter text-primary text-5xl font-bold block" data-target="871">0</span>
                            <span class="text-white text-sm uppercase tracking-wider">Successful Stories</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.counter');
            const speed = 200;

            const animateCounter = (counter) => {
                const target = +counter.getAttribute('data-target');
                let count = 0;
                
                const updateCount = () => {
                    const increment = target / speed;
                    
                    if (count < target) {
                        count = Math.ceil(count + increment);
                        counter.innerText = count;
                        setTimeout(updateCount, 1);
                    } else {
                        counter.innerText = target;
                    }
                };

                updateCount();
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counters = entry.target.querySelectorAll('.counter');
                        counters.forEach(animateCounter);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            const statsSection = document.querySelector('.grid-cols-4');
            if (statsSection) {
                observer.observe(statsSection);
            }
        });
    </script>
</section>

<!-- Contact Section -->
<section id="contact" class="py-20 bg-black">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-16">Contactez-nous</h2>
        <div class="max-w-3xl mx-auto">
            <form class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-primary mb-2">Nom</label>
                    <input type="text" id="name" name="name" class="w-full px-4 py-2 bg-white rounded-lg focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label for="email" class="block text-sm text-primary font-medium mb-2">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-2 bg-white rounded-lg focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label for="message" class="block text-sm text-primary font-medium mb-2">Message</label>
                    <textarea id="message" name="message" rows="4" class="w-full px-4 py-2 bg-white rounded-lg focus:ring-2 focus:ring-primary"></textarea>
                </div>
                <button type="submit" class="btn-primary text-lg">
                    Envoyer
                </button>
            </form>
        </div>
    </div>
</section>

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
@endsection 