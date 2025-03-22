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
        Schema::create('enroll', function (Blueprint $table) {
            $table->id('cer_id');
            $table->unsignedBigInteger('m_id');
            $table->unsignedBigInteger('c_id');
            $table->date('cer_start');
            $table->date('cer_expire');
            $table->foreign('m_id')->references('m_id')->on('member')->onDelete('cascade');
            $table->foreign('c_id')->references('c_id')->on('course')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enroll');
    }
};
