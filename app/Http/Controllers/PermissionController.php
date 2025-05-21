<?php
namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;


class PermissionController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index', 'store']]);
    //     $this->middleware('permission:permission-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    // }

    public function index()
    {
        $permissions = Permission::orderBy('name')->paginate(10);
        return view('pages.user-management.permissions',compact('permissions'));
    }

    // Create a new permission
    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255|unique:permissions,name',
            ]);

            $permission = Permission::create(['name' => $request->input('name'),'guard_name'=>'web']);

            Toastr::success('Permission created successfully', 'Success');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
        }
        return redirect()->back();
    }

    // Show a specific permission
    public function show($id)
    {
        try {
            $permission = Permission::findOrFail($id);
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage(), 'Error');
        }
    }

    // Update an existing permission
    public function update(Request $request, $id)
    {
        try {
            $permission = Permission::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
            ]);

            $permission->name = $request->input('name');
            $permission->save();

            Toastr::success('Permission updated successfully', 'Success');
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage(), 'Error');
        }
        return redirect()->back();
    }

    // Delete a permission
    public function destroy($id)
    {
        try {
            DB::table('permissions')->where('id', $id)->delete();
            Toastr::success('Permission deleted successfully', 'Success');
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage(), 'Error');
        }
        return redirect()->back();
    }
}
