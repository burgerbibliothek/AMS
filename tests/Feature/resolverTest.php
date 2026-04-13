<?php

namespace Tests\Feature;

use Tests\TestCase;

class resolverTest extends TestCase
{
    /**
     * Check if invalid naans are recognized.
     */
    public function test_invalid_naan(): void
    {
        $response = $this->get('/ark:1A2B/test');
        $response->assertStatus(400);
    }

    /**
     * Check if ARK w/ invalid xdigit is recognized.
     */
    public function test_invalid_xdigit(): void
    {
        $response = $this->get('/ark:99999/htIafiO1a');
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
}
