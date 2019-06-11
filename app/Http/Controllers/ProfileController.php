<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Input;
use Session;

// use Illuminate\Foundation\Auth\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth');
    }

    public function view($id)
    {
        // dd($id);
        $profile = User::find($id);

        return view('pages.staff.profile')->with('profile',$profile);

    }

    public function editPassword(){
        // dd("Here");
        return view('pages.staff.resetPassword');
    }

    public function updatePassword(Request $request, $id){
        $this->validate($request, [
            'new_pass' => 'required|min:8',
            'confirm_pass' => 'required|min:8'
        ]);

        $change = User::find($id);
        // $hash = Hash::check(Input::get('old_password'),$change->password);
        // dd($hash);

        // checks if old_password matches with stored hashed password
        if (Hash::check(Input::get('old_password'),$change->password))
        {
            if ($request->new_pass==$request->confirm_pass)
            {
                // dd([$request->new_pass, $request->confirm_pass]);

                $change->password=bcrypt($request->new_pass);
                $change->save();

                Session::flash('success','Password changed Successfully');
                Auth::logout();
                return redirect()->route('home');
            }
            else{
                Session::flash('error','Password did not match.');
                return redirect()->back();
            }
        }
        else {
            Session::flash('error', 'Old password did not match');
            return redirect()->back()->withErrors(['old_password' => 'Your password is incorrect.']);
        }
    }
}
