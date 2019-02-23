<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MakingClaimsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_may_make_claims_to_a_report()
    {
        $this->signIn();

        $report = create('Nayourown\Report');
       
        $claim = create('Nayourown\Claim');

        $this->post($report->path().'/claims', $claim->toArray());

        
        $this->get($report->path())->assertSee($claim->statement);
    }
}
