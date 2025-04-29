<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity_participant extends Model
{
    use HasFactory;

    protected $table = 'activity_participants';

    protected $fillable = [
        'activity_id',
        'user_id'
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 