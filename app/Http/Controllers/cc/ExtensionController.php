<?php

namespace App\Http\Controllers\cc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExtensionController extends Controller
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
            return view('cc.extension');
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
            $complaint_date = $request->input('complaint_date');
            $expiry = $request->input('expiry');
            $status = $request->input('status');
            $reason = $request->input('reason');
            $assigned_to = $request->input('assigned_to');
            $generated_by = $request->input('generated_by');

            $new_request = new CcExtsension;
            $new_request->user_id = $user_id;
            $new_request->customer_name = $customer_name;
            $new_request->complaint_date = $complaint_date;
            $new_request->expiry = $expiry;
            $new_request->status = $status;
            $new_request->reason = $reason;
            $new_request->assigned_to = $assigned_to;
            $new_request->generated_by = $generated_by;

            if($new_request->save())
                return redirect('/extension')->with('success', 'Successfuly submitted request');
            else
                return redirect('/extension')->with('error', 'Request could not be submitted! Please try again');
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
