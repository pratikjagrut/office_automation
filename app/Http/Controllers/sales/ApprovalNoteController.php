<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use App\SalesApprovalNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalNoteController extends Controller
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
            return view('sales.approvalNote');
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
            $customer_name = $request->input('customer_name');
            $generated_by = $request->input('generated_by');
            $bandwidth_size = $request->input('bandwidth_size');
            $order_value = $request->input('order_value');
            $job_id = $request->input('job_id');
            $capex = $request->input('capex');
            $opex = $request->input('opex');
            $operator_involved = $request->input('operator_involved');
            $miscellaneous_expenses = $request->input('miscellaneous_expenses');
            $comment = $request->input('comment');
            $approved_by = $request->input('approved_by');
            $approval_remark = $request->input('approval_remark');

            $new_request = new SalesApprovalNote;
            $new_request->customer_name = $customer_name;
            $new_request->generated_by = $generated_by;
            $new_request->bandwidth_size = $bandwidth_size;
            $new_request->order_value = $order_value;
            $new_request->job_id = $job_id;
            $new_request->capex = $capex;
            $new_request->opex = $opex;
            $new_request->operator_involved = $operator_involved;
            $new_request->miscellaneous_expenses = $miscellaneous_expenses;
            $new_request->comment = $comment;
            $new_request->approved_by = $approved_by;
            $new_request->approval_remark = $approval_remark;

            if($new_request->save())
                return redirect('/approvalNote')->with('success', 'Successfuly submitted request');
            else
                return redirect('/approvalNote')->with('error', 'Request could not be submitted! Please try again');
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
