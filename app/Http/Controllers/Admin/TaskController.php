<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStore;
use App\Http\Requests\TaskUpdate;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $users = User::all();
        $statuses = Status::all();
        view()->share('users',$users);
        view()->share('statuses',$statuses);

        
    }
    public function index(){
        $all = Task::count();
        $new = Task::where('status_id',1)->count();
        $davam = Task::where('status_id',2)->count();
        $gozle = Task::where('status_id',3)->count();
        $tamam = Task::where('status_id',4)->count();
        return view('admin.pages.task.list',compact(['all','new','davam','gozle','tamam']));
    }
    

    public function list(){

        $items = Task::with(['user','status','priority'])->get();
    
        return response()->json([
                    'code' => 200,
                    'data' => $items
                    ]);
    }


    public function store(TaskStore $request){
        $task = new Task($request->validated());
        $task->save();
        $task->user()->attach($request->user_id);

        return  response()->json([
            'code' => 200,
            'data' =>$request->all()
            ]);
    }

    public function edit($id){
        $data = Task::with('user')->find($id);
        return  response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }

    public function update(TaskUpdate $request ,$id){
        
        Task::where('id',$id)->update($request->except(['user_id','_token','_method']));

        $task = Task::find($id);
        $task->user()->sync($request->user_id);
        
        return response()->json([
            'code' => 200,
        ]);
    }
    
    public function details(Request $request){
        $item = Task::with(['status','priority'])->find($request->id);
        return view('admin.pages.task.details',compact('item'));
    }

   public function destroy ($id){
    Task::where('id',$id)->delete();
    return response()->json([
        'code' => 200,
    ]);
   }
}
