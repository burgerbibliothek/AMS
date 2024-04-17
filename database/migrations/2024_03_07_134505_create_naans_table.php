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
            $table->foreignId('minter_id')->constrained();
            $table->timestamps();
        });

        $defaultNAANItems = [
            ['naan' => '12345', 'description' => 'Examples', 'minter_id' => '1'],
            ['naan' => '99152', 'description' => 'Terms', 'minter_id' => '7'],
            ['naan' => '99166', 'description' => 'Agents', 'minter_id' => '7'],
            ['naan' => '99999', 'description' => 'Test IDs', 'minter_id' => '8'],
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
