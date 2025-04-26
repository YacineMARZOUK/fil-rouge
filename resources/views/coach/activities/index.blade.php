@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mt-8">
        <div class="bg-black shadow rounded-lg border border-[#5B5B5B]">
            <div class="px-6 py-4 flex flex-col sm:flex-row justify-between items-center border-b border-[#5B5B5B]">
                <h3 class="text-lg font-semibold text-white mb-4 sm:mb-0">Mes Activités</h3>
                <a href="{{ route('coach.activities.create') }}" class="bg-[#CDFB47] hover:bg-[#CDFB47]/80 text-black px-4 py-2 rounded-lg inline-flex items-center transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Nouvelle Activité
                </a>
            </div>

            <div class="p-6">
                <!-- Formulaire de recherche et filtrage -->
                <form method="GET" action="{{ route('coach.activities.index') }}" class="mb-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4">
                        <input type="text" name="search" class="bg-black border border-[#5B5B5B] text-white rounded-lg px-4 py-2 focus:border-[#CDFB47] focus:ring-1 focus:ring-[#CDFB47] outline-none transition-colors" 
                               placeholder="Rechercher..." value="{{ request('search') }}">

                        <input type="date" name="start_date" class="bg-black border border-[#5B5B5B] text-white rounded-lg px-4 py-2 focus:border-[#CDFB47] focus:ring-1 focus:ring-[#CDFB47] outline-none transition-colors" 
                               value="{{ request('start_date') }}">

                        <div class="hidden md:block"></div> <!-- Placeholder pour alignement -->

                        <button type="submit" class="bg-[#CDFB47] hover:bg-[#CDFB47]/80 text-black px-4 py-2 rounded-lg w-full flex justify-center items-center transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            Filtrer
                        </button>
                    </div>
                </form>

                <!-- Tableau des activités -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#5B5B5B] text-sm">
                        <thead class="bg-black">
                            <tr>
                                <th class="px-6 py-3 text-left font-medium text-[#CDFB47]">
                                    <a href="{{ route('coach.activities.index', array_merge(request()->all(), [
                                        'sort_by' => 'name',
                                        'sort_direction' => request('sort_direction') == 'asc' ? 'desc' : 'asc'
                                    ])) }}" class="flex items-center gap-1 hover:text-[#CDFB47]/80 transition-colors">
                                        Nom
                                        @if(request('sort_by') == 'name')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                @if(request('sort_direction') == 'asc')
                                                <polyline points="18 15 12 9 6 15"></polyline>
                                                @else
                                                <polyline points="6 9 12 15 18 9"></polyline>
                                                @endif
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                                
                                <th class="hidden md:table-cell px-6 py-3 text-left font-medium text-[#CDFB47]">Date</th>
                                <th class="px-6 py-3 text-left font-medium text-[#CDFB47]">Description</th>
                                <th class="px-6 py-3 text-left font-medium text-[#CDFB47]">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#5B5B5B] bg-black">
                            @forelse($activities as $activity)
                                <tr class="hover:bg-[#000000]/80 transition-colors">
                                    <td class="px-6 py-4 text-white">
                                        <div>{{ $activity->name }}</div>
                                        <!-- Informations visibles uniquement sur mobile -->
                                        <div class="md:hidden mt-1">
                                            <div class="text-sm text-[#5B5B5B]">
                                                {{ $activity->date->format('d/m/Y H:i') }}
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="hidden md:table-cell px-6 py-4 text-white">{{ $activity->date->format('d/m/Y H:i') }}</td>
                                    <td class="hidden md:table-cell px-6 py-4 text-white">{{ $activity->description }}</td>
                                    
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('coach.activities.show', $activity) }}" 
                                               class="p-2 bg-[#CDFB47] text-black rounded-full hover:bg-[#CDFB47]/80 transition-all duration-300 transform hover:scale-110" title="Voir">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </a>
                                            <a href="{{ route('coach.activities.edit', $activity) }}" 
                                               class="p-2 bg-[#CDFB47] text-black rounded-full hover:bg-[#CDFB47]/80 transition-all duration-300 transform hover:scale-110" title="Modifier">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('coach.activities.destroy', $activity) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette activité ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-500 text-white rounded-full hover:bg-red-600 transition-all duration-300 transform hover:scale-110" title="Supprimer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-[#5B5B5B]">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-4 text-[#5B5B5B]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <path d="M8 15h8M9 9h.01M15 9h.01"></path>
                                            </svg>
                                            <p class="text-lg text-white">Aucune activité trouvée</p>
                                            <p class="text-sm mt-2">Créez votre première activité en cliquant sur "Nouvelle Activité"</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex justify-center">
                    {{ $activities->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Style personnalisé pour la pagination */
    .pagination {
        display: flex;
        list-style: none;
        gap: 0.5rem;
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .pagination li a, .pagination li span {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
        background-color: #000000;
        color: #FFFFFF;
        border: 1px solid #5B5B5B;
        transition: all 0.3s ease;
    }
    
    .pagination li a:hover {
        background-color: #1a1a1a;
        border-color: #CDFB47;
    }
    
    .pagination li.active span {
        background-color: #CDFB47;
        color: #000000;
        border-color: #CDFB47;
    }

    /* Animation pour les boutons d'action */
    .p-2.bg-[#CDFB47], .p-2.bg-red-500 {
        transform: scale(1);
        transition: transform 0.2s ease, background-color 0.3s ease;
    }
    
    .p-2.bg-[#CDFB47]:hover, .p-2.bg-red-500:hover {
        transform: scale(1.15);
    }
</style>
@endpush

@push('scripts')
<script>
    // Animation pour les messages de succès/erreur
    document.addEventListener('DOMContentLoaded', function() {
        // Effet de survol pour les lignes du tableau
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.classList.add('bg-[#111111]');
            });
            row.addEventListener('mouseleave', function() {
                if (!this.classList.contains('hover:bg-[#000000]/80')) {
                    this.classList.remove('bg-[#111111]');
                }
            });
        });

        // Confirmation de suppression personnalisée
        const deleteForms = document.querySelectorAll('form[onsubmit]');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const activityName = this.closest('tr').querySelector('td:first-child').textContent.trim();
                return confirm(`Êtes-vous sûr de vouloir supprimer l'activité "${activityName}" ?`);
            });
        });
    });
</script>
@endpush