<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{   
    use HasFactory;

    protected $fillable = ['customer_name', 'price_total'];
    
    public function orders () {
        return $this->belongsToMany(Order::class);
    }
}
