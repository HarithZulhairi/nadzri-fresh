<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id('product_ID');
            $table->string('product_name');
            $table->text('product_description');
            $table->string('product_category');
            $table->double('product_discount');
            $table->date('product_expiryDate');
            $table->double('product_price');
            $table->string('product_supplier');
            $table->string('product_status');
            $table->string('product_picture_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
