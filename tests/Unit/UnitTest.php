<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
class UnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        // $this->assertTrue(true);
        $response = $this->get('/');
 
        $response->assertStatus(200);
    }
}
