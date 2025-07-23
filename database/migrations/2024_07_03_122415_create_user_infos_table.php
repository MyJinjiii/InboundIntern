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
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('surname');
            $table->string('title');
            $table->string('email');
            $table->string('tel');
            $table->string('level_of_studies');
            $table->string('year_of_study');
            $table->string('study_program');
            $table->string('faculty');
            $table->string('university');
            $table->string('country');
            $table->string('topic');
            $table->string('advisor')->nullable();
            $table->string('program_focus')->nullable();
            $table->string('internship_duration');
            $table->date('start_date');
            $table->date('ending_date');
            $table->string('cv_file');
            $table->string('motivation_file');
            $table->string('passport_file')->nullable();
            $table->string('transcript_file');
            $table->text('scholarship');
            $table->unsignedBigInteger('topic_id');
            $table->foreign('topic_id')->references('id')->on('research_lists');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_infos');
    }
};
