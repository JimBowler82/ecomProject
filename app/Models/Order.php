<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
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
        'line_items' => 'array',
        'address' => 'array',
    ];

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
                ->where('customer_name', 'like', '%' . $search . '%')
                ->orWhere('customer_email', 'like', '%' . $search . '%')
                ->orWhere('session_id', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%')
                ->orWhere('payment_intent', 'like', '%' . $search . '%');

        });

        $query->when($filters['date_search'] ?? false, function ($query, $search) {
            return $query
                ->whereDate('created_at', $search);

        });

    }
}
