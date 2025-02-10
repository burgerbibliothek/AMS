<?php

namespace Tests\Feature;

use Tests\TestCase;

class ResolverTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_resolves_to_400_naan_unknown(): void
    {
        $response = $this->get('/ark:99999/test');
        $response->assertStatus(400);
    }


}
