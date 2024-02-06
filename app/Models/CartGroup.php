<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CartGroup extends Model
{
    use HasFactory;

    protected $table = 'cart_groups';
    protected $fillable = [
        'group_id',
        'order_type',
        'payment_type',
        'tax',
        'service_charge',
        'total',
        'note',
        'table_id',
        'pembulatan'
    ];

    /**
     * Get all of the cart for the CartGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cart(): HasMany
    {
        return $this->hasMany(Cart::class, 'group_id', 'group_id');
    }
}
