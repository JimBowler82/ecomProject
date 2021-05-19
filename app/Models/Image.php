<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    /**
     * The attributes that are NOT mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * Relation to Product - belongs to.
     *
     * @return void
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    
    /**
     * Relation to Category - belongs to.
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
