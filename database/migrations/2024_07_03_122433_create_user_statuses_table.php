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
        Schema::create('user_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('info_id')->unique();
            $table->foreign('info_id')->references('id')->on('user_infos');
            $table->string('personal_status');
            $table->string('education_status');
            $table->string('cv_status');
            $table->string('motivation_status');
            $table->string('passport_status');
            $table->string('transcript_status');
            $table->string('admin_accept_name')->nullable();
            $table->string('comment')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_statuses');
    }
};
