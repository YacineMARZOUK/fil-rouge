@extends('layouts.app')

@section('content')
<!-- Section Héro -->
<div class="relative h-screen">
    <div class="absolute inset-0">
        <img src="{{ asset('images/gym-hero.jpg') }}" alt="Salle de sport" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    </div>
    <div class="relative h-full flex items-center justify-center">
        <div class="text-center text-white px-4">
            <h1 class="text-5xl font-bold mb-6">Transformez votre corps</h1>
            <p class="text-xl mb-8">Commencez votre voyage vers une meilleure version de vous-même</p>
            <button onclick="showGoalModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300">
                Commencer l'amélioration
            </button>
        </div>
    </div>
</div>

<!-- Section Objectifs -->
<div class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Choisissez votre objectif</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('images/weight-loss.jpg') }}" alt="Perte de poids" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4">Perte de poids</h3>
                    <p class="text-gray-600 mb-4">Programmes personnalisés pour atteindre vos objectifs de perte de poids de manière saine et durable.</p>
                    <button onclick="showGoalModal('weight_loss')" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-full transition duration-300">
                        En savoir plus
                    </button>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('images/muscle-gain.jpg') }}" alt="Prise de masse" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4">Prise de masse</h3>
                    <p class="text-gray-600 mb-4">Programmes spécialisés pour développer votre masse musculaire et améliorer votre force.</p>
                    <button onclick="showGoalModal('muscle_gain')" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full transition duration-300">
                        En savoir plus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Objectif -->
<div id="goalModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4">
        <h3 class="text-2xl font-bold mb-6">Quel est votre objectif ?</h3>
        <form id="goalForm" class="space-y-4">
            <div>
                <label class="block text-gray-700 mb-2">Je souhaite :</label>
                <select name="goal" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="weight_loss">Perdre du poids</option>
                    <option value="muscle_gain">Prendre de la masse musculaire</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Votre poids actuel (kg) :</label>
                <input type="number" name="current_weight" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Votre taille (cm) :</label>
                <input type="number" name="height" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Votre âge :</label>
                <input type="number" name="age" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="hideGoalModal()" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Annuler
                </button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Calculer
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function showGoalModal(goal = null) {
    const modal = document.getElementById('goalModal');
    const form = document.getElementById('goalForm');
    
    if (goal) {
        form.querySelector('select[name="goal"]').value = goal;
    }
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function hideGoalModal() {
    const modal = document.getElementById('goalModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
}

document.getElementById('goalForm').addEventListener('submit', function(e) {
    e.preventDefault();
    // Ici, vous pouvez ajouter la logique pour calculer les objectifs
    // et rediriger vers la page appropriée
    hideGoalModal();
});
</script>
@endpush
@endsection 