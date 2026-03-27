<?php

use App\Enums\AttachmentType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // NOTE: display name, e.g. My Resume 2024
            $table->string('path');
            $table->enum('type', AttachmentType::all());
            $table->unsignedBigInteger('seeker_id');
            $table->timestamps();

            // foreign keys
            $table->foreign('seeker_id')->references('id')->on('seekers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
