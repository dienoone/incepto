<?php

use App\Enums\DetailType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body')->nullable(); // for the missions, benefits only
            $table->string('icon')->nullable(); // for the missions, benefits only
            $table->enum('type', DetailType::all());
            $table->morphs('detailable');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('details');
    }
};
