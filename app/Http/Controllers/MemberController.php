<?php
namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use App\Models\Member;
use App\Models\MembershipPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with('user', 'membershipPlan')->paginate(10);
        $branches = Branch::orderBy('name')->get();
        $membershipPlans = MembershipPlan::orderBy('name')->get();
        return view('pages.members.index', compact('members','branches','membershipPlans'));
    }

    public function create()
    {
        $plans = MembershipPlan::all();
        return view('members.create', compact('plans'));
    }

    public function store(Request $request)
    {
       

        // dd($request->request);

        try {
            $request->validate([
                'username' => 'required|max:255|min:2',
                'firstname' => 'required|max:255|min:2',
                'middlename' => 'required|max:255|min:2',
                'lastname' => 'required|max:255|min:2',
                'gender' => 'required',
                'phone' => 'nullable',
                'email' => 'required|email|max:255|unique:users,email',
                'membership_plan_id'=> 'nullable|exists:membership_plans,id',
                'branch_id'         => 'required|exists:branches,id',
            ]);

            DB::beginTransaction();

            $avatarName = '';
            if(request()->hasFile('avatar')){
                $avatarName = request()->file('avatar')->store('avatars', 'public');
                $avatarName = 'storage/'.$avatarName;
            }

            $user = User::create([
                'username'     => $request->username,
                'firstname'     => $request->firstname,
                'middlename'     => $request->middlename,
                'lastname'     => $request->lastname,
                'gender'     => $request->gender,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'password' => Hash::make('123456'),
                'avatar' => $avatarName
            ]);

            $user->assignRole('Member');

            Member::create([
                'user_id'           => $user->id,
                'membership_plan_id'=> $request->membership_plan_id,
                'branch_id'         => $request->branch_id,
                'join_date'         => now(),
                'status'            => 1,
                'height' => $request->height
            ]);

            DB::commit();

            toastr()->success('Member created successfully');
            return redirect()->route('members.index');

        } catch (\Throwable $e) {
            DB::rollBack();
            toastr()->error('Failed to create member: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function edit(Member $member)
    {
        $plans = MembershipPlan::all();
        return view('members.edit', compact('member', 'plans'));
    }

    public function update(Request $request,$id)
    {
        try {
            $member = Member::findOrFail($id);
            $request->validate([
                'username' => 'required|max:255|min:2',
                'firstname' => 'required|max:255|min:2',
                'middlename' => 'required|max:255|min:2',
                'lastname' => 'required|max:255|min:2',
                'gender' => 'required',
                'phone' => 'nullable',
                'email'             => 'required|email|unique:users,email,' . $member->user_id,
                'password'          => 'nullable|string|min:6|confirmed',
                'membership_plan_id'=> 'nullable|exists:membership_plans,id',
                'branch_id'         => 'required|exists:branches,id',
            ]);

            DB::beginTransaction();

            if(request()->hasFile('avatar')){
                $avatarName = request()->file('avatar')->store('avatars', 'public');
                $request->avatarName = 'storage/'.$avatarName;
                Storage::disk('public')->delete(str_replace('storage/', '', $member->user->avatar));
            }
            // dd($request->status == '0');
            $status = !$request->status == '0';
            // dd($status);
            $member->user->update([
                'username'     => $request->username,
                'firstname'     => $request->firstname,
                'middlename'     => $request->middlename,
                'lastname'     => $request->lastname,
                'gender'     => $request->gender,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'password' => $request->password ? Hash::make($request->password) : $member->user->password,
                'avatar' => $request->avatarName ? $request->avatarName : $member->user->avatar,
                'status'            => $request->status == '0' ? false : true,
            ]);

            $member->update([
                'membership_plan_id' => $request->membership_plan_id,
                'branch_id'          => $request->branch_id,
                'height' => $request->height
            ]);

            DB::commit();

            toastr()->success('Member updated successfully');
            return redirect()->route('members.index');

        } catch (\Throwable $e) {
            DB::rollBack();
            toastr()->error('Failed to update member: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function destroy(Member $member)
    {
        try {
            $member->user->delete();
            toastr()->success('Member deleted successfully');
        } catch (\Throwable $e) {
            toastr()->error('Failed to delete member: ' . $e->getMessage());
        }

        return redirect()->route('members.index');
    }
}
