<?php

namespace App\Http\Controllers\hr;

use App\HrManpower;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManPowerController extends Controller
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
            return view('hr.manPower');
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
            $vacancy_designation = $request->input('vacancy_designation');
            $no_of_vacancy = $request->input('no_of_vacancy');
            $reason = $request->input('reason');
            $priority = $request->input('priority');
            $preferences = $request->input('preferences');
            $qualification = $request->input('qualification');
            $job_description = $request->input('job_description');
            $generated_by = $request->input('generated_by');

            $new_request = new HrManpower;
            $new_request->vacancy_designation = $vacancy_designation;
            $new_request->no_of_vacancy = $no_of_vacancy;
            $new_request->reason = $reason;
            $new_request->priority = $priority;
            $new_request->preferences = $preferences;
            $new_request->qualification = $qualification;
            $new_request->job_description = $job_description;
            $new_request->generated_by = $generated_by;

            if($new_request->save())
                return redirect('/manPower')->with('success', 'Successfuly submitted request');
            else
                return redirect('/manPower')->with('error', 'Request could not be submitted! Please try again');
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
