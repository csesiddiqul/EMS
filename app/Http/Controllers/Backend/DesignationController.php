<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DesignationController extends Controller
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

        if (is_null($this->user) || !$this->user->can('designation.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }



//        $dp_dg  = Department::find(2)->designation;
//
//        return $dp_dg;

        $departments = Department::all();
        $designations = designation::all();

        return view('backend.pages.designations.index',compact('departments','designations'));


    }

    public function getDesList(Request $request)
    {
        $results = Designation::where([['dep_id',$request->dep_id],['status',1]])->orderBy('deg_name')->pluck('deg_name', 'id');

        return response()->json($results);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('designation.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $departments = Department::all();

        return view('backend.pages.designations.create',compact('departments'));

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

            'deg_name'=>'required',
            'dep_id'=>'required',
            'status'=>'required|numeric|in:1,2'
        ]);

        $designation = new designation();

        $designation->deg_name = $request->deg_name;
        $designation->department_id = $request->dep_id;
        $designation->status = $request->status;

        $designation->save();

        session()->flash('success', 'Designation has been created !!');

        return redirect()->route('admin.designations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('designation.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $departments = Department::all();
        $designation = designation::find($id);

        return view('backend.pages.designations.edit', compact('designation','departments'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, designation $designation)
    {
        $request->validate([

            'deg_name'=>'required',
            'dep_id'=>'required',
            'status'=>'required|numeric|in:1,2'
        ]);



        $designation->deg_name = $request->deg_name;
        $designation->department_id = $request->dep_id;
        $designation->status = $request->status;

        $designation->save();

        session()->flash('success', 'Designation has been update !!');

        return redirect()->route('admin.designations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('designation.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to Delete !');
        }
        $designations = designation::find($id);
        $designations->delete();

        session()->flash('success', 'Designation has been deleted !!');
        return back();
    }
}
