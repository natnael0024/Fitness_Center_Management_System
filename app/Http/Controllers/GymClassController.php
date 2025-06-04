<?php
namespace App\Http\Controllers;

use App\Models\ClassSchedule;
use App\Models\GymClass;
use App\Models\Trainer;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GymClassController extends Controller
{
    public function index()
    {
        $classes = GymClass::with('trainer', 'branch')->paginate(10);
        $branches = Branch::orderBy('name')->get();
        $trainers = Trainer::get();
        return view('pages.classes.index', compact('classes','branches','trainers'));
    }

    public function create()
    {
        $trainers = Trainer::with('user')->get();
        $branches = Branch::all();
        return view('classes.create', compact('trainers', 'branches'));
    }

    public function store(Request $request)
    {
        try {
            // dd($request);
            $request->validate([
                'title'       => 'required|string|max:255',
                'description' => 'nullable|string',
                'trainer_id'  => 'required|exists:trainers,id',
                'branch_id'   => 'required|exists:branches,id',
                'capacity'    => 'integer|min:1',
                // 'is_premium'  => 'boolean',
                'price'       => 'nullable|numeric|min:0',
            ]);
            $request['is_premium'] = $request->is_premium == 'on' ? true : false;

            GymClass::create($request->all());
            toastr()->success('Class created successfully');
            return redirect()->route('classes.index');
        } catch (\Throwable $e) {
            toastr()->error('Failed to create class: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function edit(GymClass $class)
    {
        $trainers = Trainer::with('user')->get();
        $branches = Branch::all();
        return view('classes.edit', compact('class', 'trainers', 'branches'));
    }

    public function update(Request $request, GymClass $class)
    {
        try {
            $request->validate([
                'title'       => 'required|string|max:255',
                'description' => 'nullable|string',
                'trainer_id'  => 'required|exists:trainers,id',
                'branch_id'   => 'required|exists:branches,id',
                'capacity'    => 'integer|min:1',
                'price'       => 'nullable|numeric|min:0',
            ]);
            $request['is_premium'] = $request->is_premium == 'on' ? true : false;
            $class->update($request->all());
            toastr()->success('Class updated successfully');
            return redirect()->route('classes.index');
        } catch (\Throwable $e) {
            toastr()->error('Failed to update class: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function destroy(GymClass $class)
    {
        try {
            $class->delete();
            toastr()->success('Class deleted successfully');
        } catch (\Throwable $e) {
            toastr()->error('Failed to delete class: ' . $e->getMessage());
        }

        return redirect()->route('classes.index');
    }

    public function show($id)
    {
        try {
            $class = GymClass::findOrFail($id);
            $schedules = ClassSchedule::where('class_id',$class->id)->paginate(10);
            $groupedSchedules = $schedules->groupBy('weekday');
            return view('pages.classes.show', compact('class','schedules','groupedSchedules'));
        } catch (\Throwable $th) {
            toastr()->error('Failed to fetch class schedules : ' . $th->getMessage());
        }
    }
}