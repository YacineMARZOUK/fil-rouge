<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'type',
        'price',
        'quantity',
        'image'
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer'
    ];

    /**
     * Obtenir le libellé du type de produit
     */
    public function getTypeLabelAttribute()
    {
        return [
            'nutrition' => 'Nutrition',
            'vetement' => 'Vêtement',
            'accessoire' => 'Accessoire'
        ][$this->type] ?? $this->type;
    }

    /**
     * Obtenir le prix formaté avec le symbole de l'euro
     */
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2, ',', ' ') . ' €';
    }

    /**
     * Obtenir l'ancien prix formaté avec le symbole de l'euro
     */
    public function getFormattedOldPriceAttribute()
    {
        return $this->old_price ? number_format($this->old_price, 2, ',', ' ') . ' €' : null;
    }

    /**
     * Calculer le pourcentage de réduction
     */
    public function getDiscountPercentageAttribute()
    {
        if (!$this->old_price) return null;
        return round((($this->old_price - $this->price) / $this->old_price) * 100);
    }
} 