@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mt-8">
        <div class="bg-black shadow rounded-lg border border-[#5B5B5B]">
            <div class="px-6 py-4 flex flex-col sm:flex-row justify-between items-center border-b border-[#5B5B5B]">
                <h3 class="text-lg font-semibold text-white mb-4 sm:mb-0">Activités disponibles</h3>
            </div>

            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#5B5B5B] text-sm">
                        <thead class="bg-black">
                            <tr>
                                <th class="px-6 py-3 text-left font-medium text-[#CDFB47]">Nom</th>
                                <th class="hidden md:table-cell px-6 py-3 text-left font-medium text-[#CDFB47]">Date</th>
                                <th class="hidden md:table-cell px-6 py-3 text-left font-medium text-[#CDFB47]">Participants</th>
                                <th class="px-6 py-3 text-left font-medium text-[#CDFB47]">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#5B5B5B] bg-black">
                            @forelse($activities as $activity)
                                <tr class="hover:bg-[#000000]/80 transition-colors">
                                    <td class="px-6 py-4 text-white">
                                        {{ $activity->name }}
                                    </td>
                                    <td class="hidden md:table-cell px-6 py-4 text-white">
                                        {{ $activity->date->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="hidden md:table-cell px-6 py-4 text-white">
                                        {{ $activity->participants_count }} / {{ $activity->max_participants }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('client.activities.show', $activity->id) }}" 
                                               class="bg-[#CDFB47] text-black px-3 py-2 rounded-lg hover:bg-[#CDFB47]/80 transition">
                                                Détails
                                            </a>
                                            <form action="{{ route('client.activities.join', $activity->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-blue-500 text-white px-3 py-2 rounded-lg hover:bg-blue-600 transition">
                                                    Rejoindre
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-[#5B5B5B]">
                                        Aucune activité disponible.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex justify-center">
                    {{ $activities->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
