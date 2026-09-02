<?php

namespace Tests\Feature;

use App\Models\Ark;
use App\Models\Minter;
use App\Models\Naan;
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
        $response = $this->get('/ark:1B2C/test');
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

    /**
     * Check not found error
     */
    public function test_ark_not_found(): void
    {
        $minter = Minter::factory()->create([
            'xdigits' => '0123456789',
            'ncda' => 0
        ]);

        Naan::factory()->create([
            'naan' => '12345',
            'minter_id' => $minter->id
        ]);

        $response = $this->get('/ark:12345/12345');
        $response->assertStatus(404);
    }

    /**
     * Check NCDA 
     */
    public function test_invalid_ncda(): void
    {
        $minter = Minter::factory()->create([
            'xdigits' => '0123456789bcdfghjklmnpqrstvwxzBCDFGHJKLMNPQRSTVWXZ',
            'ncda' => 1
        ]);

        Naan::factory()->create([
            'naan' => '12345',
            'minter_id' => $minter->id
        ]);

        $response = $this->get('/ark:12345/12345');
        $response->assertStatus(400);
    }

    /**
     * Check ?info
     */
    public function test_info_page(): void
    {
        $ark = Ark::factory()->create([
            'ark' => 'ark:12345/1a2b3c4d'
        ]);

        $response = $this->get('/ark:12345/1a2b3c4d?info');
        $response->assertStatus(200);
        $this->assertEquals($response->getContent(), 'erc: (:tba) | (:tba) | (:tba) | (:tba)');
    }

    /**
     * Check redirect of ARK
     */
    public function test_known_ark_redirects_to_uri(): void
    {
        $minter = Minter::factory()->create([
            'xdigits' => '0123456789bcdfghjklmnpqrstvwxzBCDFGHJKLMNPQRSTVWXZ',
            'ncda' => 0
        ]);

        Naan::factory()->create([
            'naan' => '12345',
            'minter_id' => $minter->id,
            'spt' => 0
        ]);

        Ark::factory()->create([
            'ark' => 'ark:12345/1a2b3c4d',
            'uri' => 'https://www.burgerbib.ch',
        ]);

        $response = $this->get('/ark:12345/1a2b3c4d');
        $response->assertRedirect('https://www.burgerbib.ch');
    }

    /**
     * Check redirect wit suffix passtrough
     */
    public function test_redirect_with_suffixpasstrough(): void
    {
        $minter = Minter::factory()->create([
            'xdigits' => '0123456789bcdfghjklmnpqrstvwxzBCDFGHJKLMNPQRSTVWXZ',
            'ncda' => 0
        ]);

        Naan::factory()->create([
            'naan' => '12345',
            'minter_id' => $minter->id,
            'spt' => 1
        ]);

        Ark::factory()->create([
            'ark' => 'ark:12345/1a2b3c4d',
            'uri' => 'https://www.burgerbib.ch',
        ]);

        $response = $this->get('/ark:12345/1a2b3c4d/ueber-uns/publikationen?mtm_campaign=testing&mtm_source=ark-management-system#c421');
        $response->assertRedirect('https://www.burgerbib.ch/ueber-uns/publikationen?mtm_campaign=testing&mtm_source=ark-management-system');
    }


    
}
