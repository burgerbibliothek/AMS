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
        Schema::create('successfull_import_rows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('import_id')->references('id')->on('imports');
            $table->foreignId('ark_id')->references('id')->on('arks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('successfull_import_rows');
    }
};
