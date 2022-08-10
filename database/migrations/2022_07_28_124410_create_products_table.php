<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('type')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('color')->nullable();
            $table->string('height')->nullable();
            $table->string('top_type')->nullable();
            $table->string('top_shape')->nullable();
            $table->string('edge_type')->nullable();
            $table->string('protection')->nullable();
            $table->string('quantity')->nullable();
            $table->decimal('transport')->nullable();
            $table->string('currency')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('deposit')->nullable();
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
        Schema::dropIfExists('products');
    }
};
