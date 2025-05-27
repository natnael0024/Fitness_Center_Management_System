<?php
namespace App\Http\Controllers;

use App\Models\MembershipPlan;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class MembershipPlanController extends Controller
{
    public function index()
    {
        try {
            $membershipPlans = MembershipPlan::paginate(10);
            return view('pages.membership_plans.index', compact('membershipPlans'));
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage(),'Failed');
            return redirect()->back();
        }
    }

    // Show form to create new plan
    public function create()
    {
        return view('pages.membership_plans.create');
    }

    // Store new plan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'price'                 => 'required|numeric|min:0',
            'duration_days'         => 'required|integer|min:1',
            // 'includes_classes'      => 'required|boolean',
            // 'max_classes_per_week'  => 'nullable|integer|min:0',
        ]);

        MembershipPlan::create($validated);

        return redirect()->route('membership-plans.index')->with('success', 'Membership plan created successfully.');
    }

    public function show($id)
    {   
        try {
            $membershipPlan = MembershipPlan::findOrFail($id);
            return view('membership_plans.show', compact('membershipPlan'));
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage(),'Error');
            return redirect()->back();
        }
    }

    // Show edit form
    public function edit(MembershipPlan $membershipPlan)
    {
        return view('membership_plans.edit', compact('membershipPlan'));
    }

    // Update plan
    public function update(Request $request, MembershipPlan $membershipPlan)
    {
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'price'                 => 'required|numeric|min:0',
            'duration_days'         => 'required|integer|min:1',
            // 'includes_classes'      => 'required|boolean',
            // 'max_classes_per_week'  => 'nullable|integer|min:0',
        ]);

        $membershipPlan->update($validated);

        return redirect()->route('membership-plans.index')->with('success', 'Membership plan updated successfully.');
    }

    // Delete plan
    public function destroy($id)
    {
        try {
            $membershipPlan = MembershipPlan::findOrFail($id);
            $membershipPlan->delete();
            Toastr::success('Deleted','Success');
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage(),'Error');
        }

        return redirect()->back();
    }
}
