@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Classes  /  Schedules'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 ">
                        <div class="d-flex align-items-center justify-content-between">
                            <h6>Class Schedules</h6>
                            {{-- <div>
                              <a class="font-weight-bold text-xs btn bg-gradient-success  " style="cursor: pointer"
                                data-bs-target="#addmodal" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Add user">
                                <span class="d-flex align-items-center gap-2"><i class="fa-solid fas fa-plus "></i>Add Class</span>
                              </a>
                              <a class="font-weight-bold text-xs btn bg-gradient-success  " style="cursor: pointer"
                                  data-bs-target="#addmodal" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Add user">
                                  <span class="d-flex align-items-center gap-2"><i class="fa-regular fa-calendar"></i>Schedules</span>
                              </a>
                            </div> --}}
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
                          <div class="col-md-6">
                            <form action="">
                              <div class="col-md-12 d-flex align-items-start gap-2 ">
                                  <select name="classFilter" class="form-select col-md-2">
                                    <option value="">-- Filter by Class --</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}" {{ request('classFilter') == $class->id ? 'selected' : '' }}>
                                            {{ $class->title }}
                                        </option>
                                    @endforeach
                                  </select>
                                  <select name="branchFilter" class="form-select col-md-3">
                                    <option value="">-- Filter by Branch --</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}" {{ request('branchFilter') == $branch->id ? 'selected' : '' }}>
                                            {{ $branch->name }}
                                        </option>
                                    @endforeach
                                  </select>
                                  <div class="col-md-6">
                                    <input type="time" name="startTime" value="{{ request('startTime') }}" class="form-control" placeholder="Start Time">
                                  </div>
                                  <div class="col-md-6">
                                      <input type="time" name="endTime" value="{{ request('endTime') }}" class="form-control" placeholder="End Time">
                                  </div>
                                  <button class="btn text-white bg-primary">
                                    <i class="fa-solid fa-filter"></i>
                                  </button>
                              </div>
                            </form>
                          </div>
                        </div>
                    </div>
                    
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            {{-- <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            #</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Class</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Branch</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Weekday</th>
                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Start Time</th>
                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            End Time</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedules as $index=>$schedule)
                                    <tr>
                                        <td class="">
                                          <p class="text-xs ms-3 font-weight-bold mb-0">{{$index+1}}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$schedule->class->title}}</p>
                                        </td>
                                        <td class="">
                                            <p class="text-xs font-weight-bold mb-0">{{$schedule->class->branch->name}}</p>
                                        </td>
                                        <td>
                                            @if ($schedule->weekday == 1)
                                                <p class="text-xs font-weight-bold mb-0">Ehud</p>
                                            @elseif($schedule->weekday == 2)
                                                <p class="text-xs font-weight-bold mb-0">Segno</p>
                                            @elseif($schedule->weekday == 3)
                                                <p class="text-xs font-weight-bold mb-0">Maksegno</p>
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
                                          <p class="text-xs text-center font-weight-bold mb-0 ">{{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->start_time)->format('h:i A') }}</p>
                                        </td>
                                        <td class="">
                                            <p class="text-xs text-center font-weight-bold mb-0 ">{{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->end_time)->format('h:i A') }}</p>
                                        </td>
                                        <td class="  align-items-center justify-content-center d-flex gap-4">
                                            <a class="font-weight-bold text-xs btn bg-gradient-secondary  " style="cursor: pointer"
                                                data-bs-target="#editmodal{{$schedule->id}}" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Edit user">
                                                <span>Edit</span>
                                            </a>
                                            <a class="font-weight-bold text-xs btn bg-gradient-primary d-flex align-items-center  " style="cursor: pointer"
                                                data-bs-target="#deletemodal{{$schedule->id}}" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Edit user">
                                                <i style="color: white" class="ni ni-fat-remove  text-xs opacity-10"></i>
                                                <span>Delete</span>
                                            </a>
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
                            <div class="container">
                              <div class="row text-center mb-3 ">
                                  @foreach ($weekdays as $dayNum => $dayName)
                                      <div class="col-12 col-sm-6 col-md-3 col-lg-2 col-xl-3 mb-4">
                                          <div class="border rounded p-3 h-100" style="background-color: #f8f9fa16;">
                                              <h6 class="text-primary text-uppercase fw-bold mb-3">{{ $dayName }}</h6>
                                              @if (isset($schedules[$dayNum]))
                                                  @foreach ($schedules[$dayNum] as $schedule)
                                                      <div class=" rounded-3 mb-2 shadow-sm bg-gradient-success">
                                                          <div class="card-body p-2 row">
                                                              <h6 class="card-title mb-1" style="font-size: 0.85rem; color: white;">
                                                                  {{ $schedule->class->title }}
                                                              </h6>
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
                                {{-- {{ $schedules->links('components.pagination') }} --}}
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>

    {{-- CSS Styling --}}

<style>
  .avatar-upload-box {
    width: 150px;
    height: 150px;
    border: 2px dashed #ccc;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    background-color: #f8f9fa;
  }

  .avatar-upload-box:hover {
    background-color: #e9ecef;
  }

  .avatar-preview {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .avatar-placeholder {
    color: #aaa;
    font-size: 2rem;
    z-index: 1;
    text-align: center;
  }

  .avatar-upload-box .avatar-placeholder {
    position: absolute;
  }

  #preview, #video {
            width: 300px;
            height: 225px;
            border: 1px solid #ccc;
            margin-top: 10px;
  }

  /* Wrapper styling (optional) */
.custom-checkbox-wrapper {
  display: flex;
  align-items: center;
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
  background-color: #fddd0d; 
  border-color: #b8a608;
}

/* Checkmark (using ::after) */
.custom-checkbox:checked::after {
  content: "";
  position: absolute;
  top: 4px;
  left: 6px;
  width: 4px;
  height: 8px;
  border: solid rgb(57, 51, 0);
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


<script>
  // edit
  function previewAvatarEdit(event, userId) {
    const input = event.target;
    const preview = document.getElementById('avatar-preview' + userId);
    const placeholder = document.getElementById('avatar-placeholder' + userId);

    if (input.files && input.files[0]) {
      const reader = new FileReader();

      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
        placeholder.innerHTML = '<i class="fas fa-pen"></i>';
      }

      reader.readAsDataURL(input.files[0]);
    }
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

{{-- JS for Preview --}}
<script>
  function previewAvatar(event) {
    const input = event.target;
    const preview = document.getElementById('avatar-preview');
    const placeholder = document.getElementById('avatar-placeholder');

    if (input.files && input.files[0]) {
      const reader = new FileReader();

      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
        placeholder.style.display = 'none';
      }

      reader.readAsDataURL(input.files[0]);
    } else {
      preview.style.display = 'none';
      placeholder.style.display = 'flex';
    }
  }
</script>


<script>
  const video = document.getElementById('video');
  const captureBtn = document.getElementById('capture');
  const preview = document.getElementById('preview');
  const imageDataInput = document.getElementById('imageData');
  const fileInput = document.getElementById('fileInput');

  // 1. Start webcam stream
  navigator.mediaDevices.getUserMedia({ video: true })
      .then(stream => {
          video.srcObject = stream;
      })
      .catch(err => {
          console.error('Camera access denied or not available:', err);
      });

  // 2. Capture image from webcam
  captureBtn.addEventListener('click', () => {
      const canvas = document.createElement('canvas');
      canvas.width = video.videoWidth;
      canvas.height = video.videoHeight;
      const ctx = canvas.getContext('2d');
      ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
      const dataUrl = canvas.toDataURL('image/png');

      preview.src = dataUrl;
      preview.style.display = 'block';
      imageDataInput.value = dataUrl;
  });

  // 3. Handle file input (preview and strip webcam image)
  fileInput.addEventListener('change', function () {
      const file = this.files[0];
      if (file) {
          const reader = new FileReader();
          reader.onload = function (e) {
              preview.src = e.target.result;
              preview.style.display = 'block';
              imageDataInput.value = e.target.result;
          }
          reader.readAsDataURL(file);
      }
  });
</script>
@endsection