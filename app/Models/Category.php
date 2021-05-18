<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use HasFactory;
    use NodeTrait;

    protected $fillable = ['name', 'slug'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    /*
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
}
