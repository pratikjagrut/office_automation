<?php

namespace App\Http\Controllers\cc;

use App\CcDownArea;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DownAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
            return view('cc.downArea');
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
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login first');
        else
        {
            $area = $request->input('area');
            $assigned_to = $request->input('assigned_to');
            $reason = $request->input('reason');
            $down_day_time = $request->input('down_day_time');
            $up_day_time = $request->input('up_day_time');
            $generated_by = $request->input('generated_by');

            $new_request = new CcDownArea;
            $new_request->area = $area;
            $new_request->assigned_to = $assigned_to;
            $new_request->reason = $reason;
            $new_request->down_day_time = $down_day_time;
            $new_request->up_day_time = $up_day_time;
            $new_request->generated_by = $generated_by;

            if($new_request->save())
                return redirect('/downArea')->with('success', 'Successfuly submitted request');
            else
                return redirect('/downArea')->with('error', 'Request could not be submitted! Please try again');
        }
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
