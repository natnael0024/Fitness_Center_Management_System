@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Classes'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 ">
                        <div class="d-flex align-items-center justify-content-between">
                            <h6>Classes</h6>
                            <div>
                              <a class="font-weight-bold text-xs btn bg-gradient-success  " style="cursor: pointer"
                                data-bs-target="#addmodal" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Add user">
                                <span class="d-flex align-items-center gap-2"><i class="fa-solid fas fa-plus "></i>Add Class</span>
                              </a>
                              <a class="font-weight-bold text-xs btn bg-gradient-success  " style="cursor: pointer"
                                  href="{{route('class-schedules.index')}}">
                                  <span class="d-flex align-items-center gap-2"><i class="fa-regular fa-calendar"></i>Schedules</span>
                              </a>
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
                                      <option value="">Role</option>
                                    @foreach ($roles as $role)
                                      <option value="{{$role->name}}">{{$role->name}}</option>
                                    @endforeach
                                  </select>
                                  <button class="btn text-white bg-primary"><i class="fa-solid fa-filter"></i>
                                  </button>
                              </div>
                            </form>
                          </div> --}}
                        </div>

                    </div>
                    
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            #</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Title</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Trainer</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Branch</th>
                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Capacity</th>
                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Premium</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Price</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                        {{-- <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Employed</th> --}}
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classes as $index=>$class)
                                    <tr>
                                        <td class="">
                                          <p class="text-xs ms-3 font-weight-bold mb-0">{{$index+1}}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$class->title}}</p>
                                        </td>
                                        <td class="">
                                            <p class="text-xs font-weight-bold mb-0">{{$class->trainer->user->firstname}}</p>
                                        </td>
                                        <td>
                                          <p class="text-xs font-weight-bold mb-0">{{$class->branch->name}}</p>
                                        </td>
                                        <td class="">
                                          <p class="text-xs text-center font-weight-bold mb-0 ">{{$class->capacity}}</p>
                                        </td>
                                        <td class="align-middle text-center  text-sm ">
                                            @if ($class->is_premium)
                                            <span class="">
                                                {{-- <i class="fas fa-check text-success text-sm"></i> --}}
                                                <i class="ni ni-check-bold text-success"></i>
                                            </span>
                                            @else
                                            <span class="">
                                                <i class="ni ni-fat-remove text-secondary"></i>
                                            </span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$class->price}}</span>
                                        </td>
                                        <td class="  align-items-center justify-content-center d-flex gap-4">
                                            <a class="font-weight-bold text-xs btn bg-gradient-secondary  " style="cursor: pointer"
                                                data-bs-target="#editmodal{{$class->id}}" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Edit user">
                                                <span>Edit</span>
                                            </a>
                                            <a class="font-weight-bold text-xs btn bg-gradient-primary d-flex align-items-center  " style="cursor: pointer"
                                                data-bs-target="#deletemodal{{$class->id}}" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Edit user">
                                                <i style="color: white" class="ni ni-fat-remove  text-xs opacity-10"></i>
                                                <span>Delete</span>
                                            </a>
                                            <a class="font-weight-bold text-xs btn bg-gradient-info  " style="cursor: pointer"
                                                data-bs-target="#addmodal" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Add user">
                                                <span class="d-flex align-items-center gap-2"><i class="fa-regular fa-calendar"></i>Schedules</span>
                                            </a>
                                        </td>
                                         {{-- edit --}}
                                         <div class="modal fade" id="editmodal{{$class->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                              <div class="modal-body p-0">
                                                <div class="card card-plain">
                                                  <div class="card-header pb-0 text-left">
                                                    <h3 class="font-weight-bolder text-dark">Edit Class</h3>
                                                  </div>
                                                  <div class="card-body">
                                                    <form action="{{route('classes.update',$class->id)}}" enctype="multipart/form-data" method="post" role="form text-left">
                                                      @method("PUT")
                                                      @csrf
                                                          <div class="row">
                                                              <div class=" col-4">
                                                                  <label>Title <span class="text-danger">*</span> </label>
                                                                  <div class="input-group mb-3">
                                                                    <input type="text" required name="title" value="{{old('title',$class->title)}}"  class="form-control"  placeholder="title" aria-label="permission name" aria-describedby="role name addon">
                                                                  </div>
                                                              </div>
                                                              <div class=" col-4">
                                                                <label>Price <span class="text-danger">*</span></label>
                                                                <div class="input-group mb-3">
                                                                  <input type="number" required name="price" value="{{old('price',$class->price)}}"  class="form-control"  placeholder="price" aria-label="permission name" aria-describedby="role name addon">
                                                                </div>
                                                              </div>
                                                              <div class="col-md-4">
                                                                  <label>Capacity</label>
                                                                  <div class="input-group mb-3">
                                                                    <input type="number" required name="capacity" value="{{old('capacity',$class->capacity)}}"  class="form-control"  placeholder="capacity" aria-label="permission name" aria-describedby="role name addon">
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <div class=" row">
                                                            <div class=" col-4">
                                                                <label>Description</label>
                                                                <div class="input-group mb-3">
                                                                  <textarea name="description" rows="3"  class="form-control"  placeholder="description" >
                                                                    {{$class->description}}
                                                                  </textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-4" id="" >
                                                                <label for="branchSelect">Branch <span class="text-danger">*</span></label>
                                                                <select name="branch_id" required class="form-control" id="branchSelect" >
                                                                  <option value="">Select Branch</option>
                                                                  @foreach ($branches as $branch)
                                                                    <option value="{{ $branch->id }}" {{$class->branch_id == $branch->id ? 'selected':''}}>{{ $branch->name }}</option>
                                                                  @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="">Trainer<span class="text-danger">*</span></label>
                                                                <select name="trainer_id" class="form-control" required id="">
                                                                    @foreach ($trainers as $trainer)
                                                                        <option value="{{$trainer->id}}" {{$class->trainer_id == $trainer->id ? 'selected':''}}>{{$trainer->user->firstname}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                           </div>
                                                           <div class="row">
                                                            <div class="custom-checkbox-wrapper ">
                                                                <input type="checkbox" name="is_premium" id="checkboxCustom1" class="custom-checkbox" {{$class->is_premium ? 'checked' :''}}>
                                                                <label for="checkboxCustom1" class=" cursor-pointer mt-2 ">Premium</label>
                                                            </div>
                                                           </div>
                                                           <div class="modal-footer">
                                                             <button type="submit" class="btn btn-round bg-primary text-white ">Update</button>
                                                             <button type="reset" data-bs-dismiss="modal" class="btn btn-round bg-secondary text-white ">Cancel</button>
                                                           </div>
                                                    </form>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                      </div>

                                        {{-- delete --}}
                                        <div class="modal fade " id="deletemodal{{$class->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered  modal-md" role="document">
                                              <div class="modal-content card card-body  ">
                                                <div class="modal-header">
                                                  <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                  </button>
                                                </div>
                                                <form action="{{route('users.destroy',$class->id)}}" method="post">
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
                            </table>
                            <div class="flex justify-center mt-4">
                                {{ $classes->links('components.pagination') }}
                            </div>
                            
                            {{-- add --}}
                            <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-body p-0">
                                      <div class="card card-plain">
                                        <div class="card-header pb-0 text-left">
                                          <h3 class="font-weight-bolder text-dark">Add Class</h3>
                                        </div>
                                        <div class="card-body">
                                          <form action="{{route('classes.store')}}" enctype="multipart/form-data" method="post" role="form text-left">
                                            @method("POST")
                                            @csrf
                                                <div class="row">
                                                    <div class=" col-4">
                                                        <label>Title <span class="text-danger">*</span> </label>
                                                        <div class="input-group mb-3">
                                                          <input type="text" required name="title"  class="form-control"  placeholder="title" aria-label="permission name" aria-describedby="role name addon">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class=" col-4">
                                                      <label>Price <span class="text-danger">*</span></label>
                                                      <div class="input-group mb-3">
                                                        <input type="number" required name="price"  class="form-control"  placeholder="price" aria-label="permission name" aria-describedby="role name addon">
                                                      </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Capacity</label>
                                                        <div class="input-group mb-3">
                                                          <input type="number" required name="capacity"  class="form-control"  placeholder="capacity" aria-label="permission name" aria-describedby="role name addon">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" row">
                                                    <div class=" col-4">
                                                        <label>Description</label>
                                                        <div class="input-group mb-3">
                                                          <textarea name="description" rows="3"  class="form-control"  placeholder="description" ></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4" id="" >
                                                        <label for="branchSelect">Branch <span class="text-danger">*</span></label>
                                                        <select name="branch_id" required class="form-control" id="branchSelect" >
                                                          <option value="">Select Branch</option>
                                                          @foreach ($branches as $branch)
                                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                          @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="">Trainer<span class="text-danger">*</span></label>
                                                        <select name="trainer_id" class="form-control" required id="">
                                                            @foreach ($trainers as $trainer)
                                                                <option value="{{$trainer->id}}">{{$trainer->user->firstname}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                               
                                                <div class="row">
                                                    <div class="custom-checkbox-wrapper ">
                                                        <input type="checkbox" name="is_premium" id="checkboxCustom1" class="custom-checkbox">
                                                        <label for="checkboxCustom1" class=" cursor-pointer mt-2 ">Premium</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="submit" class="btn btn-round bg-primary text-white ">Add</button>
                                                  <button type="reset" data-bs-dismiss="modal" class="btn btn-round bg-secondary text-white ">Cancel</button>
                                                </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
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