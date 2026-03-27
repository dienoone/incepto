<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->text('bio');
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->string('linkedin')->nullable();
            $table->unsignedBigInteger('team_id');
            $table->timestamps();

            // foreign keys
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
