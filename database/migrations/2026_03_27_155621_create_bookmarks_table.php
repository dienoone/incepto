<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('seeker_id');
            $table->timestamps();

            // primary keys
            $table->primary(['job_id', 'seeker_id']);

            // foreign keys
            $table->foreign('job_id')->references('id')->on('job_listings')->onDelete('cascade');
            $table->foreign('seeker_id')->references('id')->on('seekers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookmarks');
    }
};
