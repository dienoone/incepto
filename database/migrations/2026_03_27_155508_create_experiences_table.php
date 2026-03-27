<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('logo')->nullable();
            $table->string('position');
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('job_type');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->unsignedBigInteger('seeker_id');
            $table->timestamps();

            // foreign keys...
            $table->foreign('seeker_id')->references('id')->on('seekers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
