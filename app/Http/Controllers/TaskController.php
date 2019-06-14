<?php

namespace App\Http\Controllers;

use Session;
use App\Task;
use App\User;
use App\Helper\Tools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$task_list = Task::orderBy('id', 'desc')->with('users','creator')->get();
        // dd($task_list);
         return view('pages.task.index')->with('task_list', $task_list);
    }

    public function completedTask(){
        $task = Task::orderBy('id','desc')->where('status',3)->with('users','creator')->get();
        return view('pages.task.index')->with('task_list', $task);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // with('whereTask')-> to count() assigned_task to user
        $staff = User::with('whereTask')->get();
        // dd($staff);
        return view('pages.task.create_task')->with('staff', $staff);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
    		'title' => 'required|max:100',
    		'deadline' => 'required|numeric',
            'priority' => 'required',
            'client_name' => 'required'
    		]);

    	//validating optional field
    	if(isset($request->client_number)){
    	    $this->validate($request,[
                'client_number' => 'max:10'
            ]);
        }

    	if(isset($request->client_latitude)){
    	    $this->validate($request,[
                'client_latitude' => 'numeric|between:0,999.99'
            ]);
        }

    	if(isset($request->client_longitude)){
    	    $this->validate($request,[
                'client_longitude' => 'numeric|between:0,999.99'

            ]);
        }

        $task = new Task;

        $task->taskName = $request->title;
        // converting days into date before storing in DB
        $task->deadline = date('Y-m-d', strtotime("+".$request->deadline." days") );
        $task->description=$request->description;

        $task->priority=$request->priority;
        $task->taskType=$request->task_type;

        $task->clientName=$request->client_name;
        $task->clientNumber=$request->client_number;
        $task->clientLatitude=$request->client_latitude;
        $task->clientLongitude=$request->client_longitude;

        $task->created_at = date('Y-m-d H:i:s');
        $task->createdBy = \Auth::user()->id;

        $task->save(); //saved to 'tasks' table
        // dd($request->staff);

        // attached "assigned employee" info from "users" table in the above created "new-task"
        $task->users()->sync($request->staff, false);

        // starts setting notification
        // if(isset($request->staff)){
        //     //retrieve assigned user.
        //     $assigned_user = array();

        //     foreach ($request->staff as $value){
        //         $assigned_user[] = User::find($value);
        //     }

        //     foreach ($assigned_user as  $value) {
        //         $this->notification($value->firebase_token, $request->title,$request->description);

        //         $notification = new TaskNotification();
        //         $notification->name = $request->title;
        //         $notification->user_id = $value->id;
        //         $notification->description = $request->description;
        //         $notification->save();
        //         // saves to table = task_notifications
        //     }

        //     Session::flash('success','New Task Successfully Created With Notification To App User');
        //  } //-ends notification

        Session::flash('success','New Task Successfully Created');
    	return redirect()->route('task.list');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewTask($id)
    {
        $tasks = Task::find($id);
        $assigned = Task::find($id)->users;
        // dd($assigned);
        return view('pages.task.view')->with('tasks', $tasks)->with('assigned', $assigned);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task_edit = Task::find($id);
        // dd($task_edit);
        return view('pages.task.edit')->with('task_edit', $task_edit);
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
        $this->validate($request, [
            'title' => 'required|max:100',
    		'deadline' => 'required|date',
            'priority' => 'required',
            'client_name' => 'required'
            ]);

        //validating optional field
        if(isset($request->client_number)){
            $this->validate($request,[
                'client_number' => 'min:10'
            ]);
        }

        if(isset($request->client_latitude)){
            $this->validate($request,[
                'client_latitude' => 'numeric|between:0,999.99'
            ]);
        }

        if(isset($request->client_longitude)){
            $this->validate($request,[
                'client_longitude' => 'numeric|between:0,999.99'

            ]);
        }
        $task = Task::find($id);

        $task->taskName=$request->input('title');
        $task->deadline=$request->input('deadline');
        $task->description=$request->input('description');

        $task->priority = $request->priority;
        $task->taskType = $request->task_type;


        $task->clientName=$request->client_name;
        $task->clientNumber=$request->client_number;
        $task->clientLatitude=$request->client_latitude;
        $task->clientLongitude=$request->client_longitude;

        $task->save();

        \Session::flash('success', 'Task has been Updated');
        return redirect()->route('task.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            $responseData = Tools::setResponse('fail','Missing Parameter', '','');
            $status = 422;

            return response()->json($responseData, $status);
        }

        // deleting task
        $data = Task::find($request->id);
        $data->delete();

        $responseData = Tools::setResponse('success','User Deleted Successfully','','');
        return response($responseData,200);
    }
}
