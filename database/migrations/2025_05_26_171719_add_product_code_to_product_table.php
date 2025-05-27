<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductCodeToProductTable extends Migration
{
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->string('product_code', 10)->nullable()->after('product_category');
        });
    }

    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn('product_code');
        });
    }
}
