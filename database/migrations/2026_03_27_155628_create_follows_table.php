<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('seeker_id');
            $table->timestamps();

            // primary keys
            $table->primary(['company_id', 'seeker_id']);

            // foreign kes
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('seeker_id')->references('id')->on('seekers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
