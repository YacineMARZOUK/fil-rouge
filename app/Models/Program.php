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
        'user_id',
        'duration',
        'difficulty_level',
        'status'
    ];

    protected $casts = [
        'duration' => 'integer',
        'difficulty_level' => 'string',
        'status' => 'string'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function getDifficultyLevelFormattedAttribute()
    {
        return match($this->difficulty_level) {
            'beginner' => 'Débutant',
            'intermediate' => 'Intermédiaire',
            'advanced' => 'Avancé',
            default => $this->difficulty_level
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
} 