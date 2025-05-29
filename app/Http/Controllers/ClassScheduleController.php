<?php
namespace App\Http\Controllers;

use App\Models\ClassSchedule;
use App\Models\GymClass;
use Illuminate\Http\Request;
use Validator;

class ClassScheduleController extends Controller
{
    public function index()
    {
        $classFilter = request()->input('classFilter');
        $schedules = ClassSchedule::with('class');
        if($classFilter){
            $schedules->where('class_id',$classFilter);
        }
        $schedules = $schedules->paginate(10);
        $classes = GymClass::orderBy('title')->get();
        return view('pages.classes.schedules', compact('schedules','classes'));
    }

    public function create()
    {
        $classes = GymClass::all();
        $weekdays = $this->weekdays();
        return view('class_schedules.create', compact('classes', 'weekdays'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'class_id'   => 'required|exists:classes,id',
    //         'weekday'    => 'required|in:1,2,3,4,5,6,7',
    //         'start_time' => 'required|date_format:H:i',
    //         'end_time'   => 'required|date_format:H:i|after:start_time',
    //     ]);

    //     try {
    //         ClassSchedule::create($request->all());
    //         toastr()->success('Class schedule created successfully');
    //         return redirect()->route('class-schedules.index');
    //     } catch (\Throwable $e) {
    //         toastr()->error('Failed to create schedule: ' . $e->getMessage());
    //         return back()->withInput();
    //     }
    // }
    
    public function store(Request $request)
    {
        try {
            // dd($request);
            $request->validate([
                'class_id' => 'required|exists:classes,id',
                'days'     => 'required|array',
            ]);

            $validatedSchedules = [];

            foreach ($request->input('days') as $day => $data) {
                if (isset($data['active'])) {
                    $dayData = Validator::make($data, [
                        'start' => 'required|date_format:H:i',
                        'end'   => 'required|date_format:H:i|after:start',
                    ])->validate();

                    $validatedSchedules[] = [
                        'class_id'   => $request->input('class_id'),
                        'weekday'    => (int)$day,
                        'start_time' => $dayData['start'],
                        'end_time'   => $dayData['end'],
                    ];
                }
            }

            foreach ($validatedSchedules as $schedule) {
                ClassSchedule::create($schedule);
            }

            toastr()->success('Class schedule created successfully');
            return redirect()->back();
        } catch (\Throwable $e) {
            toastr()->error('Failed to create schedule: ' . $e->getMessage());
            return back()->withInput();
        }
    }


    public function edit(ClassSchedule $classSchedule)
    {
        $classes = GymClass::all();
        $weekdays = $this->weekdays();
        return view('class_schedules.edit', compact('classSchedule', 'classes', 'weekdays'));
    }

    public function update(Request $request, ClassSchedule $classSchedule)
    {
        $request->validate([
            'class_id'   => 'required|exists:classes,id',
            'weekday'    => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i|after:start_time',
        ]);

        try {
            $classSchedule->update($request->all());
            toastr()->success('Class schedule updated successfully');
            return redirect()->route('class-schedules.index');
        } catch (\Throwable $e) {
            toastr()->error('Failed to update schedule: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function destroy(ClassSchedule $classSchedule)
    {
        try {
            $classSchedule->delete();
            toastr()->success('Class schedule deleted successfully');
        } catch (\Throwable $e) {
            toastr()->error('Failed to delete schedule: ' . $e->getMessage());
        }

        return redirect()->route('class-schedules.index');
    }

    public function show($id)
    {
        $classSchedule = ClassSchedule::findOrFail($id);
        return view('class_schedules.show', compact('classSchedule'));
    }

    private function weekdays()
    {
        return ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    }
}
