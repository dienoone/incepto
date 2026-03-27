<?php

use App\Enums\JobType;
use App\Enums\JobArrangement;
use App\Enums\JobStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->string('address');
            $table->enum('type', JobType::all());
            $table->string('level');
            $table->enum('arrangement', JobArrangement::all());
            $table->integer('salary_min');
            $table->integer('salary_max');
            $table->unsignedBigInteger('views')->default(0);
            $table->enum('status', JobStatus::all());
            $table->dateTime('published_at');
            $table->dateTime('expires_at');
            $table->unsignedBigInteger('company_id');
            $table->timestamps();

            // foreign keys
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
