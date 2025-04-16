<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class Activity extends Model
{
    use HasFactory, Searchable;

    protected $searchable = [
        'name',
        'description',
        'location'
    ];

    protected $fillable = [
        'name',
        'description',
        'date',
        'duration',
        'location',
        'max_participants',
        'price',
        'program_id',
        'coach_id'
    ];

    protected $casts = [
        'date' => 'datetime',
        'max_participants' => 'integer',
        'duration' => 'integer',
        'price' => 'decimal:2'
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'activity_participants')
            ->withTimestamps()
            ->withPivot('status');
    }

    public function getDateFormattedAttribute()
    {
        return $this->date->format('d/m/Y H:i');
    }

    public function getDurationFormattedAttribute()
    {
        $hours = floor($this->duration / 60);
        $minutes = $this->duration % 60;
        
        if ($hours > 0) {
            return $hours . 'h' . ($minutes > 0 ? ' ' . $minutes . 'min' : '');
        }
        return $minutes . 'min';
    }

    public function getParticipantsCountAttribute()
    {
        return $this->participants()->count();
    }

    public function getAvailableSpotsAttribute()
    {
        return $this->max_participants - $this->participants_count;
    }

    public function isFull()
    {
        return $this->participants_count >= $this->max_participants;
    }
} 