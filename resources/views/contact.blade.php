@extends('layouts.app')

@section('content')
<div class="bg-dark">
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl font-bold mb-8 text-center text-white">Contactez-nous</h1>
            
            <div class="bg-gray-900 rounded-lg p-8 shadow-xl">
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-400">Nom</label>
                        <input type="text" name="name" id="name" required 
                               class="input-field mt-1 block w-full" 
                               placeholder="Votre nom">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-400">Email</label>
                        <input type="email" name="email" id="email" required 
                               class="input-field mt-1 block w-full" 
                               placeholder="votre@email.com">
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-400">Sujet</label>
                        <input type="text" name="subject" id="subject" required 
                               class="input-field mt-1 block w-full" 
                               placeholder="Sujet de votre message">
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-400">Message</label>
                        <textarea name="message" id="message" rows="6" required 
                                  class="input-field mt-1 block w-full" 
                                  placeholder="Votre message"></textarea>
                    </div>

                    <div>
                        <button type="submit" class="btn-primary w-full">
                            Envoyer le message
                        </button>
                    </div>
                </form>

                <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="text-center">
                        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-primary mx-auto mb-4">
                            <svg class="w-6 h-6 text-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-white mb-2">Téléphone</h3>
                        <p class="text-gray-400">+33 1 23 45 67 89</p>
                    </div>

                    <div class="text-center">
                        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-primary mx-auto mb-4">
                            <svg class="w-6 h-6 text-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-white mb-2">Email</h3>
                        <p class="text-gray-400">contact@gainzone.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 