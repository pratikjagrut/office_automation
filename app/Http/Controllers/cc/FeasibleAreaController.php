<?php

namespace App\Http\Controllers\cc;

use App\CcFeasibleArea;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeasibleAreaController extends Controller
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
            $reseller_name = $request->input('reseller_name');
            $building = $request->input('building');
            $society = $request->input('society');
            $area = $request->input('area');
            $city = $request->input('city');
            $switch_location = $request->input('switch_location');
            $contact_name = $request->input('contact_name');
            $contact_number = $request->input('contact_number');
            $generated_by = $request->input('generated_by');

            $new_request = new CcFeasibleArea;
            $new_request->reseller_name = $reseller_name;
            $new_request->building = $building;
            $new_request->society = $society;
            $new_request->area = $area;
            $new_request->city = $city;
            $new_request->switch_location = $switch_location;
            $new_request->contact_name = $contact_name;
            $new_request->contact_number = $contact_number;
            $new_request->generated_by = $generated_by;

            if($new_request->save())
                return redirect('/feasibleArea')->with('success', 'Successfuly submitted request');
            else
                return redirect('/feasibleArea')->with('error', 'Request could not be submitted! Please try again');
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
