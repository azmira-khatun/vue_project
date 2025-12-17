<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'category_code',
        'category_name',
    ];

    /**
     * Relationship: A category has many products
     * (যদি Product model থাকে)
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
