<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('rate', 2, 1);
            $table->text('pros');
            $table->text('cons');
            $table->text('details')->nullable();
            $table->boolean('anonymously')->default(false);
            $table->unsignedBigInteger('likes')->default(0);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('seeker_id');
            $table->timestamps();

            // foreign kes
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('seeker_id')->references('id')->on('seekers')->onDelete('cascade');

            // indexes
            $table->unique(['company_id', 'seeker_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
