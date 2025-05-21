@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Specialties'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 ">
                        <div class="d-flex align-items-center justify-content-between">
                            <h6>Specialties </h6>
                            <div>
                              <a class="font-weight-bold text-xs btn bg-gradient-secondary " style="cursor: pointer"
                                  href="{{route('trainers.index')}}">
                                  <span> &laquo; Back</span>
                              </a>
                              <a class="font-weight-bold text-xs btn bg-gradient-success  " style="cursor: pointer"
                                data-bs-target="#addmodal" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Add user">
                                <span>Add Specialty</span>
                              </a>
                            </div>
                        </div>
                        <div>
                            <form action="">
                                <div class="col-md-3 d-flex align-items-start gap-2 ">
                                    <div class="form-group ">
                                      <div class="input-group mb-4">
                                        <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                        <input class="form-control" placeholder="Search" type="text">
                                      </div>
                                    </div>
                                    <button class="btn text-white bg-primary">
                                        <i class="ni ni-zoom-split-in text-white text-sm opacity-10"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Description</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($specialties as $index=>$specialty)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$specialty->name}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$specialty->description}}</p>
                                        </td>
                                        <td class="  align-items-center justify-content-center d-flex gap-4">
                                            <a class="font-weight-bold text-xs btn bg-gradient-secondary  " style="cursor: pointer"
                                                data-bs-target="#editmodal{{$specialty->id}}" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Edit user">
                                                <span>Edit</span>
                                            </a>
                                            <a class="font-weight-bold text-xs btn bg-gradient-primary d-flex align-items-center  " style="cursor: pointer"
                                                data-bs-target="#deletemodal{{$specialty->id}}" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Edit user">
                                                <i style="color: white" class="ni ni-fat-remove  text-xs opacity-10"></i>
                                                <span>Delete</span>
                                            </a>
                                        </td>
                                         
                                    </tr>
                                    {{-- edit --}}
                                    <div class="modal fade" id="editmodal{{$specialty->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                          <div class="modal-body p-0">
                                            <div class="card card-plain">
                                              <div class="card-header pb-0 text-left">
                                                <h3 class="font-weight-bolder text-dark">Edit Specialty</h3>
                                              </div>
                                              <div class="card-body">
                                                <form action="{{route('specialties.update',$specialty->id)}}" class="editForm" method="post" >
                                                  @method("PUT")
                                                  @csrf
                                                    <label>Name</label>
                                                    <div class="input-group mb-3">
                                                      <input type="text" name="name" value="{{old('name',$specialty->name)}}" class="form-control"  placeholder="name" aria-label="permission name" aria-describedby="role name addon">
                                                    </div>
                                                    <label>Description</label>
                                                    <div class="input-group mb-3">
                                                      <textarea name="description" placeholder="description" rows="3"  class="form-control"  >
                                                        {{$specialty->description}}</textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="submit" class="btn btn-round bg-primary text-white updateButton ">
                                                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                                        <span class="button-text">Update</span>
                                                      </button>
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
                                  <div class="modal fade " id="deletemodal{{$specialty->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered  modal-md" role="document">
                                        <div class="modal-content card card-body  ">
                                          <div class="modal-header">
                                            <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">×</span>
                                            </button>
                                          </div>
                                          <form action="{{route('users.destroy',$specialty->id)}}" method="post">
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
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="flex justify-center mt-4">
                                {{ $specialties->links('components.pagination') }}
                            </div>
                            
                            {{-- add --}}
                            <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-body p-0">
                                      <div class="card card-plain">
                                        <div class="card-header pb-0 text-left">
                                          <h3 class="font-weight-bolder text-dark">Add Specialty</h3>
                                        </div>
                                        <div class="card-body">
                                          <form id="addform" action="{{route('specialties.store')}}" method="post" role="form text-left">
                                            @method("POST")
                                            @csrf
                                                <div class="row">
                                                    <div class=" col-12">
                                                        <label>Specialty Name <span class="text-danger">*</span> </label>
                                                        <div class="input-group mb-3">
                                                          <input type="text" required name="name"  class="form-control"  placeholder="specialty name" aria-label="specialty name" aria-describedby="role name addon">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label>Description</label>
                                                        <div class="input-group mb-3">
                                                          <textarea type="text" name="description"  class="form-control"  placeholder="write description" >
                                                          </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="submit" id="saveButton" class="btn btn-round bg-primary text-white ">
                                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" id="spinner"></span>
                                                    <span id="addButtonText">Save</span>
                                                  </button>
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
<script>
  
  $(document).ready(function(){
      $( '#multiple-select-field' ).select2( {
        theme: "bootstrap-5",
        // width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        width: '100%',
        placeholder: $( this ).data( 'placeholder' ),
        closeOnSelect: false,
      } );
    });
</script>

<script>
  document.getElementById('addform').addEventListener('submit', function(e) {
      var button = document.getElementById('saveButton');
      var spinner = document.getElementById('spinner');
      var buttonText = document.getElementById('addButtonText');
      // Show spinner and change text
      spinner.classList.remove('d-none');
      buttonText.textContent = 'Saving...';
      // Disable the button
      button.disabled = true;
  });
</script>

{{-- <script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.modal').forEach(modal => {
      modal.addEventListener('shown.bs.modal', function () {
        modal.querySelectorAll('.editForm').forEach(form => {
          form.addEventListener('submit', function(e) {
            e.preventDefault();

            const submitButton = form.querySelector('.updateButton');
            if (!submitButton) return;

            const spinner = submitButton.querySelector('.spinner-border');
            const buttonText = submitButton.querySelector('.button-text');

            if (spinner) spinner.classList.remove('d-none');
            if (buttonText) buttonText.textContent = 'Updating...';

            submitButton.disabled = true;

            form.submit();
          });
        });
      });
    });
  });
</script> --}}



  
  
  
@endsection
