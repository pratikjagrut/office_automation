<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use App\SalesP2p;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class P2pController extends Controller
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
            return view('sales.p2p');
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
            $product_name = $request->input('product_name');
            $generated_by = $request->input('generated_by');
            $customer_name = $request->input('customer_name');
            $contact_name = $request->input('contact_name');
            $contact_number = $request->input('contact_number');
            $person_email = $request->input('person_email');
            $a_end_address = $request->input('a_end_address');
            $a_end_city = $request->input('a_end_city');
            $a_end_state = $request->input('a_end_state');
            $a_end_pincode = $request->input('a_end_pincode');
            $a_end_lat = $request->input('a_end_lat');
            $b_end_address = $request->input('b_end_address');
            $b_end_city = $request->input('b_end_city');
            $b_end_state = $request->input('b_end_state');
            $b_end_pincode = $request->input('b_end_pincode');
            $b_end_lat = $request->input('b_end_lat');
            $network_priority = $request->input('network_priority');
            $feasiblity_status = $request->input('feasiblity_status');
            $a_end_feasibility = $request->input('a_end_feasibility');
            $b_end_feasibility = $request->input('b_end_feasibility');
            $bts_address = $request->input('bts_address');

            $new_request = new SalesP2p;
            $new_request->product_name = $product_name;
            $new_request->generated_by = $generated_by;
            $new_request->customer_name = $customer_name;
            $new_request->contact_person_name = $contact_name;
            $new_request->contact_person_no = $contact_number;
            $new_request->contact_person_email = $person_email;
            $new_request->a_end_address = $a_end_address;
            $new_request->a_end_city = $a_end_city;
            $new_request->a_end_state = $a_end_state;
            $new_request->a_end_pincode = $a_end_pincode;
            $new_request->a_end_lat_long = $a_end_lat;
            $new_request->b_end_address = $b_end_address;
            $new_request->b_end_city = $b_end_city;
            $new_request->b_end_state = $b_end_state;
            $new_request->b_end_pincode = $b_end_pincode;
            $new_request->b_end_lat_long = $b_end_lat;
            $new_request->network_priority = $network_priority;
            $new_request->feasibility_status = $feasiblity_status;
            $new_request->a_end_feasibility = $a_end_feasibility;
            $new_request->b_end_feasibility = $b_end_feasibility;
            $new_request->bts_address = $bts_address;


            if($new_request->save())
                return redirect('/p2p')->with('success', 'Successfuly submitted request');
            else
                return redirect('/p2p')->with('error', 'Request could not be submitted! Please try again');
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
