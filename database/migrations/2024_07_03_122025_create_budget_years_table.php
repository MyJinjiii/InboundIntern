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
        Schema::create('budget_years', function (Blueprint $table) {
            $table->id();
            $table->string('year');
            $table->date('date_start');
            $table->date('date_end');
            $table->unsignedBigInteger('regis_status');
            $table->unsignedBigInteger('edit_status');
            $table->unsignedBigInteger('confirm_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_years');
    }
};
