@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 ">
                        <div class="d-flex align-items-center justify-content-between">
                            <h6>Membership Plans Table</h6>
                            <a class="font-weight-bold text-xs btn bg-gradient-success  " style="cursor: pointer"
                                data-bs-target="#addmodal" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Add user">
                                <span>Add Plan</span>
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
                                            #</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Membership Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Price</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Duration Days</th>
                                        {{-- <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th> --}}
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                        {{-- <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Employed</th> --}}
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($membershipPlans as $index=>$plan)
                                    <tr>
                                        <td class="">
                                            <p class="text-xs ms-3 font-weight-bold mb-0">{{$index+1}}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$plan->name}}</p>
                                        </td>
                                        <td>
                                          <p class="text-xs font-weight-bold mb-0">{{$plan->price}}</p>
                                          {{-- <p class="text-xs text-secondary mb-0">Organization</p> --}}
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$plan->duration_days}}</p>
                                            {{-- <p class="text-xs text-secondary mb-0">Organization</p> --}}
                                        </td>
                                       
                                        {{-- <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                        </td> --}}
                                        <td class="  align-items-center justify-content-center d-flex gap-4">
                                            <a class="font-weight-bold text-xs btn bg-gradient-secondary  " style="cursor: pointer"
                                                data-bs-target="#editmodal{{$plan->id}}" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Edit user">
                                                <span>Edit</span>
                                            </a>
                                            <a class="font-weight-bold text-xs btn bg-gradient-primary d-flex align-items-center  " style="cursor: pointer"
                                                data-bs-target="#deletemodal{{$plan->id}}" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Edit user">
                                                <i style="color: white" class="ni ni-fat-remove  text-xs opacity-10"></i>
                                                <span>Delete</span>
                                            </a>
                                        </td>
                                         {{-- edit --}}
                                         <div class="modal fade" id="editmodal{{$plan->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                              <div class="modal-body p-0">
                                                <div class="card card-plain">
                                                  <div class="card-header pb-0 text-left">
                                                    <h3 class="font-weight-bolder text-dark">Edit User</h3>
                                                  </div>
                                                  <div class="card-body">
                                                    <form action="{{route('membership-plans.update',$plan->id)}}" enctype="multipart/form-data" method="post" role="form text-left">
                                                      @method("POST")
                                                      @csrf
                                                          
                                                          
                                                          <div class="row">
                                                              <div class=" col-4">
                                                                  <label>Username <span class="text-danger">*</span> </label>
                                                                  <div class="input-group mb-3">
                                                                    <input type="text" required name="username" value="{{old('username',$plan->username)}}"  class="form-control"  placeholder="username" aria-label="permission name" aria-describedby="role name addon">
                                                                  </div>
                                                              </div>
                                                              <div class=" col-4">
                                                                  <label>Email <span class="text-danger">*</span></label>
                                                                  <div class="input-group mb-3">
                                                                    <input type="email" required name="email"  class="form-control" value="{{old('email',$plan->email)}}"  placeholder="email" aria-label="permission name" aria-describedby="role name addon">
                                                                  </div>
                                                              </div>
                                                              <div class=" col-4">
                                                                <label>Phone <span class="text-danger">*</span></label>
                                                                <div class="input-group mb-3">
                                                                  <input type="text" required name="phone"  class="form-control" value="{{old('phone',$plan->phone)}}"  placeholder="phone number" aria-label="permission name" aria-describedby="role name addon">
                                                                </div>
                                                            </div>
                                                          </div>
                                                          <div class=" row">
                                                            <div class="col-md-4">
                                                              <label>First Name</label>
                                                              <div class="input-group mb-3">
                                                                <input type="text" required name="firstname"  class="form-control" value="{{old('firstname',$plan->firstname)}}"  placeholder="first name" aria-label="permission name" aria-describedby="role name addon">
                                                              </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                              <label>Middle Name</label>
                                                              <div class="input-group mb-3">
                                                                <input type="text" required name="middlename"  class="form-control" value="{{old('middlename',$plan->middlename)}}" placeholder="middle name" aria-label="permission name" aria-describedby="role name addon">
                                                              </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                              <label>Last Name</label>
                                                              <div class="input-group mb-3">
                                                                <input type="text" name="lastname"  class="form-control" value="{{old('lastname',$plan->lastname)}}"  placeholder="last name" aria-label="permission name" aria-describedby="role name addon">
                                                              </div>
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
                                        <div class="modal fade " id="deletemodal{{$plan->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered  modal-md" role="document">
                                              <div class="modal-content card card-body  ">
                                                <div class="modal-header">
                                                  <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                  </button>
                                                </div>
                                                <form action="{{route('membership-plans.destroy',$plan->id)}}" method="post">
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
                                {{ $membershipPlans->links('components.pagination') }}
                            </div>
                            
                            {{-- add --}}
                            <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                  <div class="modal-content">
                                    <div class="modal-body p-0">
                                      <div class="card card-plain">
                                        <div class="card-header pb-0 text-left">
                                          <h3 class="font-weight-bolder text-dark">Add Membership Plan</h3>
                                        </div>
                                        <div class="card-body">
                                          <form action="{{route('membership-plans.store')}}" enctype="multipart/form-data" method="post" role="form text-left">
                                            @method("POST")
                                            @csrf
                                                <div class="">
                                                    <div class=" ">
                                                        <label>Membership Name <span class="text-danger">*</span> </label>
                                                        <div class="input-group mb-3">
                                                          <input type="text" required name="name"  class="form-control"  placeholder="membership name" aria-label="permission name" aria-describedby="role name addon">
                                                        </div>
                                                    </div>
                                                    <div class=" ">
                                                        <label>Price <span class="text-danger">*</span></label>
                                                        <div class="input-group mb-3">
                                                          <input type="number" required name="price"  class="form-control"  placeholder="price" aria-label="permission name" aria-describedby="role name addon">
                                                        </div>
                                                    </div>
                                                    <div class=" ">
                                                      <label>Duration Days <span class="text-danger">*</span></label>
                                                      <div class="input-group mb-3">
                                                        <input type="number" required name="duration_days"  class="form-control"  placeholder="duration days" aria-label="permission name" aria-describedby="role name addon">
                                                      </div>
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
</style>


  {{-- add --}}
     <script>
       document.addEventListener('DOMContentLoaded', function () {
         const roleSelect = document.getElementById('roleSelect');
         const branchField = document.getElementById('branchField');
         const specialtiesField = document.getElementById('specialtiesField');
     
         function toggleFields() {
           const role = roleSelect.value.toLowerCase();
     
           // Roles that should see the branch field
           const showBranchRoles = ['trainer', 'branchmanager', 'receptionist'];
     
           // Show/hide logic
           branchField.style.display = showBranchRoles.includes(role) ? 'block' : 'none';
           specialtiesField.style.display = (role === 'trainer') ? 'block' : 'none';
         }
     
         // Initial check
         toggleFields();
     
         // On change
         roleSelect.addEventListener('change', toggleFields);
       });
     </script>

     {{-- edit --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Initialize Choices.js
    document.querySelectorAll('[data-choices]').forEach(el => {
      new Choices(el, {
        removeItemButton: true,
      });
    });

    // Handle show/hide logic per role select
    document.querySelectorAll('.role-select').forEach(function (roleSelect) {
      const userId = roleSelect.dataset.userId;

      function toggleFields() {
        const role = roleSelect.value.toLowerCase();
        const branchField = document.getElementById('branchField' + userId);
        const specialtiesField = document.getElementById('specialtiesField' + userId);
        const branchInput = branchField.querySelector('select, input');
        // Show branch for all except super admin
        if (['trainer', 'branchmanager', 'receptionist'].includes(role)) {
          branchField.style.display = 'block';
          if (branchInput) branchInput.setAttribute('required', 'required');
        } else {
          branchField.style.display = 'none';
          if (branchInput) branchInput.removeAttribute('required');
        }

        // Show specialties only for trainer
        specialtiesField.style.display = (role === 'trainer') ? 'block' : 'none';
      }

      // Initial check on page load
      toggleFields();

      // Update on change
      roleSelect.addEventListener('change', toggleFields);
    });
  });
</script>
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

@endsection
