<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Afficher le profil de l'utilisateur
     */
    public function show()
    {
        return view('profile.show', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Mettre à jour le profil de l'utilisateur
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password' => ['nullable', 'required_with:password', 'string'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        // Vérifier le mot de passe actuel si un nouveau mot de passe est fourni
        if ($request->password && !Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Le mot de passe actuel est incorrect.'
            ]);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil mis à jour avec succès.');
    }

    public function form()
    {
        return view('profile.form');
    }

    public function complete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'genre' => 'required|in:homme,femme',
            'age' => 'required|integer|min:10|max:100',
            'taille' => 'required|numeric|min:100|max:250',
            'poids' => 'required|numeric|min:30|max:300',
            'niveau_activite' => 'required|in:sedentaire,leger,modere,actif,tres_actif',
            'objectif_principal' => 'required|in:perte_poids,prise_muscle,maintien,endurance'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Calculer les besoins caloriques
        $besoinsCaloriques = $this->calculerBesoinsCaloriques($request->all());

        // Créer ou mettre à jour les objectifs de l'utilisateur
        $user = Auth::user();
        $user->goals()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'genre' => $request->genre,
                'age' => $request->age,
                'taille' => $request->taille,
                'poids' => $request->poids,
                'niveau_activite' => $request->niveau_activite,
                'objectif_principal' => $request->objectif_principal,
                'besoins_caloriques' => $besoinsCaloriques
            ]
        );

        return redirect()->route('shop')
            ->with('success', 'Votre profil a été mis à jour avec succès.');
    }

    private function calculerBesoinsCaloriques($data)
    {
        // Calcul du métabolisme de base (MB)
        if ($data['genre'] === 'homme') {
            $mb = 88.362 + (13.397 * $data['poids']) + (4.799 * $data['taille']) - (5.677 * $data['age']);
        } else {
            $mb = 447.593 + (9.247 * $data['poids']) + (3.098 * $data['taille']) - (4.330 * $data['age']);
        }

        // Facteur d'activité
        $facteurs_activite = [
            'sedentaire' => 1.2,
            'leger' => 1.375,
            'modere' => 1.55,
            'actif' => 1.725,
            'tres_actif' => 1.9
        ];

        $besoins = $mb * $facteurs_activite[$data['niveau_activite']];

        // Ajustement selon l'objectif
        switch ($data['objectif_principal']) {
            case 'perte_poids':
                $besoins -= 500; // Déficit calorique pour la perte de poids
                break;
            case 'prise_muscle':
                $besoins += 500; // Surplus calorique pour la prise de muscle
                break;
            case 'endurance':
                $besoins += 300; // Légère augmentation pour l'endurance
                break;
            // Pour 'maintien', on garde les besoins calculés
        }

        return round($besoins);
    }
} 