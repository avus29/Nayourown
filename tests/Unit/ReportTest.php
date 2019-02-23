<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->report = create('Nayourown\Report');
    }
    
    /** @test */
    public function a_report_has_claims()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->report->claims);
    }

    /** @test */
    public function a_report_has_creator()
    {
        $this->assertInstanceOf('Nayourown\User', $this->report->creator);
    }

     /** @test */
     public function a_report_can_make_a_path()
     {
         $report = create('Nayourown\Report');
        $this->assertEquals("/api/reports/{$report->category->slug}/{$report->id}",$report->path());
     }

    /** @test */
    public function a_report_can_add_a_claim()
    {
        $this->report->addClaim([
            'claimant_id' => 1,
            'statement' => 'foo bar'
        ]);

        $this->assertCount(1,$this->report->claims);
    }

    /** @test */
    public function a_report_belongs_to_a_category()
    {
        $this->assertInstanceOf('Nayourown\Category',$this->report->category);
    }
}
