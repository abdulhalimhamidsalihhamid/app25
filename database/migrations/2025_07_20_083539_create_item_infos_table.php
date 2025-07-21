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
Schema::create('item_infos', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('item_id');        // مفتاح أجنبي للمنتج
    $table->integer('quantity');                  // عدد المنتج
    $table->date('expire_date');                  // تاريخ الصلاحية
    $table->timestamps();

    $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_infos');
    }
};
