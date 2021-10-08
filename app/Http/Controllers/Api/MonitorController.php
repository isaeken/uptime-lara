<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Monitor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(auth()->user()->monitors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Monitor  $monitor
     * @return Response
     */
    public function show(Monitor $monitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Monitor  $monitor
     * @return Response
     */
    public function update(Request $request, Monitor $monitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Monitor  $monitor
     * @return Response
     */
    public function destroy(Monitor $monitor)
    {
        //
    }
}
