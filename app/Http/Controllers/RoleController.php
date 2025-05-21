<?php
namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
// Toastr::success('Operation successful', 'Success');
// Toastr::info('Informational message', 'Info');
// Toastr::warning('Warning message', 'Warning');
// Toastr::error('Error message', 'Error');

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->paginate(10);
        $permissions = Permission::all();
        return view('pages.user-management.roles',compact('roles','permissions'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                // 'name' => 'required|string|max:255|unique:roles,name',
                'name' => 'required|string|max:255',
                'permissions' => 'required|array',
                // 'permission.*' => 'exists:permissions,id',
            ]);
        
            $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'web']);

            $role->syncPermissions($request->input('permissions'));

            Toastr::success('Role created successfully', 'Success');
        } catch (\Exception $e) {
            // throw $e;
            Toastr::error($e->getMessage(), 'Error');
        }
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        try {
            $role = Role::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
                'permissions' => 'sometimes|array', 
                // 'permission.*' => 'string|exists:permissions,name',
            ]);

            // Update role name
            $role->name = $request->input('name');
            $role->save();

            // Sync permissions if provided
            if ($request->has('permissions')) {
                $role->syncPermissions($request->input('permissions'));
            }
            Toastr::success('Role updated successfully.', 'Success');
        } catch (\Exception $e) {
            Toastr::success($e->getMessage(), 'Success');
        }
        return redirect()->back();

    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        return response()->json($role);
    }

    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            // $role->delete();
            DB::table('roles')->where('id', $id)->delete();
            Toastr::success('Role deleted successfully.', 'Success');
        } catch (\Throwable $th) {
            Toastr::success($th->getMessage(), 'Success');
        }
        return redirect()->back();
    }
}
