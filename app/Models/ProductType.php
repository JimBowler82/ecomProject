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
    protected $guarded= [];


    /**
     * Relation to Products - has many.
     *
     * @return void
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
