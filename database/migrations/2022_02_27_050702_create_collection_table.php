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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donor_id');
            $table->decimal('sostoyoni',20,2);
            $table->decimal('istovriti',20,2);
            $table->decimal('dokkhina',20,2);
            $table->decimal('songothoni',20,2);
            $table->decimal('pronami',20,2);
            $table->decimal('advertise',20,2);
            $table->decimal('mandir_construction',20,2);
            $table->decimal('various',20,2);
            $table->decimal('total',20,2);
            $table->unsignedBigInteger('author_id');
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
        Schema::dropIfExists('collections');
    }
};
