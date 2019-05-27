<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Merek;
class MerekTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testInputData()
    {
        $response = $this->json('POST','/api/merek',['merek' => 'Harley Davidson']);

        $response
            ->assertStatus(201);
    }
}
