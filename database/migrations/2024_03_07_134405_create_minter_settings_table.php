<?php

use App\Models\Minter;
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
        Schema::create('minter_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('length');
            $table->string('xdigits');
            $table->boolean('ncda');
            $table->timestamps();
        });

        $defaultMinter = [
            ['name' => 'Numeric', 'length' => '7', 'xdigits' => '0123456789', 'ncda' => 0],
            ['name' => 'Alphanumeric', 'length' => '7', 'xdigits' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 'ncda' => 1],
            ['name' => 'Alphanumeric (w/o vowels)', 'length' => '7', 'xdigits' => '0123456789bcdfghjklmnpqrstvwxzBCDFGHJKLMNPQRSTVWXZ', 'ncda' => 1],
            ['name' => 'Alphanumeric (w/o vowels and l)', 'length' => '7', 'xdigits' => '0123456789bcdfghjkmnpqrstvwxzBCDFGHJKLMNPQRSTVWXZ', 'ncda' => 1],
            ['name' => 'Betanumeric', 'length' => '7', 'xdigits' => '0123456789abcdefghijklmnopqrstuvwxyz', 'ncda' => 1],
            ['name' => 'Betanumeric (w/o vowels)', 'length' => '7', 'xdigits' => '0123456789bcdfghjklmnpqrstvwxz', 'ncda' => 1],
            ['name' => 'Betanumeric (w/o vowels and l)', 'length' => '7', 'xdigits' => '0123456789bcdfghjkmnpqrstvwxz', 'ncda' => 1],
            ['name' => 'Alphanumeric (w/ =#*+@_$)', 'length' => '7', 'xdigits' => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvxyz=#*+@_$', 'ncda' => 1]
        ];
        
        Minter::insert($defaultMinter);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minter_settings');
    }
};
