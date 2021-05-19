<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are NOT mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'attributes' => 'array',
    ];


    /**
     * Relation to Categories - belongs to many.
     *
     * @return void
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }


    /**
     * Relation to Image - has many.
     *
     * @return void
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }


    /**
     * Relation to ProductType - belongs to.
     *
     * @return void
     */
    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }


    /**
     * Class boot method
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        // delete any images associated with the product being deleted.
        static::deleting(function ($product) {
            $product->images()->delete();
        });
    }
}
