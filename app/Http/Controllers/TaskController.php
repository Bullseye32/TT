<?php

namespace App\Http\Controllers;

use Session;
use App\Task;
use App\User;
use App\TaskRemark;
use App\Helper\Tools;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;

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
        $remarks = TaskRemark::where('task_id', $id)->with('remarkedBy')->get();
        // dd($remarks);
        return view('pages.task.view')->with('tasks', $tasks)->with('assigned', $assigned)->with('remarks', $remarks);
    }

    public function getAssign(){
        // for listing all staff/employee
        $staff = User::all();
        // gives 'task-list' with 'related-users'
        // with('users')-> no need since it is fetched using ajax
        $task = Task::get();
        // dd($task);
        return view('pages.task.assign')->with('staff',$staff)->with('task', $task);
    }

    public function assign(Request $request){
        // dd($request->request);
        $this -> validate($request, [
            'task' => 'required',
        ]);

        $task= Task::find($request->task);

        // detaches staffs only if new staffs is assigned
        if(isset($request->staff)){
            $task->users()->detach();
        }
        // 'assigned-user-id' updated/synchronized for a 'Task' in pivot-table
        $task->users()->sync($request->staff, false);
        // dd($task->users()->sync($request->staff, false));

        Session::flash('success','Task has been assigned successfully');
        return redirect()->route('task.assign');
    }

    public function getAssignedUserByTaskId(){
        // id can also be fetched using Request
        if(isset($_GET['id'])){
            $task = Task::where('id',$_GET['id'])->with('users')->first();
            $response_data = Tools::setResponse('success','Fetching users data successfull@mukes',$task,'');
        }
        else{
            $response_data = Tools::setResponse('error','Error while Fetching users data','','');
        }
        return ($response_data);
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

    public function addRemarks(Request $request)
    {
        $this -> validate($request, [
            'remarks' => 'max:100',
        ]);
        $remarks = new TaskRemark();
        $remarks->task_id = $request->task_id;
        $remarks->remarks = $request->remarks;
        $remarks->status = $request->task_status;
        $remarks->user_id = Auth::User()->id;
        // dd($remarks);
        $remarks->save();

        $task = Task::find($request->task_id);

        //upload in server folder.
        if(isset($request->file_upload)){
            $upload = $request->file('file_upload')->store('files/'.$request->task_id.'/completed_task', 'public');
            $task->file = $upload;
        }
        // Alter Tasks.status
        $task->status = $request->task_status;
        $task->save();

        return redirect()->back();
    }

    // What is this doing ??? i think unused
    public function status(Request $request, $id)
    {
        $status = Task::find($id);
        $status->status=$request->input('status');

        $status->save();
        Session::flash('success', 'Task status has been changed');
        return redirect()->back();
    }
}
