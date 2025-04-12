<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'price',
        'quantity',
        'image'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer'
    ];

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2, ',', ' ') . ' €';
    }

    public function getTypeLabelAttribute()
    {
        return match($this->type) {
            'nutrition' => 'Nutrition',
            'vetement' => 'Vêtement',
            'accessoire' => 'Accessoire',
            default => 'Inconnu'
        };
    }
} 