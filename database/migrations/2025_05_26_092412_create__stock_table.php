<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->integer('max_quantity')->default(100);
            $table->date('expiration_date')->nullable();
            $table->string('category')->nullable(); // optional: might already be in product
            $table->decimal('price', 8, 2)->nullable(); // optional: if per stock price
            $table->string('supplier')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('product_ID')->on('product')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
