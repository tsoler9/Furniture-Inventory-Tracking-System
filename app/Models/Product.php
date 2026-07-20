<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'sku', 'category', 'unit_price', 'quantity_on_hand', 'reorder_level', 'status'];

    public function transactions()
    {
        return $this->hasMany(InventoryTransaction::class);
    }
}
