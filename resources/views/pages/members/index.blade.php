@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 ">
                        <div class="d-flex align-items-center justify-content-between">
                            <h6>Members table</h6>
                            <a class="font-weight-bold text-xs btn bg-gradient-success  " style="cursor: pointer"
                                data-bs-target="#addmodal" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Add user">
                                <span>Add Member</span>
                            </a>
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
                                            Name</th>
                                        <th class="text-uppercase border text-secondary text-xxs font-weight-bolder opacity-7">
                                            Gender</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Phone</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Membership</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                        {{-- <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Employed</th> --}}
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($members as $index=>$member)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src={{$member->user->getAvatarUrlAttribute()}} class="avatar avatar-sm me-3"
                                                        alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$member->user->firstname. ' '. $member->user->middlename . ' '. $member->user->lastname}} 
                                                        @if (Auth::user()->id == $member->user->id)
                                                            <span class="badge badge-sm bg-gradient-info">you</span>
                                                        @endif
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">{{$member->user->email}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border">
                                            <p class="text-xs font-weight-bold mb-0">{{$member->user->gender}}</p>
                                        </td>
                                        <td>
                                          <p class="text-xs font-weight-bold mb-0">{{$member->user->phone}}</p>
                                        </td>
                                        <td>
                                          <p class="text-xs font-weight-bold mb-0">{{$member->membershipPlan->name}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm ">
                                            @if ($member->status)
                                            <span class="badge badge-sm bg-gradient-success">
                                                 Active
                                            </span>
                                            @else
                                            <span class="badge badge-sm bg-gradient-warning">
                                                InActive
                                            </span>
                                            @endif
                                        </td>
                                        {{-- <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                        </td> --}}
                                        <td class="  align-items-center justify-content-center d-flex gap-4">
                                            <a class="font-weight-bold text-xs btn bg-gradient-secondary  " style="cursor: pointer"
                                                data-bs-target="#editmodal{{$member->id}}" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Edit user">
                                                <span>Edit</span>
                                            </a>
                                            <a class="font-weight-bold text-xs btn bg-gradient-primary d-flex align-items-center  " style="cursor: pointer"
                                                data-bs-target="#deletemodal{{$member->id}}" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Edit user">
                                                <i style="color: white" class="ni ni-fat-remove  text-xs opacity-10"></i>
                                                <span>Delete</span>
                                            </a>
                                        </td>
                                         {{-- edit --}}
                                         <div class="modal fade" id="editmodal{{$member->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                              <div class="modal-body p-0">
                                                <div class="card card-plain">
                                                  <div class="card-header pb-0 text-left">
                                                    <h3 class="font-weight-bolder text-dark">Edit User</h3>
                                                  </div>
                                                  <div class="card-body">
                                                    <form action="{{route('users.update',$member->id)}}" enctype="multipart/form-data" method="post" role="form text-left">
                                                      @method("POST")
                                                      @csrf
                                                          {{-- Avatar Upload --}}
                                                          <div class="form-group">
                                                            <label for="avatar" class="form-label">Avatar <span class="text-danger">*</span></label>
                                                          
                                                            {{-- Avatar Upload Box --}}
                                                            <div class="avatar-upload-box position-relative" onclick="document.getElementById('avatar{{ $member->id }}').click();">
                                                              <img
                                                                id="avatar-preview{{ $member->id }}"
                                                                src="{{ $member->user->getAvatarUrlAttribute() }}"
                                                                alt="Avatar Preview"
                                                                class="avatar-preview"
                                                                style="{{ $member->avatar ? '' : 'display: none;' }}"
                                                              >
                                                          
                                                              {{-- Plus or Edit icon --}}
                                                              <div id="avatar-placeholder{{ $member->id }}" class="avatar-placeholder text-primary">
                                                                <i class="fas {{ $member->avatar ? 'fa-pen bg-opacity-25' : 'fa-plus' }}"></i>
                                                              </div>
                                                            </div>
                                                          
                                                            {{-- Hidden File Input --}}
                                                            <input
                                                              type="file"
                                                              id="avatar{{ $member->id }}" 
                                                              name="avatar"
                                                              class="d-none"
                                                              accept="image/*"
                                                              onchange="previewAvatar(event, {{ $member->id }})"
                                                            >
                                                          </div>
                                                          
                                                          <div class="row">
                                                              <div class=" col-4">
                                                                  <label>Username <span class="text-danger">*</span> </label>
                                                                  <div class="input-group mb-3">
                                                                    <input type="text" required name="username" value="{{old('username',$member->username)}}"  class="form-control"  placeholder="username" aria-label="permission name" aria-describedby="role name addon">
                                                                  </div>
                                                              </div>
                                                              <div class=" col-4">
                                                                  <label>Email <span class="text-danger">*</span></label>
                                                                  <div class="input-group mb-3">
                                                                    <input type="email" required name="email"  class="form-control" value="{{old('email',$member->email)}}"  placeholder="email" aria-label="permission name" aria-describedby="role name addon">
                                                                  </div>
                                                              </div>
                                                              <div class=" col-4">
                                                                <label>Phone <span class="text-danger">*</span></label>
                                                                <div class="input-group mb-3">
                                                                  <input type="text" required name="phone"  class="form-control" value="{{old('phone',$member->phone)}}"  placeholder="phone number" aria-label="permission name" aria-describedby="role name addon">
                                                                </div>
                                                            </div>
                                                          </div>
                                                          <div class=" row">
                                                            <div class="col-md-4">
                                                              <label>First Name</label>
                                                              <div class="input-group mb-3">
                                                                <input type="text" required name="firstname"  class="form-control" value="{{old('firstname',$member->firstname)}}"  placeholder="first name" aria-label="permission name" aria-describedby="role name addon">
                                                              </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                              <label>Middle Name</label>
                                                              <div class="input-group mb-3">
                                                                <input type="text" required name="middlename"  class="form-control" value="{{old('middlename',$member->middlename)}}" placeholder="middle name" aria-label="permission name" aria-describedby="role name addon">
                                                              </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                              <label>Last Name</label>
                                                              <div class="input-group mb-3">
                                                                <input type="text" name="lastname"  class="form-control" value="{{old('lastname',$member->lastname)}}"  placeholder="last name" aria-label="permission name" aria-describedby="role name addon">
                                                              </div>
                                                            </div>
                                                          </div>
                                                          {{-- Role Field --}}
                                                          {{-- <div class="row">
                                                            <div class="form-group col-md-4">
                                                              <label for="roleSelect{{ $member->id }}">Role <span class="text-danger">*</span></label>
                                                              <select name="role" class="form-control role-select" required id="roleSelect{{ $member->id }}" data-user-id="{{ $member->id }}">
                                                                <option value="">Assign role</option>
                                                                @foreach ($roles as $role)
                                                                  <option value="{{ $role->name }}" {{ $member->getRoleNames()->first() == $role->name ? 'selected' : '' }}>
                                                                    {{ $role->name }}
                                                                  </option>
                                                                @endforeach
                                                              </select>
                                                            </div> --}}
                                                            
                                                            {{-- Branch Field --}}
                                                            <div class="form-group branch-field col-md-4" id="branchField{{ $member->id }}" style="display: none;">
                                                              <label for="branchSelect{{ $member->id }}">Branch</label>
                                                              <select name="branch_id" class="form-control" id="branchSelect{{ $member->id }}">
                                                                <option value="">Assign Branch</option>
                                                                @foreach ($branches as $branch)
                                                                  <option value="{{ $branch->id }}" @if($member->branch_id == $branch->id) selected @endif >
                                                                    {{ $branch->name }}
                                                                  </option>
                                                                @endforeach
                                                              </select>
                                                            </div>
                                                          </div>

                                                          {{-- Specialties Field (Trainer Only) --}}
                                                          {{-- <div class="form-group specialties-field" id="specialtiesField{{ $member->id }}" style="display: none;">
                                                            <label>Specialties</label>
                                                            <select
                                                              class="form-control"
                                                              id="specialtiesSelect{{ $member->id }}"
                                                              name="specialties[]"
                                                              multiple
                                                              data-choices
                                                              data-choices-removeitem
                                                            >
                                                              @foreach ($specialties as $spec)
                                                                <option value="{{ $spec->id }}"
                                                                  @if(optional($member->trainer)->specialties && $member->trainer->specialties->contains($spec->id)) selected @endif
                                                                >
                                                                  {{ $spec->name }}
                                                                </option>
                                                              @endforeach
                                                            </select>
                                                          </div> --}}

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
                                        <div class="modal fade " id="deletemodal{{$member->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered  modal-md" role="document">
                                              <div class="modal-content card card-body  ">
                                                <div class="modal-header">
                                                  <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                  </button>
                                                </div>
                                                <form action="{{route('users.destroy',$member->id)}}" method="post">
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
                                {{ $members->links('components.pagination') }}
                            </div>
                            
                            {{-- add --}}
                            <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-body p-0">
                                      <div class="card card-plain">
                                        <div class="card-header pb-0 text-left">
                                          <h3 class="font-weight-bolder text-dark">Add User</h3>
                                        </div>
                                        <div class="card-body">
                                          <form action="{{route('members.store')}}" enctype="multipart/form-data" method="post" role="form text-left">
                                            @method("POST")
                                            @csrf
                                                {{-- Avatar Upload --}}
                                                {{-- <div class="form-group">
                                                  <label for="avatar" class="form-label">Avatar <span class="text-danger">*</span></label>
                                                
                                                  <div class="avatar-upload-box" onclick="document.getElementById('avatar').click();">
                                                    <img id="avatar-preview" src="#" alt="Avatar Preview" class="avatar-preview" style="display: none;">
                                                    <div id="avatar-placeholder" class="avatar-placeholder">
                                                      <i class="fas fa-plus"></i>
                                                    </div>
                                                  </div>
                                                  <input 
                                                    type="file"
                                                    id="avatar"
                                                    name="avatar"
                                                    class="d-none"
                                                    accept="image/*"
                                                    onchange="previewAvatar(event)" 
                                                    required
                                                  >
                                                </div> --}}

                                                {{--  --}}
                                                <div class="form-group">
                                                  <label for="avatar" class="form-label">Avatar<span class="text-danger">*</span></label>
                                                  <div class="avatar-upload-box" onclick="document.getElementById('avatar').click();">
                                                    <img id="avatar-preview" src="#" alt="Avatar Preview" class="avatar-preview" style="display: none;">
                                                    <div id="avatar-placeholder" class="avatar-placeholder">
                                                      <i class="fas fa-plus"></i>
                                                    </div>
                                                  </div>
                                                  <input
                                                    type="file"
                                                    id="avatar"
                                                    name="avatar"
                                                    class="d-none"
                                                    accept="image/*"
                                                    onchange="previewAvatar(event)"
                                                    required
                                                  >
                                                  {{-- <video id="video" autoplay></video><br> --}}
                                                  {{-- <button type="button" id="capture">Capture</button><br> --}}
                                                </div>

                                                  <!-- Webcam area -->
    <!-- File upload fallback -->
    {{-- <input type="file" id="fileInput" accept="image/*"><br> --}}

    <!-- Submit form -->
    {{-- <form id="uploadForm" method="POST" action="" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="image_data" id="imageData">
        <button type="submit">Upload</button>
    </form> --}}

                                                <div class="row">
                                                    <div class=" col-4">
                                                        <label>Username <span class="text-danger">*</span> </label>
                                                        <div class="input-group mb-3">
                                                          <input type="text" required name="username"  class="form-control"  placeholder="username" aria-label="permission name" aria-describedby="role name addon">
                                                        </div>
                                                    </div>
                                                    <div class=" col-4">
                                                        <label>Email <span class="text-danger">*</span></label>
                                                        <div class="input-group mb-3">
                                                          <input type="email" required name="email"  class="form-control"  placeholder="email" aria-label="permission name" aria-describedby="role name addon">
                                                        </div>
                                                    </div>
                                                    <div class=" col-4">
                                                      <label>Phone <span class="text-danger">*</span></label>
                                                      <div class="input-group mb-3">
                                                        <input type="text" required name="phone"  class="form-control"  placeholder="phone number" aria-label="permission name" aria-describedby="role name addon">
                                                      </div>
                                                  </div>
                                                </div>
                                                <div class=" row">
                                                  <div class="col-md-4">
                                                    <label>First Name</label>
                                                    <div class="input-group mb-3">
                                                      <input type="text" required name="firstname"  class="form-control"  placeholder="first name" aria-label="permission name" aria-describedby="role name addon">
                                                    </div>
                                                  </div>
                                                  <div class="col-md-4">
                                                    <label>Middle Name</label>
                                                    <div class="input-group mb-3">
                                                      <input type="text" required name="middlename"  class="form-control"  placeholder="middle name" aria-label="permission name" aria-describedby="role name addon">
                                                    </div>
                                                  </div>
                                                  <div class="col-md-4">
                                                    <label>Last Name</label>
                                                    <div class="input-group mb-3">
                                                      <input type="text" name="lastname"  class="form-control"  placeholder="last name" aria-label="permission name" aria-describedby="role name addon">
                                                    </div>
                                                  </div>
                                                </div>
                                               
                                                <div class="row">
                                                  <div class="form-group col-md-4">
                                                    <label for="">Gender<span class="text-danger">*</span></label>
                                                    <select name="gender" class="form-control" required id="">
                                                      <option value="">Select Gender</option>
                                                        <option value="male" >Male</option>
                                                        <option value="female" >Female</option>
                                                    </select>
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                    <label for="membership_plan_id">Membership Plan<span class="text-danger">*</span></label>
                                                    <select name="membership_plan_id" class="form-control" required id="membership_plan_id">
                                                      <option value="">Choose plan</option>
                                                      @foreach ($membershipPlans as $plan)
                                                        <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                                      @endforeach
                                                    </select>
                                                  </div>
                                                  <div class="form-group col-md-4" id="" >
                                                    <label for="branchSelect">Branch <span class="text-danger">*</span></label>
                                                    <select name="branch_id" class="form-control" id="branchSelect" >
                                                      <option value="">Select Branch</option>
                                                      @foreach ($branches as $branch)
                                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                      @endforeach
                                                    </select>
                                                  </div>
                                                </div>
                                                {{-- Specialties Field --}}
                                                {{-- <div class="form-group" id="specialtiesField" style="display: none;">
                                                  <label>Specialties </label>
                                                  <select
                                                    class="form-control" style="color: black"
                                                    id="choices-multiple-remove-button"
                                                    name="specialties[]"
                                                    multiple
                                                    data-choices
                                                    data-choices-removeitem>
                                                    @foreach ($specialties as $spec)
                                                      <option value="{{ $spec->id }}">{{ $spec->name }}</option>
                                                    @endforeach
                                                  </select>
                                                </div> --}}
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
</style>


{{-- <script>
  // edit
  function previewAvatar(event, userId) {
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
</script> --}}



     
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