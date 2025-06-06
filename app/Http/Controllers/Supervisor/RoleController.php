<?php

namespace App\Http\Controllers\Supervisor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:عرض صلاحية', ['only' => ['index']]);
        $this->middleware('permission:اضافة صلاحية', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل صلاحية', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $roles = Role::query()->orderBy('id', 'ASC')->where('guard_name','supervisor-web')->paginate('10');
        return view('supervisor.roles.index', compact('roles'));
    }

    public function create()
    {
        $permission = Permission::get();
        return view('supervisor.roles.create', compact('permission'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'guard_name' => 'required',
            'permission' => 'required',
        ]);
        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name' => $request->input('guard_name')
        ]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('supervisor.roles.index')
            ->with('success', trans('main.privilege_added_successfully'));
    }


    public function show($id)
    {
        $role = Role::findOrFail($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();
        return view('supervisor.roles.show', compact('role', 'rolePermissions'));
    }


    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('supervisor.roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('supervisor.roles.index')
            ->with('success', trans('main.privilege_edited_successfully'));
    }

    public function destroy(Request $request)
    {
        DB::table("roles")->where('id', $request->role_id)->delete();
        return redirect()->route('supervisor.roles.index')
            ->with('success', trans('main.privilege_deleted_successfully'));
    }

}
