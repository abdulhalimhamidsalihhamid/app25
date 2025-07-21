<?php

// database/migrations/xxxx_xx_xx_create_items_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->unsignedBigInteger('sub_product_id');
            $table->timestamps();

            // علاقة المفتاح الأجنبي مع الأقسام الفرعية (sub_products)
            $table->foreign('sub_product_id')->references('id')->on('sub_products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('items');
    }
}
