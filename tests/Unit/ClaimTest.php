<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClaimTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_has_owner()
    {
        $claim = create('Nayourown\Claim');

        $this->assertInstanceOf('Nayourown\User',$claim->owner);
    }
}
