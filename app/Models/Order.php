<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['toy_id', 'customer_name', 'customer_phone', 'quantity', 'total_price'];

    public function toy()
    {
        return $this->belongsTo(Toy::class);
    }
}