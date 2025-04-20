<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'total_price'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'total_price' => 'decimal:2'
    ];

    /**
     * Obtenir la commande associée
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Obtenir le produit associé
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
} 