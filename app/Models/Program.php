<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class Program extends Model
{
    use HasFactory, Searchable;

    protected $searchable = [
        'name',
        'description',
        'difficulty_level',
        'status'
    ];

    protected $fillable = [
        'name',
        'description',
        'duration',
        'difficulty',
        'objectif_cible',
        'status',
        'coach_id',
        'user_id'
    ];

    protected $casts = [
        'duration' => 'integer',
        'difficulty' => 'string',
        'status' => 'string',
        'objectif_cible' => 'string'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function getDifficultyLevelFormattedAttribute()
    {
        return match($this->difficulty) {
            'beginner' => 'Débutant',
            'intermediate' => 'Intermédiaire',
            'advanced' => 'Avancé',
            default => $this->difficulty
        };
    }

    public function getStatusFormattedAttribute()
    {
        return match($this->status) {
            'draft' => 'Brouillon',
            'active' => 'Actif',
            'completed' => 'Terminé',
            'cancelled' => 'Annulé',
            default => $this->status
        };
    }

    public function getDurationFormattedAttribute()
    {
        return $this->duration . ' semaines';
    }

    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'program_user')
                    ->withTimestamps();
    }
} 