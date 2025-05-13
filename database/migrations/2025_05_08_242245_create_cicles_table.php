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
        Schema::create('cicles', function (Blueprint $table) {
            $table->id();
            $table->string('Nom del Cicle');
            $table->string('Nivell')->nullable();
            $table->string('Família')->nullable();
            $table->text('Descripció');
            $table->integer('Valoració')->nullable();
            $table->text('Opinió')->nullable();
            $table->string('Email');
            $table->date('date');
            $table->time('hora');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cicles');
    }
};
