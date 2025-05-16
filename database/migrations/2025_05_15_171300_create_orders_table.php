<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('toy_id');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->integer('quantity');
            $table->decimal('total_price', 8, 2);
            $table->timestamps();
            $table->foreign('toy_id')->references('id')->on('toys')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};