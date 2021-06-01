<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    /**
     * The attributes which are NOT mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Relation to Products - has many.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get properties column from database, unserialize to array
     *
     * @param $value
     * @return Array
     */
    public function getPropertiesAttribute($value)
    {
        return unserialize($value);
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
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('slug', 'like', '%' . $search . '%');
        });
    }
}
