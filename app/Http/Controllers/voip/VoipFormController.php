<?php

namespace App\Http\Controllers\voip;

use App\Http\Controllers\Controller;
use App\VoipVoipForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoipFormController extends Controller
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
            return view('voip.voipForm');
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
            $dates_manually = $request->input('dates_manually');
            $destination = $request->input('destination');
            $country_code = $request->input('country_code');
            $area_code = $request->input('area_code');
            $price = $request->input('price');
            $status = $request->input('status');

            $new_request = new VoipVoipForm;
            $new_request->dates_manually = $dates_manually;
            $new_request->destination = $destination;
            $new_request->country_code = $country_code;
            $new_request->area_code = $area_code;
            $new_request->price = $price;
            $new_request->status = $status;

            if($new_request->save())
                return redirect('/voipForm')->with('success', 'Successfuly submitted request');
            else
                return redirect('/voipForm')->with('error', 'Request could not be submitted! Please try again');
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
