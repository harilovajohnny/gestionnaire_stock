<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['quantity', 'price'];

    public function product () {
        return $this->belongsTo(Product::class);
    }

    public function invoices () {
        return $this->belongsToMany(Invoice::class);
    }
}
