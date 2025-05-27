@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])


    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 ">
                        <div class="d-flex align-items-center justify-content-between">
                            <h6>Trainers </h6>
                            <div>
                              <a class="font-weight-bold text-xs btn bg-gradient-success  " style="cursor: pointer"
                                data-bs-target="#addmodal" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Add user">
                                <span>Add Trainer</span>
                              </a>
                              <a href="{{route('specialties.index')}}" class="font-weight-bold text-xs btn bg-gradient-primary  " style="cursor: pointer">
                                  <span>Specialties</span>
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
                                            Hire Date</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Specialties</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
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
                                    @foreach ($trainers as $index=>$trainer)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="/img/team-2.jpg" class="avatar avatar-sm me-3"
                                                        alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$trainer->user->firstname. ' '. $trainer->user->middlename . ' '. $trainer->user->lastname}} 
                                                        @if (Auth::user()->id == $trainer->id)
                                                            <span class="badge badge-sm bg-gradient-info">you</span>
                                                        @endif
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">{{$trainer->user->email}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$trainer->hire_date}}</p>
                                            {{-- <p class="text-xs text-secondary mb-0">Organization</p> --}}
                                        </td>
                                        <td class="d-flex gap-2 text-center justify-content-center">
                                          @foreach ($trainer->specialties as $spec)
                                            <p class="text-xs font-weight-bold mb-0">{{$spec->name}}, </p>
                                          @endforeach
                                        </td>
                                        <td class="align-middle text-center text-sm ">
                                            @if ($trainer->user->status)
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
                                                data-bs-target="#editmodal{{$trainer->id}}" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Edit user">
                                                <span>Edit</span>
                                            </a>
                                            <a class="font-weight-bold text-xs btn bg-gradient-primary d-flex align-items-center  " style="cursor: pointer"
                                                data-bs-target="#deletemodal{{$trainer->id}}" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Edit user">
                                                <i style="color: white" class="ni ni-fat-remove  text-xs opacity-10"></i>
                                                <span>Delete</span>
                                            </a>
                                        </td>
                                         {{-- edit --}}
                                         <div class="modal fade" id="editmodal{{$trainer->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                              <div class="modal-body p-0">
                                                <div class="card card-plain">
                                                  <div class="card-header pb-0 text-left">
                                                    <h3 class="font-weight-bolder text-dark">Add Trainer</h3>
                                                  </div>
                                                  <div class="card-body">
                                                    <form action="{{route('trainers.store')}}" method="post" role="form text-left">
                                                      @method("POST")
                                                      @csrf
                                                          <div class="row">
                                                              <div class=" col-6">
                                                                  <label>Userame <span class="text-danger">*</span> </label>
                                                                  <div class="input-group mb-3">
                                                                    <input type="text" required name="username" value="{{old('username',$trainer->user->username)}}"  class="form-control"  placeholder="username" aria-label="permission name" aria-describedby="role name addon">
                                                                  </div>
                                                              </div>
                                                              <div class=" col-6">
                                                                  <label>Email <span class="text-danger">*</span></label>
                                                                  <div class="input-group mb-3">
                                                                    <input type="email" required name="email" value="{{old('email',$trainer->user->email)}}"  class="form-control"  placeholder="email" aria-label="permission name" aria-describedby="role name addon">
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <div class="row">
                                                              <div class="col-4">
                                                                  <label>First Name</label>
                                                                  <div class="input-group mb-3">
                                                                    <input type="text" required name="firstname" value="{{old('firstname',$trainer->user->firstname)}}"    class="form-control"  placeholder="first name" aria-label="permission name" aria-describedby="role name addon">
                                                                  </div>
                                                              </div>
                                                              <div class="col-4">
                                                                  <label>Middle Name</label>
                                                                  <div class="input-group mb-3">
                                                                    <input type="text" required name="middlename" value="{{old('middlename',$trainer->user->middlename)}}"  class="form-control"  placeholder="middle name" aria-label="permission name" aria-describedby="role name addon">
                                                                  </div>
                                                              </div>
                                                              <div class="col-4">
                                                                  <label>Last Name</label>
                                                                  <div class="input-group mb-3">
                                                                    <input type="text" name="lastname" value="{{old('lastname',$trainer->user->lastname)}}"  class="form-control"  placeholder="last name" aria-label="permission name" aria-describedby="role name addon">
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Branch <span class="text-danger">*</span></label>
                                                            <select name="branch_id" class="form-control" required id="exampleFormControlSelect1">
                                                                  <option value="">Assign Branch</option>
                                                                @foreach ($branches as $branch)
                                                                  <option value="{{$branch->id}}" @if($branch->id == $trainer->branch_id) selected @endif>{{$branch->name}}</option>
                                                                @endforeach
                                                            </select>
                                                          </div>
                                                          <div class="form-group">
                                                            <label>Specialties <span class="text-danger">*</span></label>
                                                            <select 
                                                              class="form-control" 
                                                              id="choices-multiple-remove-button-2" 
                                                              name="specialties[]" 
                                                              multiple
                                                              data-choices
                                                              data-choices-removeitem>
                                                                @foreach ($specialties as $spec)
                                                                <option value="{{$spec->id}}"  @if($trainer->specialties->contains($spec->id)) selected @endif class="">{{$spec->name}}</option>
                                                                @endforeach
                                                            </select>
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

                                        {{-- delete --}}
                                        <div class="modal fade " id="deletemodal{{$trainer->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered  modal-md" role="document">
                                              <div class="modal-content card card-body  ">
                                                <div class="modal-header">
                                                  <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                  </button>
                                                </div>
                                                <form action="{{route('users.destroy',$trainer->id)}}" method="post">
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
                                {{ $trainers->links('components.pagination') }}
                            </div>
                            
                            {{-- add --}}
                            <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-body p-0">
                                      <div class="card card-plain">
                                        <div class="card-header pb-0 text-left">
                                          <h3 class="font-weight-bolder text-dark">Add Trainer</h3>
                                        </div>
                                        <div class="card-body">
                                          <form action="{{route('trainers.store')}}" method="post" role="form text-left">
                                            @method("POST")
                                            @csrf
                                                <div class="row">
                                                    <div class=" col-6">
                                                        <label>Username <span class="text-danger">*</span> </label>
                                                        <div class="input-group mb-3">
                                                          <input type="text" required name="username"  class="form-control"  placeholder="username" aria-label="permission name" aria-describedby="role name addon">
                                                        </div>
                                                    </div>
                                                    <div class=" col-6">
                                                        <label>Email <span class="text-danger">*</span></label>
                                                        <div class="input-group mb-3">
                                                          <input type="email" required name="email"  class="form-control"  placeholder="email" aria-label="permission name" aria-describedby="role name addon">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <label>First Name</label>
                                                        <div class="input-group mb-3">
                                                          <input type="text" required name="firstname"  class="form-control"  placeholder="first name" aria-label="permission name" aria-describedby="role name addon">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <label>Middle Name</label>
                                                        <div class="input-group mb-3">
                                                          <input type="text" required name="middlename"  class="form-control"  placeholder="middle name" aria-label="permission name" aria-describedby="role name addon">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <label>Last Name</label>
                                                        <div class="input-group mb-3">
                                                          <input type="text" name="lastname"  class="form-control"  placeholder="last name" aria-label="permission name" aria-describedby="role name addon">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                  <label for="exampleFormControlSelect1">Branch <span class="text-danger">*</span></label>
                                                  <select name="branch_id" class="form-control" required id="exampleFormControlSelect1">
                                                        <option value="">Assign Branch</option>
                                                      @foreach ($branches as $branch)
                                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                      @endforeach
                                                  </select>
                                                </div>
                                                <div class="form-group">
                                                  <label>Specialties <span class="text-danger">*</span></label>
                                                  <select 
                                                    class="form-control" style="color: black" 
                                                    id="choices-multiple-remove-button" 
                                                    name="specialties[]" 
                                                    multiple 
                                                    data-choices 
                                                    data-choices-removeitem>
                                                      @foreach ($specialties as $spec)
                                                      <option value="{{$spec->id}}" class="">{{$spec->name}}</option>
                                                      @endforeach
                                                  </select>
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
@endsection