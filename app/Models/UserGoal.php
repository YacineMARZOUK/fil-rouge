<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGoal extends Model
{
    use HasFactory;

    protected $table = 'user_goals';

    protected $fillable = [
        'user_id',
        'goal',
        'age',
        'sexe',
        'taille',
        'poids',
        'niveau_activite',
        'objectif_principal'
    ];

    protected $casts = [
        'age' => 'integer',
        'taille' => 'integer',
        'poids' => 'decimal:2',
        'sexe' => 'string',
        'niveau_activite' => 'string',
        'objectif_principal' => 'string'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function getPoidsFormattedAttribute()
    {
        return number_format($this->poids, 2) . ' kg';
    }

    public function getTailleFormattedAttribute()
    {
        return $this->taille . ' cm';
    }

    public function getNiveauActiviteFormattedAttribute()
    {
        return match($this->niveau_activite) {
            'sedentaire' => 'Sédentaire',
            'modere' => 'Modéré',
            'actif' => 'Actif',
            default => $this->niveau_activite
        };
    }

    public function getObjectifPrincipalFormattedAttribute()
    {
        return match($this->objectif_principal) {
            'perte_poids' => 'Perte de poids',
            'prise_masse' => 'Prise de masse',
            default => $this->objectif_principal
        };
    }
} 