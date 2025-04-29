<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\UserGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    public function recommanderProgrammes()
{
    $user = Auth::user();
    $userGoal = UserGoal::where('user_id', $user->id)->first();

    if (!$userGoal) {
        return view('programs.recommended', [
            'programs' => collect([]),
            'error' => 'Veuillez compléter votre profil pour obtenir des recommandations personnalisées.'
        ]);
    }

    // Déduire le niveau de difficulté selon le niveau d'activité
    $difficulty = match ($userGoal->niveau_activite) {
        'sedentaire' => 'beginner',
        'modere' => 'intermediate',
        'actif', 'tres_actif' => 'advanced',
        default => 'beginner'
    };

    // Récupération des programmes recommandés
    $programs = Program::where('user_id', $user->id) // pour lier uniquement aux programmes qui lui sont liés, si besoin
        
        ->where('objectif_cible', $userGoal->objectif_principal)
        
        ->paginate(6);

    return view('programs.recommended', [
        'programs' => $programs
    ]);
}


    public function assignerProgrammeAutomatique(Program $program)
    {
        $user = Auth::user();
        
        if ($user->programs()->where('program_id', $program->id)->exists()) {
            return back()->with('error', 'Vous êtes déjà inscrit à ce programme.');
        }

        $user->programs()->attach($program->id);
        return back()->with('success', 'Programme assigné avec succès !');
    }
    public function afficherDetails(Program $program)
{
    return view('programs.details', compact('program'));
}

} 