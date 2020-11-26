<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductSale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class)->using(ProductSale::class)->withPivot(['quantity', 'tax', 'discount', 'discount_type_id', 'tax_type_id', 'id']);
    }

    public function getTotalAttribute()
    {
        return $this->products->map(function ($p) {
            return $p->total;
        })->sum();
    }

    public function getQuantityAttribute()
    {
        return $this->products->count();
    }
}
