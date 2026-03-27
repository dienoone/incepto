<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->string('cover')->nullable();
            $table->text('bio');
            $table->string('website');
            $table->string('industry');
            $table->string('address');
            $table->unsignedBigInteger('founded_year');
            $table->string('funding');
            $table->unsignedBigInteger('revenue_min');
            $table->unsignedBigInteger('revenue_max');
            $table->string('size');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            // foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
