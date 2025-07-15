<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('image')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('product_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('locale', 2);
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('manufacturers_standard')->nullable();
            $table->json('features')->nullable();
            $table->json('applications')->nullable();
            $table->timestamps();
            
            $table->unique(['product_id', 'locale']);
            $table->index('locale');
        });

        // Связь продуктов со страницами (многие ко многим)
        Schema::create('page_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('order')->default(0);
            $table->timestamps();
            
            $table->unique(['page_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('page_products');
        Schema::dropIfExists('product_translations');
        Schema::dropIfExists('products');
    }
};