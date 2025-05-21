@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User Management / permissions'])
    <div class="container-fluid py-1">
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex align-items-center  justify-content-between">
                <h6>Permissions</h6>
                <a data-bs-toggle="modal" data-original-title="delete" data-bs-target="#addmodal" class="btn bg-success text-white">Add</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    #</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Permission</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $index=>$permission )
                            <tr>
                                <td class=" px-4 ">
                                    <p class="text-xs font-weight-bold mb-0">{{$index+1}}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{$permission->name}}</p>
                                </td>
                                <td class="align-items-center justify-content-center  d-flex gap-4">
                                    <a  class="btn text-secondary font-weight-bold text-sm bg-secondary d-flex align-items-center  gap-2"
                                        data-bs-toggle="modal" data-bs-target="#editmodal{{$permission->id}}" data-original-title="Edit">
                                        {{-- <i style="color: white" class="ni ni-ruler-pencil text-sm opacity-10"></i> --}}
                                        <span class="" style="color: white">Edit</span>
                                    </a>
                                    <a class="btn text-secondary font-weight-bold text-xs d-flex align-items-center bg-danger text-white"
                                        data-bs-toggle="modal" data-bs-target="#deletemodal{{$permission->id}}" data-original-title="delete">
                                        <i style="color: white" class="ni ni-fat-remove  text-sm opacity-10"></i>
                                        <span class="" style="color: white">Delete</span>
                                    </a>
                                </td>

                                {{-- edit --}}
                                    <div class="modal fade" id="editmodal{{$permission->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                          <div class="modal-body p-0">
                                            <div class="card card-plain">
                                              <div class="card-header pb-0 text-left">
                                                <h3 class="font-weight-bolder text-dark">Edit Permission : {{$permission->name}}</h3>
                                                {{-- <p class="mb-0">Enter your email and password to sign in</p> --}}
                                              </div>
                                              <div class="card-body">
                                                <form action="{{route('permissions.update',$permission->id)}}" method="POST">
                                                  @method('PUT')
                                                  @csrf
                                                  <label>Permission Name</label>
                                                  <div class="input-group mb-3">
                                                    <input type="text" name="name" class="form-control" value="{{old('name',$permission->name)}}" placeholder="permission name" aria-label="permission name" aria-describedby="role name addon">
                                                  </div>
                                                  {{-- <div>
                                                    <label>Permissions</label>
                                                    <div class="mb-3 row">
                                                        @foreach($permissions as $permission)
                                                            <div class="form-check d-flex col-md-4">
                                                                <input class="form-check" type="checkbox" 
                                                                       name="permissions[]" 
                                                                       value="{{ $permission->name }}" 
                                                                       id="perm-{{ $permission->id }}"
                                                                       {{ $permission->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                                <label class="form-check" for="perm-{{ $permission->id }}">
                                                                    {{ ucwords(str_replace('_', ' ', $permission->name)) }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                  </div> --}}
                                                  <div class="modal-footer">
                                                    <button type="submit" class="btn btn-round bg-primary text-white ">update</button>
                                                    <button type="reset" data-bs-dismiss="modal" class="btn btn-round bg-secondary text-white ">cancel</button>
                                                  </div>
                                                </form>
                                              </div>
                                              
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                
                                    {{-- delete --}}
                                        <div class="modal fade " id="deletemodal{{$permission->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered  modal-md" role="document">
                                            <div class="modal-content card card-body  ">
                                              <div class="modal-header">
                                                <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">×</span>
                                                </button>
                                              </div>
                                              <form action="{{route('permissions.destroy',$permission->id)}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <div class="modal-body ">
                                                    <div class="py-3 text-center  ">
                                                      <i class="ni ni-bell-55 ni-3x text-danger"></i>
                                                      <h4 class="text-gradient text-danger mt-2">Are you sure?</h4>
                                                      <p class="text-secondary">Are you sure to delete this record? this action is irreversible</p>
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
                                      </div>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{$permissions->links()}} --}}
                    <div class="flex justify-center mt-4">
                        {{-- {{ $permissions->links() }} --}}
                        {{ $permissions->links('components.pagination') }}
                    </div>

                    {{-- add --}}
                    <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-body p-0">
                              <div class="card card-plain">
                                <div class="card-header pb-0 text-left">
                                  <h3 class="font-weight-bolder text-dark">Add Permission</h3>
                                </div>
                                <div class="card-body">
                                  <form action="{{route('permissions.store')}}" method="post" role="form text-left">
                                    @method("POST")
                                    @csrf
                                    <label>Permission Name</label>
                                    <div class="input-group mb-3">
                                      <input type="text" name="name" class="form-control"  placeholder="permission name" aria-label="permission name" aria-describedby="role name addon">
                                    </div>
                                    {{-- <div>
                                        <label>Permissions</label>
                                        <div class="mb-3 row">
                                            @foreach($permissions as $permission)
                                                <div class=" d-flex col-md-4 custom-checkbox-wrapper">
                                                    <input class=" " type="checkbox" 
                                                           name="permissions[]" 
                                                           value="{{ $permission->name }}"
                                                           id="perm-{{$permission->id}}" 
                                                           >
                                                    <label class="form-check-" for="perm-{{ $permission->id }}">
                                                        {{ ucwords(str_replace('_', ' ', $permission->name)) }}
                                                        <div class="tick_mark"></div>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>

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
<style>
* {
  -webkit-tap-highlight-color: transparent;
  outline: none;
}

._checkbox  {
  display: none;
}

.form-check-label {
  position: absolute;
  top: 1%;
  right: 0;
  left: 0;
  width: 10px;
  height: 10px;
  margin: 0 auto;
  background-color: #f72414;
  transform: translateY(-10%);
  border-radius: 50%;
  box-shadow: 0 7px 10px #ffbeb8;
  cursor: pointer;
  transition: 0.2s ease transform, 0.2s ease background-color,
    0.2s ease box-shadow;
  overflow: hidden;
  z-index: 1;
}

.form-check-label:before {
  content: "";
  position: absolute;
  top: 1%;
  right: 0;
  left: 0;
  width: 10px;
  height: 10px;
  margin: 0 auto;
  background-color: #fff;
  transform: translateY(-10%);
  border-radius: 50%;
  box-shadow: inset 0 7px 10px #ffbeb8;
  transition: 0.2s ease width, 0.2s ease height;
}

.form-check-label:hover:before {
  width: 55px;
  height: 55px;
  box-shadow: inset 0 7px 10px #ff9d96;
}

.form-check-label:active {
  transform: translateY(-50%) scale(0.9);
}

.tick_mark {
  position: absolute;
  top: -1px;
  right: 0;
  left: 0;
  width: 6px;
  height: 6px;
  margin: 0 auto;
  margin-left: 1px;
  transform: rotateZ(-40deg);
}

.tick_mark:before,
.tick_mark:after {
  content: "";
  position: absolute;
  background-color: #fff;
  border-radius: 2px;
  opacity: 0;
  transition: 0.2s ease transform, 0.2s ease opacity;
}

.tick_mark:before {
  left: 0;
  bottom: 0;
  width: 3px;
  height: 3px;
  box-shadow: -2px 0 5px rgba(0, 0, 0, 0.23);
  transform: translateY(-68px);
}

.tick_mark:after {
  left: 0;
  bottom: 0;
  width: 100%;
  height: 2px;
  box-shadow: 0 3px 5px rgba(0, 0, 0, 0.23);
  transform: translateX(78px);
}

._checkbox:checked + label {
  background-color: #07d410;
  box-shadow: 0 7px 10px #92ff97;
}

._checkbox:checked + label:before {
  width: 0;
  height: 0;
}

._checkbox:checked + label .tick_mark:before,
._checkbox:checked + label .tick_mark:after {
  transform: translate(0);
  opacity: 1;
}

</style>
@endsection