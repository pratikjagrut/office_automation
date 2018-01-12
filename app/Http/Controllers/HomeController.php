<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        if(!Profile::find($user_id))
        {
            $profile = new Profile;
            $profile->user_id = $user_id;
            $profile->name = strtolower(auth()->user()->name);
            $profile->employee_id = auth()->user()->employee_id;
            $profile->email_id = auth()->user()->email;
            if(auth()->user()->gender == 'male')
                $fileNameToStore = 'male.jpg';
            else
                $fileNameToStore = 'female.jpg';
            $profile->profile_pic = $fileNameToStore;
            $profile->save();
        }
        $profile = Profile::find($user_id);
        return redirect('newJobEntry');
    }
}
