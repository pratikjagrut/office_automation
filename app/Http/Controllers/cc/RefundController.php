<?php

namespace App\Http\Controllers\cc;

use App\CcRefund;
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
            return view('cc.refund');
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
            $customer_id = $request->input('customer_id');
            $customer_name = $request->input('customer_name');
            $account_no = $request->input('accaccount_nount_number');
            $ifsc_no = $request->input('ifsc_no');
            $bank = $request->input('bank');
            $branch = $request->input('branch');
            $reason = $request->input('reason');
            $refund_amount = $request->input('refund_amount');
            $mail_date = $request->input('mail_date');
            $refund_status = $request->input('refund_status');
            $done_date = $request->input('done_date');
            $utr_no = $request->input('utr_no');
            $assigned_to = $request->input('assigned_to');
            $generated_by = $request->input('generated_by');

            $new_request = new CcRefund;
            $new_request->customer_id = $customer_id;
            $new_request->customer_name = $customer_name;
            $new_request->account_no = $account_no;
            $new_request->ifsc_no = $ifsc_no;
            $new_request->bank = $bank;
            $new_request->branch = $branch;
            $new_request->reason = $reason;
            $new_request->refund_amount = $refund_amount;
            $new_request->mail_date = $mail_date;
            $new_request->refund_status = $refund_status;
            $new_request->done_date = $done_date;
            $new_request->utr_no = $utr_no;
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
