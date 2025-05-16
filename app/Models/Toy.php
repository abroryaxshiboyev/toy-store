<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toy extends Model
{
    protected $fillable = ['name', 'description', 'price', 'image'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}