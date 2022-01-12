<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up() : void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique()->index();
            $table->string('name',100)->index();
            $table->text('description');
            $table->unsignedBigInteger('price');
            $table->unsignedInteger('quantity');
            $table->boolean('state')->default(true);
            $table->timestamps();
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('products');
    }
}
