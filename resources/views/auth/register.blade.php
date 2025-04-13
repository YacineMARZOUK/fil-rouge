    @extends('layouts.app')

    @section('content')
    <div class="min-h-screen bg-black py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-black rounded-lg p-6">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-4xl font-bold text-[#CDFB47]">Mes Activités</h1>
                    <a href="{{ route('coach.activities.create') }}" 
                    class="bg-[#CDFB47] text-black px-4 py-2 rounded-lg text-lg font-semibold hover:bg-[#5B5B5B] hover:text-[#CDFB47] transition-all duration-300">
                        <i class="fas fa-plus"></i> Nouvelle Activité
                    </a>
                </div>

                <!-- Formulaire de recherche et filtrage -->
                <form method="GET" action="{{ route('coach.activities.index') }}" class="mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <div>
                            <input type="text" name="search" 
                                class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300"
                                placeholder="Rechercher..." value="{{ request('search') }}">
                        </div>
                        <div>
                            <input type="date" name="start_date" 
                                class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300"
                                value="{{ request('start_date') }}" placeholder="Date début">
                        </div>
                        <div>
                            <input type="date" name="end_date" 
                                class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300"
                                value="{{ request('end_date') }}" placeholder="Date fin">
                        </div>
                        <div>
                            <!-- Space for additional filter -->
                        </div>
                        <div>
                            <button type="submit" 
                                    class="w-full bg-[#CDFB47] text-black px-4 py-3 rounded-lg font-semibold hover:bg-[#5B5B5B] hover:text-[#CDFB47] transition-all duration-300">
                                <i class="fas fa-search"></i> Filtrer
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Tableau des activités -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#5B5B5B]">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-[#CDFB47] font-medium text-lg tracking-wider">
                                    <a href="{{ route('coach.activities.index', array_merge(request()->all(), [
                                        'sort_by' => 'name',
                                        'sort_direction' => request('sort_direction') == 'asc' ? 'desc' : 'asc'
                                    ])) }}" class="flex items-center">
                                        Nom
                                        @if(request('sort_by') == 'name')
                                            <i class="fas fa-sort-{{ request('sort_direction') == 'asc' ? 'up' : 'down' }} ml-1"></i>
                                        @endif
                                    </a>
                                </th>
                                <th class="px-6 py-3 text-left text-[#CDFB47] font-medium text-lg tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-[#CDFB47] font-medium text-lg tracking-wider">Durée</th>
                                <th class="px-6 py-3 text-left text-[#CDFB47] font-medium text-lg tracking-wider">Participants</th>
                                <th class="px-6 py-3 text-left text-[#CDFB47] font-medium text-lg tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#5B5B5B]">
                            @forelse($activities as $activity)
                                <tr class="hover:bg-[#1A1A1A] transition-colors duration-200">
                                    <td class="px-6 py-4 text-white">{{ $activity->name }}</td>
                                    <td class="px-6 py-4 text-white">{{ $activity->date->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4 text-white">{{ $activity->duration }} min</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 bg-[#1A1A1A] text-[#CDFB47] rounded-full">
                                            {{ $activity->participants->count() }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 flex space-x-2">
                                        <a href="{{ route('coach.activities.show', $activity) }}" 
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded transition-colors duration-200">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('coach.activities.edit', $activity) }}" 
                                        class="bg-[#CDFB47] hover:bg-[#5B5B5B] text-black hover:text-[#CDFB47] px-3 py-1 rounded transition-colors duration-200">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('coach.activities.destroy', $activity) }}" 
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition-colors duration-200"
                                                    onclick="return confirm('Êtes-vous sûr ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                        Aucune activité trouvée
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    <div class="text-[#CDFB47]">
                        {{ $activities->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection