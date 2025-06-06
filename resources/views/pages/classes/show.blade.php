@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Classes  /  Schedules'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 ">
                        <div class="d-flex align-items-center justify-content-between">
                            <h6>Class Schedules : <span class="text-primary">{{$class->title}}</span></h6>
                            <div>
                              @if($class->schedules->count() < 1)
                                <a class="font-weight-bold text-xs btn bg-gradient-success  " style="cursor: pointer"
                                  data-bs-target="#addmodal" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Add user">
                                  <span class="d-flex align-items-center gap-2"><i class="fa-solid fas fa-plus "></i>Create Schedule</span>
                                </a>
                              @else
                                    <a class="font-weight-bold text-xs btn bg-gradient-primary  " style="cursor: pointer"
                                    data-bs-target="#editmodal" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Edit user">
                                    <span>Edit Schedule</span>
                                    </a>
                              @endif
                            </div>
                        </div>
                        
                        <div class=" row col-md-6">
                          <div class="col-md-6 ">
                            <form action="">
                                <div class="col-md-12 d-flex align-items-start gap-2 ">
                                    <div class="form-group ">
                                      <div class="input-group mb-4">
                                        <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                        <input name="searchKey" class="form-control" placeholder="Search" type="text">
                                      </div>
                                    </div>
                                    <button class="btn text-white bg-primary">search</button>
                                </div>
                            </form>
                          </div>
                          {{-- <div class="col-md-6 ">
                            <form action="">
                              <div class="col-md-12 d-flex align-items-start gap-2 ">
                                  <select name="roleFilter" class="form-control" id="exampleFormControlSelect1">
                                      <option value="">Class</option>
                                    @foreach ($schedules as $schedule)
                                      <option value="{{$schedule->id}}">{{$schedule->title}}</option>
                                    @endforeach
                                  </select>
                                  <button class="btn text-white bg-primary"><i class="fa-solid fa-filter"></i>
                                  </button>
                              </div>
                            </form>
                          </div> --}}
                        </div>
                    </div>
                    @php
                    $weekdays = [
                        1 => 'Sunday',
                        2 => 'Monday',
                        3 => 'Tuesday',
                        4 => 'Wednesday',
                        5 => 'Thursday',
                        6 => 'Friday',
                        7 => 'Saturday',
                    ];
                @endphp
                
                    
                    <div class="card-body px-0 pt-0 pb-2">
                     
                        <div class="table-responsive p-0">
                            {{-- <table class="table align-items-center mb-0" id="tableView">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            #</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Branch</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Weekday</th>
                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Start Time</th>
                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            End Time</th>
                                        
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedules as $index=>$schedule)
                                    <tr>
                                        <td class="">
                                          <p class="text-xs ms-3 font-weight-bold mb-0">{{$index+1}}</p>
                                        </td>
                                        <td class="">
                                            <p class="text-xs font-weight-bold mb-0">{{$schedule->class->branch->name}}</p>
                                        </td>
                                        <td class="align-middle  text-sm ">
                                            @if ($schedule->weekday == 1)
                                                <p class="text-xs font-weight-bold mb-0">Ehud</p>
                                            @elseif($schedule->weekday == 2)
                                                <p class="text-xs font-weight-bold mb-0">Segno</p>
                                            @elseif($schedule->weekday == 3)
                                                <p class="text-xs font-weight-bold mb-0 ">Maksegno</p>
                                            @elseif($schedule->weekday == 4)
                                                <p class="text-xs font-weight-bold mb-0">Rebu</p>
                                            @elseif($schedule->weekday == 5)
                                                <p class="text-xs font-weight-bold mb-0">Hamus</p>
                                            @elseif($schedule->weekday == 6)
                                                <p class="text-xs font-weight-bold mb-0">Arb</p>
                                            @elseif($schedule->weekday == 7)
                                                <p class="text-xs font-weight-bold mb-0">Kdame</p>
                                            @endif
                                        </td>
                                        <td class="">
                                            <p class="text-xs text-center font-weight-bold mb-0 ">
                                              {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->start_time)->format('h:i A') }}
                                            </p>
                                        </td>
                                        <td class="">
                                            <p class="text-xs text-center font-weight-bold mb-0 ">
                                                {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->end_time)->format('h:i A') }}
                                            </p>
                                          </td>
                                        

                                        <div class="modal fade " id="deletemodal{{$schedule->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered  modal-md" role="document">
                                              <div class="modal-content card card-body  ">
                                                <div class="modal-header">
                                                  <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                  </button>
                                                </div>
                                                <form action="{{route('users.destroy',$schedule->id)}}" method="post">
                                                  @method('DELETE')
                                                  @csrf
                                                  <div class="modal-body ">
                                                      <div class="py-3 text-center  ">
                                                        <i class="ni ni-bell-55 ni-3x text-danger"></i>
                                                        <h4 class="text-gradient text-danger mt-2">Are you sure?</h4>
                                                        <p class="text-secondary">Are you sure to delete this user permanently? this action is irreversible!</p>
                                                      </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="submit" class="btn btn-round btn-white bg-primary text-white">Yes, Delete</button>
                                                      <button type="reset" class="btn btn-round btn-link bg-secondary text-white text-white ml-auto" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                              </div>
                                            </div>
                                        </div>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> --}}
                            <div class="container">
                              <div class="row text-center mb-3 ">
                                  @foreach ($weekdays as $dayNum => $dayName)
                                      <div class="col-12 col-sm-6 col-md-3 col-lg-2 col-xl-3 mb-4">
                                          <div class="border rounded p-3 h-100" style="background-color: #f8f9fa16;">
                                              <h6 class="text-primary text-uppercase fw-bold mb-3">{{ $dayName }}</h6>
                                              @if (isset($groupedSchedules[$dayNum]))
                                                  @foreach ($groupedSchedules[$dayNum] as $schedule)
                                                      <div class=" rounded-3 mb-2 shadow-sm bg-gradient-success">
                                                          <div class="card-body p-2 row">
                                                              {{-- <h6 class="card-title mb-1" style="font-size: 0.85rem; color: white;">
                                                                  {{ $schedule->class->title }}
                                                              </h6> --}}
                                                              <span class="mb-0" style="font-size: 0.75rem; color: white;">
                                                                  Branch: {{ $schedule->class->branch->name }}
                                                              </span>
                                                              <span class="mb-0" style="font-size: 0.9rem; color: white;">
                                                                  {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->start_time)->format('h:i A') }}
                                                                  -
                                                                  {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->end_time)->format('h:i A') }}
                                                              </span>
                                                          </div>
                                                      </div>
                                                  @endforeach
                                              @else
                                                  <p class="text-muted" style="font-size: 0.8rem;">No classes</p>
                                              @endif
                                          </div>
                                      </div>
                                  @endforeach
                              </div>
                          </div>
                            <div class="flex justify-center mt-4">
                            </div>

                            {{-- create --}}
                            <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-body p-0">
                                      <div class="card card-plain">
                                        <div class="card-header pb-0 text-left">
                                          <h3 class="font-weight-bolder text-dark">Add Class</h3>
                                          <p>Add Time Slots and Enter Start/End Times</p>
                                        </div>
                                        <div class="card-body">
                                          @php
                                              $days = [1 => 'Sunday', 2 => 'Monday', 3 => 'Tuesday', 4 => 'Wednesday', 5 => 'Thursday', 6 => 'Friday', 7 => 'Saturday'];
                                          @endphp
                                          <form method="POST" action="{{ route('class-schedules.store') }}">
                                            @csrf
                                            <input type="hidden" name="class_id" value="{{ $class->id }}">
                                          
                                            @foreach($days as $dayValue => $dayName)
                                                <div class="day-schedule-block mb-3 border p-2 rounded">
                                                  <label>{{ $dayName }}</label>
                                                  <div id="schedule-list-{{ $dayValue }}"></div>
                                                  <button onclick="addScheduleEntry({{ $dayValue }})" class="btn btn-icon btn-3 btn-success" type="button">
                                                    <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                                                    <span class="btn-inner--text">Add Time Slot</span>
                                                  </button>
                                                </div>
                                            @endforeach
                                            <div class="modal-footer">
                                              <button type="submit" class="btn btn-round bg-primary text-white">Create</button>
                                              <button type="reset" data-bs-dismiss="modal" class="btn btn-round bg-secondary text-white">Cancel</button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>

                            {{-- edit --}}
                            <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                  <div class="modal-body p-0">
                                    <div class="card card-plain">
                                      <div class="card-header pb-0 text-left">
                                        <h3 class="font-weight-bolder text-dark">Edit Schedule</h3>
                                        <p>Add Time Slots and Enter Start/End Times</p>
                                      </div>
                                      <div class="card-body">
                                        <form method="POST" action="{{ route('class-schedules.update', $class->id) }}">
                                          @csrf
                                          @method('PUT')
                                          @php
                                              $days = [1 => 'Sunday', 2 => 'Monday', 3 => 'Tuesday', 4 => 'Wednesday', 5 => 'Thursday', 6 => 'Friday', 7 => 'Saturday'];
                                          @endphp
                                          @foreach($days as $dayValue => $dayName)
                                              <div class="day-schedule-block mb-3 border p-2 rounded">
                                                <label class="font-weight-bold">{{ $dayName }}</label>
                                                <div id="schedule-list-edit{{ $dayValue }}">
                                                    @php
                                                        $schedules = $class->schedules->where('weekday', $dayValue);
                                                    @endphp
                                                    @forelse ($schedules as $index => $schedule)
                                                        <div class="schedule-entry row g-2 mb-2">
                                                            <div class="col-md-5">
                                                                <input type="time" name="days[{{ $dayValue }}][{{ $index }}][start]" class="form-control"
                                                                       value="{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}">
                                                            </div>
                                                            <div class="col-md-5">
                                                                <input type="time" name="days[{{ $dayValue }}][{{ $index }}][end]" class="form-control"
                                                                       value="{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button type="button" class="btn btn-danger btn-sm" onclick="removeScheduleEntryEdit(this)">Remove</button>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <!-- Empty input if no existing schedules -->
                                                    @endforelse
                                                </div>
                                                <button onclick="addScheduleEntryEdit({{ $dayValue }})" class="btn btn-icon btn-3 btn-success" type="button">
                                                  <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                                                  <span class="btn-inner--text">Add Time Slot</span>
                                                </button>
                                              </div>
                                          @endforeach
                                                
                                          <div class="modal-footer">
                                              <button type="submit" class="btn btn-round bg-primary text-white">Update</button>
                                              <button type="reset" data-bs-dismiss="modal" class="btn btn-round bg-secondary text-white">Cancel</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                            
                        </div>
                        <!-- Calendar View -->
                        <div id="calendarView" style="display: none;">
                          <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>

<style>
.custom-checkbox-wrapper {
  display: flex;
  align-items: center;
  width: fit-content;
  gap: 0.5rem;
  font-family: sans-serif;
}

/* Hide the default checkbox */
.custom-checkbox {
  appearance: none;
  -webkit-appearance: none;
  width: 20px;
  height: 20px;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f0f0f0;
  cursor: pointer;
  position: relative;
  transition: background-color 0.2s, border-color 0.2s;
}

/* Checked state */
.custom-checkbox:checked {
  /* background-color: #0d6efd;  */
  background-color: #0d65fd; 
  border-color: #1068ffcf;
}

/* Checkmark (using ::after) */
.custom-checkbox:checked::after {
  content: "";
  position: absolute;
  top: 4px;
  left: 6px;
  width: 4px;
  height: 8px;
  border: solid #ffffff;
  border-width: 0 3px 3px 0;
  transform: rotate(45deg);
}

/* Focus state */
.custom-checkbox:focus {
  outline: none;
  box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.25);
}

/* Disabled state */
.custom-checkbox:disabled {
  background-color: #e9ecef;
  border-color: #dee2e6;
  cursor: not-allowed;
}

</style>
<style>
  .calendar-row {
      display: flex;
      justify-content: space-between;
  }
  .calendar-day {
      width: 13%;
      border: 1px solid #ddd;
      padding: 10px;
      min-height: 150px;
      background-color: #f8f9fa;
  }
</style>


<script>
    function toggleTimeInputs(checkbox, day) {
        const container = document.getElementById('time-inputs-' + day);
        container.style.display = checkbox.checked ? 'block' : 'none';
    }
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const element = document.getElementById('choices-multiple-remove-button');
    new Choices(element, {
      removeItemButton: true
    });
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const element = document.getElementById('choices-multiple-remove-button-2');
    new Choices(element, {
      removeItemButton: true
    });
  });
</script>

<script>
  // edit
  function toggleTimeInputsEdit(checkbox, dayValue) {
    const timeDiv = document.getElementById('time-inputs-edit-' + dayValue);
    timeDiv.style.display = checkbox.checked ? 'block' : 'none';
}
</script>


{{-- new --}}

<script>
  // adding
  function addScheduleEntry(dayValue) {
      const container = document.getElementById('schedule-list-' + dayValue);
  
      const index = container.children.length;
  
      const row = document.createElement('div');
      row.classList.add('schedule-entry', 'row', 'g-2', 'mb-2');
  
      row.innerHTML = `
          <div class="col-md-5">
              <input type="time" required name="days[${dayValue}][${index}][start]" class="form-control">
          </div>
          <div class="col-md-5">
              <input type="time" required name="days[${dayValue}][${index}][end]" class="form-control">
          </div>
          <div class="col-md-2">
            <button onclick="removeScheduleEntry(this)" class="btn btn-icon btn-2 btn-danger" type="button">
            	<span class="btn-inner--icon"><i class="ni ni-fat-remove"></i></span>
            </button>
          </div>
      `;
  
      container.appendChild(row);
  }
  
  function removeScheduleEntry(button) {
      button.closest('.schedule-entry').remove();
  }
  </script>

<script>
  // editing
  function addScheduleEntryEdit(dayValue) {
      const container = document.getElementById('schedule-list-edit' + dayValue);
  
      const index = container.children.length;
  
      const row = document.createElement('div');
      row.classList.add('schedule-entry', 'row', 'g-2', 'mb-2');
  
      row.innerHTML = `
          <div class="col-md-5">
              <input type="time" required name="days[${dayValue}][${index}][start]" class="form-control">
          </div>
          <div class="col-md-5">
              <input type="time" required name="days[${dayValue}][${index}][end]" class="form-control">
          </div>
          <div class="col-md-2">
            <button onclick="removeScheduleEntry(this)" class="btn btn-icon btn-2 btn-danger" type="button">
            	<span class="btn-inner--icon"><i class="ni ni-fat-remove"></i></span>
            </button>
          </div>
      `;
  
      container.appendChild(row);
  }
  
  function removeScheduleEntryEdit(button) {
      button.closest('.schedule-entry').remove();
  }
  </script>
  
@endsection