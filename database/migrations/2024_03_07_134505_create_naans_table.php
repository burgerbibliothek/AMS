<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Naan;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('naans', function (Blueprint $table) {
            $table->id();
            $table->string('naan', 255)->unique();
            $table->string('description', 255);
            $table->json('shoulders')->nullable();
            $table->timestamps();
        });

        $defaultNAANItems = [
            ['naan' => '12345', 'description' => 'Examples'],
            ['naan' => '99152', 'description' => 'Terms'],
            ['naan' => '99166', 'description' => 'Agents'],
            ['naan' => '99999', 'description' => 'Test IDs'],
        ];
        
        Naan::insert($defaultNAANItems);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('naans');
    }
};
