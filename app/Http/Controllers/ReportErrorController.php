<?php

namespace App\Http\Controllers;

use App\Models\ReportError;
use Illuminate\Http\Request;

class ReportErrorController extends Controller
{

    public function __construct()
    {
        // $this->authorizeResource(ReportError::class); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', ReportError::class);

        $reports = ReportError::where(function ($q) use ($request) {
            if ($request->id != null)
                $q->where('id', $request->id);
            if ($request->user_id != null)
                $q->where('user_id', $request->user_id);
        })->orderBy('id', 'DESC')->paginate();
        return view('admin.traffics.error-reports', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', ReportError::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', ReportError::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReportError  $reportError
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ReportError $reportError)
    {
        $this->authorize('view', $reportError);

        return dd($reportError);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReportError  $reportError
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportError $reportError)
    {
        $this->authorize('update', $reportError);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReportError  $reportError
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportError $reportError)
    {
        $this->authorize('update', $reportError);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReportError  $reportError
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportError $reportError)
    {
        $this->authorize('delete', $reportError);
    }
}
