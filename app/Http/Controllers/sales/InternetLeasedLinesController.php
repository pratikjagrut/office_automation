<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use App\SalesInternetLeasedLines;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternetLeasedLinesController extends Controller
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
            return view('sales.internetLeasedLines');
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
            $generated_by = $request->input('generated_by');
            $customer_name = $request->input('customer_name');
            $customer_address = $request->input('customer_address');
            $city = $request->input('city');
            $state = $request->input('state');
            $pincode = $request->input('pincode');
            $contact_name = $request->input('contact_name');
            $contact_number = $request->input('contact_number');
            $contact_email = $request->input('contact_email');
            $bandwidth_size = $request->input('bandwidth_size');
            $feasiblity_status = $request->input('feasiblity_status');
            $fiber = $request->input('fiber');
            $radio_frequency = $request->input('radio_frequency');

            $new_request = new SalesInternetLeasedLines;
            $new_request->generated_by = $generated_by;
            $new_request->customer_name = $customer_name;
            $new_request->customer_address = $customer_address;
            $new_request->customer_city = $city;
            $new_request->customer_state = $state;
            $new_request->pincode = $pincode;
            $new_request->contact_person_name = $contact_name;
            $new_request->contact_person_no = $contact_number;
            $new_request->contact_person_email = $contact_email;
            $new_request->bandwidth_size = $bandwidth_size;
            $new_request->feasibility_status = $feasiblity_status;
            $new_request->fiber = $fiber;
            $new_request->rf = $radio_frequency;

            if($new_request->save())
                return redirect('/internetLeasedLines')->with('success', 'Successfuly submitted request');
            else
                return redirect('/internetLeasedLines')->with('error', 'Request could not be submitted! Please try again');
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
