<?php

namespace App\Http\Controllers;

use App\User;
use App\Telephone;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;

class TelephoneController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Telephone::orderBy('id','desc')-> with('user_info')->get();
        // $data= User::with('telephone')->get();

        // dd($data);

        return view('pages.telephone.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegister()
    {
        $user_list = User::get();
        $data = Telephone::first(); //to count tele-contacts
        // dd($data);

        return view('pages.telephone.register_telephone')-> with('user_list', $user_list)->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->request);
        $this->validate($request,[
        'contact' => 'required|digits_between:5,12',
        'user_id' => 'required|int',

        ]);

        if(isset($request->ext_number)){
            $this->validate($request,[
                'ext_number' => 'required|digits_between:3,5',
            ]);

        }

        $telephone = new Telephone();

        $telephone->user_id = $request->user_id;
        // $telephone->department = $request->department;
        // $telephone->post = $request->post;

        $telephone->contact = $request->contact;

        $telephone->ext_number = $request->ext_number;
        //  $telephone->created_at = date('Y-m-d H:i:s');
        // dd($telephone);
        $telephone->save();

        Session::flash('success', 'New Telephone Directory Registered Successfully');
        return redirect()->route('telephone.list');
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
        $data = Telephone::where('id', $id)->orderBy('id','desc')->with('user_info')->first();
        // dd($data);
        return view("pages.telephone.edit_telephone")->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'contact' => 'required|digits_between:5,10',
            'ext_number' => 'required|digits_between:3,5',
        ]);
        // dd($request);

        $telephone = Telephone::find($request->telephone_id);

        $telephone->contact = $request->contact;
        $telephone->ext_number = $request->ext_number;
        $telephone->created_at = date('Y-m-d H:i:s');

        $telephone->save();

        Session::flash('success', 'Telephone Directory updated Successfully');
        return redirect()->route('telephone.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'=> 'required',
        ]);

        if ($validator->fails()){
            $responseData = Tools::setResponse('fail', 'Missing Parameter', '','');
            $status = 422;

            return response()->json($responseData, $status);
        }

        // deleting group permission also
        $telephone = Telephone::where('id',$request->id)->first();
        $telephone->delete();

        // $responseData = Tools::setResponse('success', 'Telephone Deleted Successfully','','');
        // return response($responseData,200);
        return "success";
    }
}
