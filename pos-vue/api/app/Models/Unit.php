<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    // টেবিলের নাম (ঐচ্ছিক, যদি নাম 'units' হয়)
    // protected $table = 'units';

    /**
     * The attributes that are mass assignable.
     * Controller-এ mass assignment ব্যবহার করার জন্য 'name' ফিল্ডটিকে fillable করতে হবে।
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        // অন্যান্য ফিল্ড এখানে যোগ করুন
        // 'symbol',
    ];

    /**
     * The attributes that should be cast.
     * * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ভবিষ্যতে এই ইউনিটের অধীনে থাকা Products এর সাথে সম্পর্ক (রিলেশনশিপ) স্থাপন করতে পারেন
    /*
    public function products()
    {
        return $this->hasMany(Product::class, 'unit_id');
    }
    */
}