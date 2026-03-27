<?php

use App\Enums\ApplicationStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('attachment');
            $table->text('cover_letter')->nullable();
            $table->integer('expected_salary');
            $table->enum('status', ApplicationStatus::all())->default('Pending');
            $table->text('message')->nullable();
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('seeker_id');
            $table->timestamps();

            // foreign keys
            $table->foreign('job_id')->references('id')->on('job_listings')->onDelete('cascade');
            $table->foreign('seeker_id')->references('id')->on('seekers')->onDelete('cascade');

            // unique
            $table->unique(['job_id', 'seeker_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
