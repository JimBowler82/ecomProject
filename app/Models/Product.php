<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'attributes' => 'array',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            $product->images()->delete();
        });
    }
}
