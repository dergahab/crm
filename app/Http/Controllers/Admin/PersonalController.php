<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonalStore;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PersonalController extends Controller
{
    public function __construct()
    {
        $postions = Position::orderBy('name','asc')->get();
        $departments  = Department::orderBy('name','asc')->get();
        view()->share('postions' ,$postions);
        view()->share('departments' ,$departments);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $this->canOrAbort('personal.index');
       return view('admin.pages.personal.index');
    }

    public function list(){
        $items = User::where('type','worker')->with(['department','position'])
        ->get();
        return response()->json([
            'code' => 200,
            'data' => $items
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonalStore $request)
    {
       $data = [
        'name'          => $request->post('name'),
        'surname'       => $request->post('surname'),
        'password'      => Hash::make($request->post('password')),
        'email'         => $request->post('email'),
        'position_id'   => $request->post('position_id'),
        'department_id' => $request->post('department_id'),
       ];

       User::create($data );
       
       return response()->json([
        'code' => 200,
        'data' => $request->validated()
       ]);
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
        $item = User::find($id);

        return response()->json([
            'code' => 200,
            'data' => $item
        ]);
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
        $data = [
            'name'          => $request->post('name'),
            'surname'       => $request->post('surname'),
            'password'      => Hash::make($request->post('password')),
            'email'         => $request->post('email'),
            'position_id'   => $request->post('position_id'),
            'department_id' => $request->post('department_id'),
           ];
    
           User::where('id',$id )->update($data);
           
           return response()->json([
            'code' => 200,
            'data' => $request->validated()
           ]);
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
