<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('school');
            $table->string('degree');
            $table->string('field_of_study');
            $table->string('address');
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('start_year');
            $table->unsignedBigInteger('end_year')->nullable();
            $table->unsignedBigInteger('seeker_id');
            $table->timestamps();

            // foreign keys...
            $table->foreign('seeker_id')->references('id')->on('seekers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
