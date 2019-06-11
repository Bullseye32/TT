<?php

namespace App\Http\Controllers;

use App\User;
use App\Telephone;
use Illuminate\Http\Request;
use Session;

class TelephoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Telephone::all();
        // dd($data);

        return view('pages.telephone.index') -> with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegister()
    {
        $staff = User::all();
        // dd($staff);

        return view('pages.telephone.register_telephone')-> with('staff', $staff);
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
        'name' => 'required|max:50',
        'department' => 'required|max:50',
        'post' => 'required|max:50',
        'contact' => 'required|digits_between:5,12',
            // 'ext_number' => 'required|max:5'

        ]);

        if(isset($request->ext_number)){
            $this->validate($request,[
                'ext_number' => 'required|digits_between:3,5',
            ]);

        }


        $telephone = new Telephone();
        $telephone->name = $request->name;
        $telephone->department = $request->department;

        $telephone->post = $request->post;
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
