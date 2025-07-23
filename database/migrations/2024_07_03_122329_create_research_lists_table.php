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
        Schema::create('research_lists', function (Blueprint $table) {
            $table->id();
            $table->string('division');
            $table->string('program');
            $table->string('prof_name');
            $table->string('short');
            $table->string('topic');
            $table->string('support')->nullable();
            $table->string('details')->nullable();
            $table->unsignedBigInteger('approve');
            $table->unsignedBigInteger('advisor_id')->nullable()->default(0);
            $table->foreign('advisor_id')->references('id')->on('users');
            $table->unsignedBigInteger('year_id');
            $table->foreign('year_id')->references('id')->on('budget_years');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_lists');
    }
};
