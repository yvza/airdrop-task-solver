<?php

namespace App\Http\Controllers;

use App\Models\Garapan;
use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ListGarapanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $helper = [];
        $today = Garapan::whereDate('distribution_date', Carbon::today())->get();
        $next_three_days = Garapan::where('distribution_date', '>=', strtotime('+1 day'))
        ->where('distribution_date', '<=', strtotime('+3 day'));
        $still_in_long_time = Garapan::where('distribution_date', '>=', strtotime('+4 day'));
        array_push($helper, $today, $next_three_days, $still_in_long_time);

        return Inertia::render('ListGarapan', [
            'list_garapan' => $helper
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
