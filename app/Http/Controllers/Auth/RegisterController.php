<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Session;
use App\Helper\Tools;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;

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
    // protected $redirectTo = '/staff';

    public function register(Request $request)
    {
        // dd($request->request);

        $this -> validator($request->all())->validate();


        // $this->validate($request,[
        //     'full_name' => 'required|string|max:255',
        //     'user_name' => 'required|string|max:100|unique:users',
        //     'email' => 'string|email|max:255|unique:users',
        //     'user_type' => 'required',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);
        event(new Registered($user = $this->create($request->all() )));

        // dd($request->all());

        // $this->guard()->login($user);
        return redirect()->route('staff.show');

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

     protected function validator(array $data)
     {
         return Validator::make($data, [
            'full_name' => 'required|string|max:255',
            'user_name' => 'required|string|max:100|unique:users',
            'email' => 'string|email|max:255|unique:users',
            'user_type' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'profile_image' => 'mimes:jpeg,jpg,png|max:2048',
         ]);
     }

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
            'contact' => $data['contact'],
            'join_date' => $data['join_date'],
            'department' => $data['department'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    // staff listing
    public function show(){
        $staff = User::paginate(10);
        return view('pages.staff.showstaff')->with('staff',$staff);
    }

    // delete staff
    public function delete(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            $responseData = Tools::setResponse('fail', 'Missing Parameter', '', '');
            $status = 422;

            return response()->json($responseData,$status);
        }

        // deleting staff
        $data = User::find($request->id);
        Storage::delete('public/assets/uploads/'.$data->profile_image);
        Storage::delete('public/assets/uploads/'.$data->citizenship_image);

        $data->delete();

        // Session::flash('success','User Deleted Successfully');
        $responseData = Tools::setResponse('success', 'Staff Deleted successfully', '','');
        return response($responseData,200);

    }

    public function getView($id){

        $staff = User::find($id);
        // dd($staff);

        // $assigned = User::find($id)->tasks()->paginate(5);

        // $assigned =$assign->sortByDesc('id');
        return view('pages.staff.view')
        ->with('staff', $staff);
        // ->with('assigned', $assigned);
    }

    public function getEdit($id){
        $staff = User::find($id);
        return view('pages.staff.edit')->with('staff', $staff);
    }

    public function updateStaff(Request $request, $id){
        // dd($request->request);

        // validation of name field
        $this->validate($request, [
            'full_name' => 'required',
            'user_name' => 'required',
            'profile_image' => 'mimes:jpeg,jpg,png|max:2048',

            ]);

        // searching in User model using 'id'
        $staff = User::find($id);
        // requesting name and image from form

        $staff->full_name=$request->input('full_name');
        $staff->user_name=$request->input('user_name');
        $staff->contact=$request->input('contact');
        $staff->permanent_add=$request->input('permanent_add');
        $staff->temporary_add=$request->input('temporary_add');
        $staff->email=$request->input('email');
        $staff->facebook_link=$request->input('facebook_link');
        $staff->linkedin_link=$request->input('linkedin_link');
        $staff->join_date=$request->input('join_date');
        $staff->department=$request->input('department');

        // receive image
        if(isset($request->profile_image)){

            //first delete previous profile picture from storage
            Storage::delete('public/uploads/'.$staff->profile_image);
            $path = $request->file('profile_image')->store('images/'.$staff->id.'/avatar','public');
            $staff->profile_image = $path;
        }

        if(isset($request->citizenship_image)){

            //first delete previous profile picture from storage
            Storage::delete('public/uploads/'.$staff->citizenship_image);
            $path = $request->file('citizenship_image')->store('images/'.$staff->id.'/citizenship','public');
            $staff->citizenship_image = $path;
        }

        // dd($staff);

        $staff->save();

        Session::flash('success', 'Staff details was successfully updated');

        return redirect()->route('profile.view',$id);

    }
}
