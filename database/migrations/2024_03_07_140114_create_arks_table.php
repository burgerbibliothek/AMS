<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('arks', function (Blueprint $table) {
            $table->id();
            $table->string('ark', 255)->unique();
            $table->text('uri');
            $table->foreignId('status_id')->nullable()->references('id')->on('status');
            $table->text('metadata');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arks');
    }
};