<?php

namespace App\Http\Controllers;

use App\Permission;
use App\PermissionRole;
use App\Role;
use App\UserRole;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->getActiveRole();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all()->where('name', '<>', 'admin');
        return view('admin.role.createOrUpdate', compact('permissions'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create($request->except(['permission', '_token']));

        foreach ($request->permission as $key=>$value) {
            $role->attachPermission($value);
        }

        return json_encode('success');
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
        $role = Role::all()->where('id', $id)->where('is_active', true)->first();
        $selectedPermissions = PermissionRole::all()->where('role_id', $role->id);
        $permissions = Permission::all()->where('name', '<>', 'admin');
        $isEdit = true;
        return view('admin.role.createOrUpdate', compact(['role','id', 'selectedPermissions', 'permissions', 'isEdit']));

        //
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
        $role = Role::where('id', $id)->where('is_active', true)->first();
        if ($role != null){
            $role->display_name = $request->get('display_name');
            $role->description = $request->get('description');

            $role->savePermissions($request->get('permission'));

            $role->save();
            return json_encode("success");
        }

        return json_encode('error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $role = Role::find($id);
//        $role->is_active = false;
//
//        $role->save();
//
//        $roles = $this->getActiveRole();
//        return view('admin.role.index', compact('roles'));
        //
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255']);
    }

    private function getActiveRole() {
        return  $roles = Role::all()->where('is_active', true);
    }
}
