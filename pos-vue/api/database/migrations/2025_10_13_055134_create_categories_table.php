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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            // ক্যাটেগরি কোড: অবশ্যই ইউনিক হবে, কন্ট্রোলারে ভ্যালিডেশনের জন্য
            $table->string('category_code', 50)->unique();

            // ক্যাটেগরি নাম
            $table->string('category_name');

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
        Schema::dropIfExists('categories');
    }
};