<?php

namespace App\Http\Controllers\cc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefundController extends Controller
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
            $account_number = $request->input('account_number');
            $ifsc_code = $request->input('ifsc_code');
            $bank_name = $request->input('bank_name');
            $bank_branch = $request->input('bank_branch');
            $reason = $request->input('reason');
            $mail_date = $request->input('mail_date');
            $refund_status = $request->input('refund_status');
            $done_date = $request->input('done_date');
            $utr_number = $request->input('utr_number');
            $assigned_to = $request->input('assigned_to');
            $generated_by = $request->input('generated_by');

            $new_request = new CcRefund;
            $new_request->user_id = $user_id;
            $new_request->customer_name = $customer_name;
            $new_request->account_number = $account_number;
            $new_request->ifsc_code = $ifsc_code;
            $new_request->bank_name = $bank_name;
            $new_request->bank_branch = $bank_branch;
            $new_request->reason = $reason;
            $new_request->mail_date = $mail_date;
            $new_request->refund_status = $refund_status;
            $new_request->done_date = $done_date;
            $new_request->utr_number = $utr_number;
            $new_request->assigned_to = $assigned_to;
            $new_request->generated_by = $generated_by;

            if($new_request->save())
                return redirect('/refund')->with('success', 'Successfuly submitted request');
            else
                return redirect('/refund')->with('error', 'Request could not be submitted! Please try again');
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
