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
            $user_id = $request->input('user_id');
            $customer_name = $request->input('customer_name');
            $area_name = $request->input('area_name');
            $reason = $request->input('reason');
            $down_date = $request->input('down_date');
            $down_time = $request->input('down_time');
            $up_date = $request->input('up_date');
            $up_time = $request->input('up_time');
            $assigned = $request->input('assigned');
            $generated_by = $request->input('generated_by');

            $new_request = new CcDownArea;
            $new_request->user_id = $user_id;
            $new_request->customer_name = $customer_name;
            $new_request->area_name = $area_name;
            $new_request->reason = $reason;
            $new_request->down_date = $down_date;
            $new_request->down_time = $down_time;
            $new_request->up_date = $up_date;
            $new_request->up_time = $up_time;
            $new_request->assigned = $assigned;
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
