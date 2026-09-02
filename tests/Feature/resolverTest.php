<?php

namespace Tests\Feature;

use App\Models\Ark;
use App\Models\Minter;
use App\Models\Naan;
use App\Models\Status;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class resolverTest extends TestCase
{

    use DatabaseTransactions;
    
    /**
     * Check if invalid naans are recognized.
     */
    public function test_invalid_naan(): void
    {
        $response = $this->get('/ark:1A2B/test');
        $response->assertStatus(400);
    }

    /**
     * Check if valid ARK is redirected to global resolver.
     */
    public function test_redirect_global_resolver(): void
    {
        $response = $this->get('ark:12148/btv1b8449691v/f29');
        $response->assertStatus(302);
    }

    /***/
    public function test_invalid_xdigit(): void
    {
        $minter = Minter::factory()->create([
            'xdigits' => '0123456789bcdfghjkmnpqrstvwxz',
        ]);

        Naan::factory()->create([
            'naan' => '12345',
            'minter_id' => $minter->id,
        ]);

        $response = $this->get('/ark:99999/htIafiO1a');
        $response->assertStatus(400);
    }

    
}
