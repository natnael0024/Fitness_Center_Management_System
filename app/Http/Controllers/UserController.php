<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchManager;
use App\Models\Receptionist;
use App\Models\Specialty;
use App\Models\Trainer;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $roleFilter = request()->input('roleFilter');
            $searchKey = request()->input('searchKey');

            // $users = User::query();
            $users = User::with( ['trainer', 'branchManager', 'receptionist'])
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'member');
            });
            if($roleFilter){
                $users->whereHas('roles',function($query) use ($roleFilter){
                    $query->where('name',$roleFilter);
                });
            }
            if ($searchKey) {
                $users->where(function ($query) use ($searchKey) {
                    $query->where('username', 'like', "%{$searchKey}%")
                          ->where('firstname', 'like', "%{$searchKey}%")
                          ->where('middlename', 'like', "%{$searchKey}%")
                          ->where('lastname', 'like', "%{$searchKey}%")
                          ->orWhere('email', 'like', "%{$searchKey}%");
                });
            }
            // $users = User::whereDoesntHave('roles', function ($query) {
            //     $query->where('name', 'member');
            // })->paginate(10);
            $users = $users
            ->paginate(10)
            ->through(function ($user) {
                if ($user->hasRole('Trainer')) {
                    $user->branch_id = optional($user->trainer)->branch_id;
                } elseif ($user->hasRole('BranchManager')) {
                    $user->branch_id = optional($user->branchManager)->branch_id;
                } elseif ($user->hasRole('Receptionist')) {
                    $user->branch_id = optional($user->receptionist)->branch_id;
                } else {
                    $user->branch_id = null;
                }
                return $user;
            });
        

            // $users = $users->paginate(10);
            $roles = Role::whereNot('name','member')->get();
            $branches = Branch::orderBy('name')->get();
            $specialties = Specialty::orderBy('name')->get();

    
            return view('pages.user-management.users',compact('users','roles','branches','specialties'));
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage(), 'Error');
            return redirect()->back();
        }
    }

    public function getBranchManagers()
    {
        try {
            $users = User::whereHas('roles', function ($query) {
                $query->where('name', 'BranchManager');
            })->paginate(10);
            $roles = Role::all();
    
            return view('pages.user-management.users',compact('users','roles'));
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage(), 'Error');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        try {
            $attributes = request()->validate([
                'username' => 'required|max:255|min:2',
                'firstname' => 'required|max:255|min:2',
                'middlename' => 'required|max:255|min:2',
                'lastname' => 'required|max:255|min:2',
                'gender' => 'required',
                'phone' => 'nullable',
                'email' => 'required|email|max:255|unique:users,email',
                'role' => 'required',
                'branch_id'          => 'nullable|string|max:255',
                'specialties'   => 'array|exists:specialties,id',
            ]);

            // dd(request()->request);
    
            $attributes['password'] = '123456';
            DB::transaction(function () use ($attributes) {
                if(request()->hasFile('avatar')){
                    $avatarName = request()->file('avatar')->store('avatars', 'public');
                    $attributes['avatar'] = 'storage/'.$avatarName;
                }

                $user = User::create([
                    'username'     => $attributes['username'],
                    'firstname'     => $attributes['firstname'],
                    'middlename'     => $attributes['middlename'],
                    'lastname'     => $attributes['lastname'],
                    'gender' => $attributes['gender'],
                    'email'    => $attributes['email'],
                    'phone'    => $attributes['phone'],
                    'password' => bcrypt($attributes['password']),
                    'avatar' => $attributes['avatar'] ?? null
                ]);
    
                $user->assignRole($attributes['role']);

                if($attributes['role'] == 'Trainer'){
                    request()->validate([
                        'branch_id'=>'required',
                    ]);
                    $trainer = Trainer::create([
                        'user_id' => $user->id,
                        'branch_id'     => $attributes['branch_id'] ?? null,
                    ]);
                    if (!empty($attributes['specialties'])) {
                        $trainer->specialties()->sync($attributes['specialties']);
                    }
                }
    
                if($attributes['role'] == 'BranchManager'){
                    request()->validate([
                        'branch_id'=>'required'
                    ]);
                    $bm = BranchManager::create([
                        'user_id' => $user->id,
                        'branch_id'     => $attributes['branch_id'] ?? null,
                    ]);
                }

                if($attributes['role'] == 'Receptionist'){
                    request()->validate([
                        'branch_id'=>'required',
                    ]);
                    $rec = Receptionist::create([
                        'user_id' => $user->id,
                        'branch_id'     => $attributes['branch_id'] ?? null,
                    ]);
                }
            });
            
            Toastr::success('User Created Successfully', 'Success');
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage(), 'Error');
        }
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        // dd(request());
        try {
            $user = User::findOrFail($id);
            $attributes = request()->validate([
                'username'    => 'required|max:255|min:2',
                'firstname'   => 'required|max:255|min:2',
                'middlename'  => 'required|max:255|min:2',
                'lastname'    => 'required|max:255|min:2',
                'gender' => 'required',
                'phone'       => 'nullable',
                'email'       => 'required|email|max:255|unique:users,email,' . $user->id,
                'role'        => 'required',
                'branch_id'   => 'nullable|string|max:255',
                'specialties' => 'array|exists:specialties,id',
                'avatar'      => 'nullable|image|max:2048',
            ]);
            

            DB::transaction(function () use ($user, $attributes) {
                if (request()->hasFile('avatar')) {
                    $avatarName = request()->file('avatar')->store('avatars', 'public');
                    $attributes['avatar'] = 'storage/' . $avatarName;

                    Storage::disk('public')->delete(str_replace('storage/', '', $user->avatar));
                }

                $user->update([
                    'username'   => $attributes['username'],
                    'firstname'  => $attributes['firstname'],
                    'middlename' => $attributes['middlename'],
                    'lastname'   => $attributes['lastname'],
                    'gender' => $attributes['gender'],
                    'email'      => $attributes['email'],
                    'phone'      => $attributes['phone'],
                    'avatar'     => $attributes['avatar'] ?? $user->avatar,
                ]);

                // Sync role
                $user->syncRoles([$attributes['role']]);

                // Clean up previous role-specific data
                $user->trainer()?->delete();
                $user->branchManager()?->delete();
                $user->receptionist()?->delete();

                // Re-create based on new role
                if ($attributes['role'] === 'Trainer') {
                    $trainer = Trainer::create([
                        'user_id'   => $user->id,
                        'branch_id' => $attributes['branch_id'] ?? null,
                    ]);
                    dd($attributes['specialties']);
                    if (!empty($attributes['specialties'])) {
                        $trainer->specialties()->sync($attributes['specialties']);
                    }
                }

                if ($attributes['role'] === 'BranchManager') {
                    BranchManager::create([
                        'user_id'   => $user->id,
                        'branch_id' => $attributes['branch_id'] ?? null,
                    ]);
                }

                if ($attributes['role'] === 'Receptionist') {
                    Receptionist::create([
                        'user_id'   => $user->id,
                         'branch_id' => $attributes['branch_id'] ?? null,
                    ]);
                }
            });
            Toastr::success('User updated successfully', 'Success');
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage(), 'Error');
        }

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $role = $user->getRoleNames()->first();

            if($role == 'BranchManager'){
                BranchManager::where( 'user_id',$user->id)->delete();
            }
            else if($role == 'Trainer'){
                Trainer::where( 'user_id',$user->id)->delete();
            }
            else if($role == 'Receptionist'){
                Receptionist::where( 'user_id',$user->id)->delete();
            }
            $user->delete();
            Toastr::success('User Deleted Successfully', 'Success');
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage(), 'Error');
        }
        return redirect()->back();
    }
}
