<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class ProfileController extends Controller
{
    public function view($id){
        // dd($id);
        $profile = User::find($id);

        return view('pages.staff.profile')->with('profile',$profile);

    }
}
