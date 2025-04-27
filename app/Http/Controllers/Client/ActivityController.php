<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Afficher toutes les activités disponibles
     */
    public function index()
    {
        $activities = Activity::with('participants')->latest()->paginate(10);
        return view('client.activities.index', compact('activities'));
    }

    /**
     * Afficher les détails d'une activité
     */
    public function show(Activity $activity)
    
    {
        $activity->load(['coach', 'participants']);
        return view('client.activities.show', compact('activity'));
    }

    /**
     * Joindre une activité
     */
    public function join(Activity $activity)
    {
        $user = Auth::user(); // Récupérer l'utilisateur connecté

        // Vérifier si l'utilisateur est déjà inscrit
        if ($activity->participants()->where('user_id', $user->id)->exists()) {
            return redirect()->route('client.activities.index')
                ->with('error', 'Vous êtes déjà inscrit à cette activité.');
        }

        // Vérifier s'il reste des places
        if ($activity->isFull()) {
            return redirect()->route('client.activities.index')
                ->with('error', 'Cette activité est complète.');
        }

        // Ajouter l'utilisateur à l'activité
        $activity->participants()->attach($user->id);

        return redirect()->route('client.activities.index')
            ->with('success', 'Vous avez rejoint l\'activité : ' . $activity->name);
    }
}
