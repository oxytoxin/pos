<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\Brand;
use App\Models\Image;
use App\Models\Category;
use App\Models\ProductSale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class)->using(ProductSale::class)->withPivot(['quantity', 'tax', 'discount', 'discount_type_id', 'tax_type_id', 'id']);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function getPriceAttribute($value)
    {
        return $value / 100;
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getTotalAttribute()
    {
        return $this->price * $this->pivot->quantity;
    }

    public function scopeWithImageUrl($query)
    {
        $query->addSelect(['image_url' => Image::select('url')->whereColumn('imageable_id', 'products.id')->where('imageable_type', 'App\\Models\\Product')->limit(1)]);
    }
    public function scopeWithBrandName($query)
    {
        $query->addSelect(['brand_name' => Brand::select('name')->whereColumn('id', 'brand_id')->limit(1)]);
    }
}
