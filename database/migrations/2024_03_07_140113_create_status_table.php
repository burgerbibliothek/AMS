<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Status;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('status', function (Blueprint $table) {
            $table->id();
            $table->integer('code')->unique();
            $table->string('message', 255);
            $table->string('label', 255)->virtualAs('concat(code, \' \', message)');
            $table->timestamps();
        });

        $defaultStatusCodes = [
            ['code' => 400, 'message' => 'Bad Request'],
            ['code' => 403, 'message' => 'Forbidden'],
            ['code' => 406, 'message' => 'Not Acceptable'],
            ['code' => 410, 'message' => 'Gone'],
            ['code' => 451, 'message' => 'Unavailable For Legal Reasons']
        ];
        
        Status::insert($defaultStatusCodes);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status');
    }
};
