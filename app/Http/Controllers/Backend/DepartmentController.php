<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class DepartmentController extends Controller
{

    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('department.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        $departments = Department::all();
        return view('backend.pages.departments.index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('department.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }


        return view('backend.pages.departments.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'dep_name'=>'required',
            'priority'=>'required',
            'status'=>'required|numeric|in:1,2'
        ]);

        $departments = new Department();

        $departments->dep_name = $request->dep_name;
        $departments->priority = $request->priority;
        $departments->status = $request->status;

        $departments->save();

        session()->flash('success', 'Department has been created !!');
        return redirect()->route('admin.departments.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('department.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $department = Department::find($id);
        return view('backend.pages.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $departments = Department::find($id);

        $request->validate([
            'dep_name'=>'required',
            'priority'=>'required',
            'status'=>'required|numeric|in:1,2'
        ]);



        $departments->dep_name = $request->dep_name;
        $departments->priority = $request->priority;
        $departments->status = $request->status;

        $departments->save();

        session()->flash('success', 'Department has been updated!!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('department.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        $department = Department::find($id);
        $department->delete();

        session()->flash('success', 'Department has been deleted !!');
        return back();
    }
}
