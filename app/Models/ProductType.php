<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $guarded= [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public function subcategories()
    {
        $products = $this->products()->with('categories')->get();

        return $products->map(function ($item, $key) {
            return $item->categories->values();
        })->flatten()->unique('name')->values()->all();
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($productType) {
            $productType->image()->delete();
        });
    }
}
