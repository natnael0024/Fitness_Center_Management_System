<?php
namespace App\Http\Controllers;

use App\Models\ClassSchedule;
use App\Models\GymClass;
use DB;
use Illuminate\Http\Request;
use Validator;

class ClassScheduleController extends Controller
{
    public function index()
    {
        $classFilter = request()->input('classFilter');
        $branchFilter = request()->input('branchFilter');
        $startTime = request()->input('startTime');
        $endTime = request()->input('endTime');
    
        $schedules = ClassSchedule::with('class.branch');
    
        if ($classFilter) {
            $schedules->where('class_id', $classFilter);
        }
    
        if ($branchFilter) {
            $schedules->whereHas('class', function ($query) use ($branchFilter) {
                $query->where('branch_id', $branchFilter);
            });
        }
    
        if ($startTime) {
            $schedules->where('start_time', '>=', $startTime);
        }
    
        if ($endTime) {
            $schedules->where('end_time', '<=', $endTime);
        }
    
        $schedules = $schedules->get()->groupBy('weekday');
    
        $classes = GymClass::orderBy('title')->get();
        $branches = \App\Models\Branch::orderBy('name')->get();
    
        return view('pages.classes.schedules', compact('schedules', 'classes', 'branches'));
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
    
    // public function store(Request $request)
    // {
    //     try {
    //         // dd($request->request);
    //         $request->validate([
    //             'class_id' => 'required|exists:classes,id',
    //             'days'     => 'required|array',
    //         ]);

    //         $validatedSchedules = [];

    //         foreach ($request->input('days') as $day => $data) {
    //             if (isset($data['active'])) {
    //                 $dayData = Validator::make($data, [
    //                     'start' => 'required|date_format:H:i',
    //                     'end'   => 'required|date_format:H:i|after:start',
    //                 ])->validate();

    //                 $validatedSchedules[] = [
    //                     'class_id'   => $request->input('class_id'),
    //                     'weekday'    => (int)$day,
    //                     'start_time' => $dayData['start'],
    //                     'end_time'   => $dayData['end'],
    //                 ];
    //             }
    //         }

    //         foreach ($validatedSchedules as $schedule) {
    //             ClassSchedule::create($schedule);
    //         }

    //         toastr()->success('Class schedule created successfully');
    //         return redirect()->back();
    //     } catch (\Throwable $e) {
    //         toastr()->error('Failed to create schedule: ' . $e->getMessage());
    //         return back()->withInput();
    //     }
    // }
    public function store(Request $request)
    {
        try {
            $classId = $request->input('class_id'); // Assuming this is sent with the form
            $newData = $request->input('days', []);
    
            foreach ($newData as $day => $schedules) {
                foreach ($schedules as $entry) {
                    // Validate each time slot
                    $validated = Validator::make($entry, [
                        'start' => 'required|date_format:H:i',
                        'end'   => 'required|date_format:H:i|after:start',
                    ])->validate();
    
                    // Create schedule
                    ClassSchedule::create([
                        'class_id'   => $classId,
                        'weekday'    => $day,
                        'start_time' => $validated['start'],
                        'end_time'   => $validated['end'],
                    ]);
                }
            }
    
            toastr()->success('Class schedules added successfully.');
            return redirect()->back();
    
        } catch (\Throwable $e) {
            toastr()->error('Creation failed: ' . $e->getMessage());
            return back()->withInput();
        }
    }
    

    public function edit(ClassSchedule $classSchedule)
    {
        $classes = GymClass::all();
        $weekdays = $this->weekdays();
        return view('class_schedules.edit', compact('classSchedule', 'classes', 'weekdays'));
    }

    // public function update(Request $request, $classId)
    // {
    //     try {
    //         $class = GymClass::with('schedules')->findOrFail($classId);
    //         $existingSchedules = $class->schedules->keyBy('weekday'); // Weekday => Schedule
    //         $newData = $request->input('days', []);
    //         foreach (range(1, 7) as $day) {
    //             $isActive = isset($newData[$day]['active']);
    //             // dd($isActive);
    //             if ($isActive) {
    //                 $validated = Validator::make($newData[$day], [
    //                     'start' => 'required|date_format:H:i',
    //                     'end'   => 'required|date_format:H:i|after:start',
    //                 ])->validate();
    
    //                 if ($existingSchedules->has($day)) {
    //                     // Update existing schedule
    //                     $existingSchedules[$day]->update([
    //                         'start_time' => $validated['start'],
    //                         'end_time'   => $validated['end'],
    //                     ]);
    //                 } else {
    //                     // Create new schedule
    //                     ClassSchedule::create([
    //                         'class_id'   => $classId,
    //                         'weekday'    => $day,
    //                         'start_time' => $validated['start'],
    //                         'end_time'   => $validated['end'],
    //                     ]);
    //                 }
    //             } else {
    //                 // Delete if previously existed but now unchecked
    //                 if ($existingSchedules->has($day)) {
    //                     $existingSchedules[$day]->delete();
    //                 }
    //             }
    //         }
    
    //         toastr()->success('Class schedule updated successfully.');
    //         return redirect()->back();
    //     } catch (\Throwable $e) {
    //         toastr()->error('Update failed: ' . $e->getMessage());
    //         return back()->withInput();
    //     }
    // }

    
    public function update(Request $request, $classId)
    {
        try {
            $newData = $request->input('days', []);
            
            // dd($newData);
            DB::transaction(function () use ($classId, $newData) {
                $class = GymClass::with('schedules')->findOrFail($classId);
    
                // Delete all existing schedules
                $class->schedules()->delete();
    
                // Loop through each day's submitted time slots
                foreach ($newData as $day => $schedules) {
                    foreach ($schedules as $entry) {
                        // Validate each entry
                        $validated = Validator::make($entry, [
                            'start' => 'required|date_format:H:i',
                            'end'   => 'required|date_format:H:i|after:start',
                            ])->validate();
                        // dd(count($schedules));
    
                        // Create new schedule
                        ClassSchedule::create([
                            'class_id'   => $classId,
                            'weekday'    => $day,
                            'start_time' => $validated['start'],
                            'end_time'   => $validated['end'],
                        ]);
                    }
                }
            });
    
            toastr()->success('Class schedule updated successfully.');
            return redirect()->back();
    
        } catch (\Throwable $e) {
            toastr()->error('Update failed: ' . $e->getMessage());
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