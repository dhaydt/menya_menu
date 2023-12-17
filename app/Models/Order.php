<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    public $incrementing = false; 

    protected $fillable = [
        'user_id',
        'table_id',
        'payment_method',
        'payment_status',
        'payment_type',
        'order_status',
        'order_type',
        'customer_name',
        'customer_phone',
        'tax',
        'service_charge',
        'total',
        'outlet_id',
        'note',
        'on_going',
    ];

    /**
     * Get all of the detail for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detail(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    /**
     * Get the table that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class, 'table_id', 'id');
    }
}
