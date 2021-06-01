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
        'name', 'slug',
    ];

    /**
     * Relation to Products - belongs to many.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    /**
     * Relation to Image - has one.
     *
     *@return \Illuminate\Database\Eloquent\Relations\HasOne
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
     * Get the total number of all products assigned to a category plus all from
     * any nested categories.
     *
     * @return Integer
     */
    public function getTotalNumberOfNestedProductsAttribute()
    {
        return $this
            ->descendants()
            ->withCount('products')
            ->get()
            ->reduce(function ($carry, $item) {

                return $carry + $item->products_count;

            }, $this->products_count);

    }

    /**
     * Scope - Filter
     *
     * @param $query
     * @param Array $filters
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query
                ->where('slug', 'like', '%' . $search . '%');
        });
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
