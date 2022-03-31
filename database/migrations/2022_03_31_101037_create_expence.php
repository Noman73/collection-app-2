<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpence extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exp_id');
            $table->decimal('ammount',20);
            $table->unsignedBigInteger('author_id');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->foreign('exp_id')->references('id')->on('expence_areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expences');
    }
}
