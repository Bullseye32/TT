<?php

namespace App\Http\Controllers\Auth;

use Symfony\Component\HttpFoundation\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function register(Request $request)
    {

        $this->validate($request,[
            'full_name' => 'required|string|max:255',
            'user_name' => 'required|string|max:100|unique:users',
            'email' => 'string|email|max:255|unique:users',
            'user_type' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        event(new Registered($user = $this->create($request->all() )));

        // dd($request->all());

        // $this->guard()->login($user);
        return redirect()->route('login');

    //     return $this->registered($request, $user)
    //                     ?: redirect($this->redirectPath());
    }

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
   
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'full_name' => $data['full_name'],
            'user_type' => $data['user_type'],
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
