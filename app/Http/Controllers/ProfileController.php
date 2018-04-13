<?php

namespace App\Http\Controllers;


use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login first');
        else
        {  
            $user = User::find(auth()->user()->id);
            return view('home')->with('profile', $user->profile);
        }
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
        //
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
        if (Auth::guest()) {
            return redirect('/login')->with('error','Login first');
        }
        elseif (Auth::user()->id != $id) {
            Auth::logout();
            return redirect('/login')->with('error','Something went wrong! Dont try anything unethical!!!');   
        }
        else
        {
            $profile = Profile::find($id);
            return view('updateProfile')->with('profile', $profile);
        }
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
        $this->validate($request,[
            'password' => 'required',
            'profile_pic' => 'image|nullable|max:2000'
        ]);

        $confirm_change = false;
        $password = $request->input('password');
        $new_password = $request->input('newPassword');
        if(Hash::check($password, auth()->user()->password))
        {
            //update profile
            $profile = Profile::find($id);
            if(isset($_POST['profile_update_btn']))
            {
                $designation = $request->input('designation');
                $phone_number = $request->input('phone_number');
                $address = $request->input('address');

                if($designation != null)
                {
                    $profile->designation = strtolower($designation);
                    $confirm_change = true;
                }

                if($phone_number != null)
                {
                    $profile->phone_number = $phone_number;
                    $confirm_change = true;
                }

                if($address != null)
                {
                    $profile->address = strtolower($address);
                    $confirm_change = true;
                }

                if($confirm_change)
                {
                    $profile->save();
                    return redirect('/profile/'.$id.'/edit')->with('success', 'PROFILE UPDATED');
                }
            }

            //Handling profile pics
            if(isset($_POST['profile_pic_update_btn']))
            {
                if($request->hasFile('profile_pic'))
                {
                    //Get file name with extension
                    $fileNameWithExt = $request->file('profile_pic')->getClientOriginalName();
                    //Get just file name
                    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                    //GET JUST EXTENSION
                    $fileExt = $request->file('profile_pic')->getClientOriginalExtension();
                    //file name to store
                    $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
                    //upload image
                    $path = $request->file('profile_pic')->storeAs('public/profile_pics', $fileNameToStore);
                    //Upadte profile pic in database
                    $profile->profile_pic = $fileNameToStore;
                    $profile->save();
                    return redirect('profile/'.$id.'/edit')->with('success', 'PROFILE PICTURE UPDATED');
                }
                else
                {
                    if(auth()->user()->gender == 'male')
                        $fileNameToStore = 'male.jpg';
                    else
                        $fileNameToStore = 'female.jpg';
                    $profile->profile_pic = $fileNameToStore;
                    $profile->save();
                    return redirect('profile/'.$id.'/edit')->with('delete', 'PROFILE PIC REMOVED');
                }
            }

            //change password
            if (isset($_POST['password_change_btn'])) 
            {
                if($new_password != null)
                {
                    $user  = User::find($id);
                    $user->password = Hash::make($new_password);
                    $user->save();
                    return redirect('profile/'.$id.'/edit')->with('success', 'PASSOWRD UPDATED');
                }
                else
                    return redirect('profile/'.$id.'/edit')->with('error', 'NEW PASSWORD FIELD WAS EMPTY');
            }
        }
        else
            return redirect('profile/'.$id.'/edit')->with('error', 'SORRY! WRONG PASSOWRD');    
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
