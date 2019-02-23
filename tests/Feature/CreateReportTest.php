<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateReportTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_may_not_create_report()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $report = make('Nayourown\Report');
        $this->post('api/reports',$report->toArray());
        
    }
    
    /** @test */
    public function an_authenticated_user_can_create_report()
    {
        $this->signIn();
        
        $report = make('Nayourown\Report');
        $this->post('api/reports',$report->toArray())->assertStatus(200)->assertSee($report->description);
    }

    /** @test */
    public function an_report_requires_a_title()
    {
        $this->signIn();
        
        $report = make('Nayourown\Report');
        $this->post('api/reports',$report->toArray())->assertStatus(422);
    }
     
}
