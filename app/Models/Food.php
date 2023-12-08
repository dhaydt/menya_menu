<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Food extends Pivot
{
    use HasFactory;

    protected $table = 'food';

    /**
     * Get the category that owns the Food
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * The topping that belong to the Food
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function topping(): BelongsToMany
    {
        return $this->belongsToMany(Food::class, 'food_toppings', 'food_id', 'topping_id');
    }

    /**
     * Get the price associated with the Food
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
}
