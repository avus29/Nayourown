<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadReportsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->report = create('Nayourown\Report');
    }

    /** @test */
    public function a_user_can_browse_all_reports()
    {
        $this->get('api/reports')
        ->assertSee($this->report->title);
    }

    /** @test */
    public function  a_user_can_browse_a_single_report()
    {
        $this->get($this->report->path())
        ->assertSee($this->report->title);
    }

    /** @test */
    public function a_user_can_read_claims_associated_with_a_report()
    {
        $claim = create('Nayourown\Claim', ['report_id' => $this->report->id]);

        $this->get($this->report->path())->assertSee($claim->statement);
    }
}
