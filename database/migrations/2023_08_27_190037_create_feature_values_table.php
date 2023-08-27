<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('feature_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feature_id')->constrained('features')->onDelete('cascade');
            $table->string('value');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feature_values');
    }
};
