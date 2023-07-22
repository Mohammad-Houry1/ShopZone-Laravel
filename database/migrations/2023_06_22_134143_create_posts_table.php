<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('Product_name');
            $table->string('Gender');
            $table->integer('Price');
            $table->integer('Shipping');
            $table->string('Category');
            $table->string('Saved_img');
            $table->string('Img_src');
            $table->string('Img_alts');
            $table->string('code');
            $table->string('size1');
            $table->string('size2');
            $table->string('size3');
            $table->string('size4');
            $table->string('size5');
            $table->string('Description');
            $table->string('highlight1');
            $table->string('highlight2');
            $table->string('highlight3');
            $table->integer('rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};