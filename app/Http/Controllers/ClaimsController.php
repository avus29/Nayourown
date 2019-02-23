<?php

namespace Nayourown\Http\Controllers;

use Illuminate\Http\Request;
use Nayourown\Report;

class ClaimsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /** Store a claim made upon a report */
    public function store($slugID, Report $report)
    {
        $report->addClaim([
            'claimant_id' => auth()->id(),
            'statement' => request('statement')
        ]);
        
        return redirect($report->path());
    }
}
