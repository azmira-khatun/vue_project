<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 'units' নামে একটি টেবিল তৈরি করা হলো
        Schema::create('units', function (Blueprint $table) {
            // আইডি (প্রাইমারি কী)
            $table->id();

            // ইউনিটের নাম: স্ট্রিং, সর্বোচ্চ ২৫৫ ক্যারেক্টার, এবং প্রতিটি নাম ইউনিক হতে হবে (UnitController এ ব্যবহৃত ইউনিক ভ্যালিডেশনের জন্য)
            $table->string('name')->unique();

            // অন্যান্য ফিল্ড যদি থাকে (যেমন: symbol)
            // $table->string('symbol', 50)->nullable(); 

            // created_at এবং updated_at টাইমস্ট্যাম্প যোগ করা হলো
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
};