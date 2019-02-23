<?php

namespace Nayourown\Http\Controllers;

use Nayourown\Report;
use Nayourown\Category;
use Illuminate\Http\Request;
use Nayourown\Http\Resources\ReportResource;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('store'); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::latest()->paginate();
        
        return ReportResource::collection($reports);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id'

        ]);
        
        $report = Report::create([
            'finder_id' => auth()->id(),
            'title' => request('title'),
            'category_id' => request('category_id'),
            'description' => request('description')
        ]);

        return response()->json([
            'report' => $report,
            'message' => 'Report successfully submitted'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Nayourown\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show($slugID, Report $report)
    {
        return new ReportResource($report);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Nayourown\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Nayourown\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Nayourown\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
