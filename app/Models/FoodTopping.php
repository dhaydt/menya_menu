<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodTopping extends Model
{
    use HasFactory;

    protected $table = 'food_toppings';

    public function topping(): BelongsTo
    {
        return $this->belongsTo(Food::class, 'topping_id', 'id');
    }

    /**
     * Get the food that owns the FoodTopping
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class, 'food_id', 'id');
    }
}
