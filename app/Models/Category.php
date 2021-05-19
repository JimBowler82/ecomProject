<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use HasFactory;
    use NodeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
    ];


    /**
     * Relation to Products - belongs to many.
     *
     * @return void
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }


    /**
     * Relation to Image - has one.
     *
     * @return void
     */
    public function image()
    {
        return $this->hasOne(Image::class);
    }


    /**
     * Get the full slug path based on ancestors.
     *
     * @return string
     */
    public function getFullSlugPathAttribute(): string
    {
        $slugs = $this->ancestors->pluck('slug')->toArray();
        $slugs[] = $this->slug;
        return '/' . implode('/', $slugs);
    }


    /**
     * Get the path to the parent of the category.
     *
     * @return string
     */
    public function getParentPathAttribute()
    {
        $slugs = $this->ancestors->pluck('slug')->toArray();
        return '/' . implode('/', $slugs);
    }

    
    /**
     * Class boot method
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        // Delete any images associated with the category being deleted.
        static::deleting(function ($category) {
            $category->image()->delete();
        });
    }
}
