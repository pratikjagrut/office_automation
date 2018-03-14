<?php

namespace App\Http\Controllers\document_approval;

use App\DocumentApproval;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentApprovalController extends Controller
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
            return view('document_approval.documentApproval');
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
            $title = $request->input('title');
            $file_path = $request->input('file_path');
            $remark = $request->input('remark');
            $approval = $request->input('approval');
            $job_id = $request->input('job_id');
            $priority = $request->input('priority');
            $deadline = $request->input('deadline');
            $generated_by = $request->input('generated_by');

            $new_request = new DocumentApproval;
            $new_request->title = $title;
            $new_request->file_path = $file_path;
            $new_request->remark = $remark;
            $new_request->approval = $approval;
            $new_request->job_id = $job_id;
            $new_request->priority = $priority;
            $new_request->deadline = $deadline;
            $new_request->generated_by = $generated_by;

            if($new_request->save())
                return redirect('/documentApproval')->with('success', 'Successfuly submitted request');
            else
                return redirect('/documentApproval')->with('error', 'Request could not be submitted! Please try again');
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
