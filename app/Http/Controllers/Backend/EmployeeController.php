<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Department;
use App\Models\designation;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
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

        if (is_null($this->user) || !$this->user->can('employee.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $employees = Employee::all();
        $departments = Department::all();
        $designations = designation::all();
        return view('backend.pages.employees.index',compact('employees','departments','designations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('employee.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any employee !');
        }

        $departments = Department::all();
        $designations = designation::all();
        $roles  = Role::all();
        return view('backend.pages.employees.create',compact('departments','designations','roles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('employee.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any admin !');
        }
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins',

            'username' => 'required|max:100|unique:admins',
            'id_card' => 'required|max:100|unique:employees',
            'password' => 'required|min:6|confirmed',

            'dep_name' => 'required|numeric',
            'deg_name' => 'required|numeric',
            'birth' => 'required',
            'gender' => 'required',
            'mobile' => 'required|min:11|numeric',
            'emp_nid' => 'digits_between:10,17|required|numeric',
            'nationality' => 'required',
            'religion' => 'required',
            'file' => 'required|file',
        ]);

        // Create New Admin
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();
        $admin_data = $admin->id;
        $emRole = 'employee';
        if ($emRole) {
            $admin->assignRole($emRole);
        }

        $imge = $request->file;
        $storeFileN = $imge->getClientOriginalName();
        $storeLocation = $_SERVER['DOCUMENT_ROOT']. '/Storage/employee/profile';
        $imge->move($storeLocation,$storeFileN);
        $dbsl = '/Storage/employee/profile/'.$storeFileN;

        $employee = new  Employee();
        $employee->name = $request->name;
        $employee->id_card = $request->id_card;
        $employee->birthday = $request->birth;
        $employee->gender = $request->gender;
        $employee->mobile = $request->mobile;
        $employee->nid = $request->emp_nid;
        $employee->nationality = $request->nationality;
        $employee->religion = $request->religion;
        $employee->img = $dbsl;
        $employee->admin_id = $admin_data;
        $employee->department_id = $request->dep_name;
        $employee->designation_id = $request->deg_name;;
        $employee->save();

        session()->flash('success', 'employee has been created !!');
        return redirect()->route('admin.employees.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        if (is_null($this->user) || !$this->user->can('employee.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }
        $employeeData = employee::find($id);
        $adminData = Admin::find($employeeData->admin_id);
        $singaledep = Department::find($employeeData->department_id);
        $singaledeg = designation::find($employeeData->designation_id);
        $departments = Department::all();
        $designations = designation::all();
        $roles  = Role::all();
        return view('backend.pages.employees.edit',compact('departments','designations','roles','employeeData','adminData','singaledep','singaledeg'));

    }


    public function editemp()
    {


        if (is_null($this->user) || !$this->user->can('employee.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }
        $id = $this->user->id;
        $employeeData = Employee::where('admin_id', $id)->first();
        $adminData = $this->user;
        $singaledep = Department::find($employeeData->department_id);
        $singaledeg = designation::find($employeeData->designation_id);
        $departments = Department::all();
        $designations = designation::all();
        $roles  = Role::all();
        return view('backend.pages.employees.edit',compact('departments','designations','roles','employeeData','adminData','singaledep','singaledeg'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,int $id)
    {
        if (is_null($this->user) || !$this->user->can('employee.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }


        $employee =  Employee::find($id);



        $admin = Admin::find($employee->admin_id);
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins,email,' . $admin->id,
            'id_card' => 'required|max:100|unique:employees,id_card,'. $employee->id,
            'password' => 'nullable|min:6|confirmed',
            'dep_name' => 'required|numeric',
            'deg_name' => 'required|numeric',
            'birth' => 'required',
            'gender' => 'required',
            'mobile' => 'required|min:11|numeric',
            'emp_nid' => 'digits_between:10,17|required|numeric',
            'nationality' => 'required',
            'religion' => 'required',
            'file' => 'nullable|file',
        ]);


        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->email = $request->email;
        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();
        $emRole = 'employee';
        if ($emRole) {
            $admin->assignRole($emRole);
        }
        $admin_data = $admin->id;
        $dbsl = $employee->img;
        if ($request->hasFile('file')){
            $imge = $request->file;
            $storeFileN = $imge->getClientOriginalName();
            $storeLocation = $_SERVER['DOCUMENT_ROOT']. '/Storage/employee/profile/';
            $imge->move($storeLocation,$storeFileN);
            $dbsl = '/Storage/employee/profile/'.$storeFileN;
            @unlink(str_replace('/Storage','Storage',$employee->img));
        }

        $employee->name = $request->name;
        $employee->id_card = $request->id_card;
        $employee->birthday = $request->birth;
        $employee->gender = $request->gender;
        $employee->mobile = $request->mobile;
        $employee->nid = $request->emp_nid;
        $employee->nationality = $request->nationality;
        $employee->religion = $request->religion;
        $employee->img = $dbsl;
        $employee->admin_id = $admin_data;
        $employee->department_id = $request->dep_name;
        $employee->designation_id = $request->deg_name;;
        $employee->save();
        session()->flash('success', 'Employee has been updated !!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
