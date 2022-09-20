<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }


    public function index()
    {
        if (is_null($this->user) || !$this->user->can('dashboard.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view dashboard !');
        }


        $user = Auth::guard('admin')->user();


        if($user->roles[0]->name == 'employee'){

           $emd =  Admin::find($user->id)->employee;
            $emd->admin_id;

            $adminData = Admin::find($emd->admin_id);

            return view('backend.pages.dashboard.employeeDashboard', compact('emd','adminData'));

        }

        if($user->roles[0]->name == 'employee'){

            $emd =  Admin::find($user->id)->employee;

            return view('backend.pages.dashboard.employeeDashboard', compact('emd'));

        }

        if($user->roles[0]->name == 'superadmin'){
            $total_roles = count(Role::select('id')->get());
            $total_admins = count(Admin::select('id')->get());
            $total_permissions = count(Permission::select('id')->get());
            return view('backend.pages.dashboard.index', compact('total_admins', 'total_roles', 'total_permissions'));

        }






    }



}
