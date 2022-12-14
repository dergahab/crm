<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStore;
use App\Http\Requests\TaskUpdate;
use App\Models\Comment;
use App\Models\File;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TaskController extends Controller
{
    public function __construct()
    {
        $users = User::all();
        $statuses = Status::all();
        view()->share('users', $users);
        view()->share('statuses', $statuses);
    }
    public function index()
    {
        //            $item = Task::with(['user.position','status','priority','files','commnets'])->where('id',3)->first();
        // return print_r($item);
        
        $all = Task::count();
        $new = Task::where('status_id', 1)->count();
        $davam = Task::where('status_id', 2)->count();
        $gozle = Task::where('status_id', 3)->count();
        $tamam = Task::where('status_id', 4)->count();
        return view('admin.pages.task.list', compact(['all', 'new', 'davam', 'gozle', 'tamam']));
    }

    public function list()
    {

        $items = Task::with(['users', 'status', 'priority', 'files'])->get();

        return response()->json([
            'code' => 200,
            'data' => $items
        ]);
    }


    public function store(TaskStore $request)
    {

        $task = new Task($request->validated());
        $task->save();
        $task->user()->attach($request->user_id);

        $data = [];
        if ($request->file) {

            for ($i = 0; $i < count($request->file('file')); $i++) {

                $dPath = 'file/';
                $img   = $request->file('file')[$i];
                $fName = $img->getClientOriginalName();
                $exten = $img->getClientOriginalExtension();;
                $request->file('file')[$i]->storeAs($dPath, $fName);
                $path  = $dPath . '' . $fName;
                Storage::disk('public')->put($path, file_get_contents($request->file('file')[$i]));

                $data['path'] = $path;
                $data['name'] =  $fName;
                $data['type'] =  $exten;
                $data['task_id'] = $task->id;

                File::create($data);
            }
        }


        return  response()->json([
            'code' => 200,
            'data' => $request->all()
        ]);
    }

    public function edit($id)
    {
        $data = Task::with('user')->find($id);
        return  response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }

    public function update(TaskUpdate $request, $id)
    {

        Task::where('id', $id)->update($request->except(['user_id', '_token', '_method', 'file']));

        $task = Task::find($id);
        $task->users()->sync($request->user_id);

        $data = [];
        if ($request->file) {

            for ($i = 0; $i < count($request->file); $i++) {

                $dPath = 'file/';
                $img   = $request->file('file')[$i];
                $fName = $img->getClientOriginalName();
                $exten = $img->getClientOriginalExtension();;
                $request->file('file')[$i]->storeAs($dPath, $fName);
                $path  = $dPath . '' . $fName;
                Storage::disk('public')->put($path, file_get_contents($request->file('file')[$i]));

                $data['path'] = $path;
                $data['name'] =  $fName;
                $data['type'] =  $exten;
                $data['task_id'] = $task->id;

                File::create($data);
            }
        }


        return response()->json([
            'code' => 200,
        ]);
    }

    public function details(Request $request)
    {
        $item = Task::with(['users.position', 'status', 'priority', 'files', 'commnets'])->where('id', $request->id)->first();

        $view = view('admin.pages.task.inc.render', compact('item'))->render();
        return response()->json([
            'code' => 200,
            'data' =>  $view
        ]);
    }

    public function comment(Request $request)
    {
        $data = [
            'user_id' => auth()->user()->id,
            'task_id' => $request->id,
            'content' => $request->content
        ];
        $last =  Comment::create($data);

        $comment = Comment::where('id', $last->id)->with('user')->first();

        $view = view('admin.pages.task.inc.comment_render', compact('comment'))->render();

        return response()->json([
            'code' =>   200,
            'view' => $view
        ]);
    }

    public function destroy($id)
    {
        Task::where('id', $id)->delete();
        return response()->json([
            'code' => 200,
        ]);
    }

    public function file_delete(Request $request){
        File::where('id',$request->id)->delete();
        return response()->json([
            'code' => 200,
        ]);
    }

    public function atendent_delete(Request $request)
    {
        $task = Task::where('id',$request->task)->first();
        $task->users()->sync($request->id);

        return response()->json([
            'code' => 200,
        ]);
    }

    public function file_upload()
    {
        return  response()->json([
            'code' => 200,
            'data' => 'test'
        ]);
    }
}
