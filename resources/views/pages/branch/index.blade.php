@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 ">
                        <div class="d-flex align-items-center justify-content-between">
                            <h6>Branches </h6>
                            <a class="font-weight-bold text-xs btn bg-gradient-success  " style="cursor: pointer"
                                data-bs-target="#addmodal" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Add user">
                                <span>Add Branch</span>
                            </a>
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
                                    <button class=" btn btn-round text-white  bg-primary">
                                        <i class="ni ni-zoom-split-in text-white text-xs opacity-10 "></i>
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
                                            Address</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Office Phone</th>
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
                                    @foreach ($branches as $index=>$branch)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$branch->name}} 
                                                        @if (Auth::user()->id == $branch->id)
                                                            <span class="badge badge-sm bg-gradient-info">your</span>
                                                        @endif
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class=" text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$branch->address}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$branch->phone}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm ">
                                            @if ($branch->status)
                                            <span class="badge badge-sm bg-gradient-success">
                                                 Active
                                            </span>
                                            @else
                                            <span class="badge badge-sm bg-gradient-warning">
                                                InActive
                                            </span>
                                            @endif
                                        </td>
                                        <td class="  align-items-center justify-content-center d-flex gap-4">
                                            <a class="font-weight-bold text-xs btn bg-gradient-secondary  " style="cursor: pointer"
                                                data-bs-target="#editmodal{{$branch->id}}" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Edit user">
                                                <span>Edit</span>
                                            </a>
                                            <a class="font-weight-bold text-xs btn bg-gradient-primary d-flex align-items-center  " style="cursor: pointer"
                                                data-bs-target="#deletemodal{{$branch->id}}" data-bs-toggle="modal" data-toggle="tooltip" data-original-title="Edit user">
                                                <i style="color: white" class="ni ni-fat-remove  text-xs opacity-10"></i>
                                                <span>Delete</span>
                                            </a>
                                        </td>
                                         {{-- edit --}}
                                        <div class="modal fade" id="editmodal{{$branch->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                              <div class="modal-content">
                                                <div class="modal-body p-0">
                                                  <div class="card card-plain">
                                                    <div class="card-header pb-0 text-left">
                                                      <h3 class="font-weight-bolder text-dark">Edit Branch</h3>
                                                    </div>
                                                    <div class="card-body">
                                                      <form action="{{route('users.update',$branch->id)}}" method="post" role="form text-left">
                                                        @method("PUT")
                                                        @csrf
                                                          <label>Name</label>
                                                          <div class="input-group mb-3">
                                                            <input type="text" name="username" value="{{old('username',$branch->username)}}" class="form-control"  placeholder="username" aria-label="permission name" aria-describedby="role name addon">
                                                          </div>
                                                          <label>Address</label>
                                                          <div class="input-group mb-3">
                                                            <input type="text" name="firstname" value="{{old('firstname',$branch->firstname)}}" class="form-control"  placeholder="first name" aria-label="permission name" aria-describedby="role name addon">
                                                          </div>
                                                          <label>Phone</label>
                                                          <div class="input-group mb-3">
                                                            <input type="text" name="middlename" value="{{old('middlename',$branch->middlename)}}" class="form-control"  placeholder="middle name" aria-label="permission name" aria-describedby="role name addon">
                                                          </div>
                                                          {{-- <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Example select</label>
                                                            <select name="role" class="form-control" id="exampleFormControlSelect1">
                                                                <option value="">Assign role</option>
                                                              @foreach ($specilaties as $spec)
                                                                <option value="{{$spec->name}}" {{ $trainer->specialty == $spec->name ? 'selected' : '' }}>{{$role->name}}</option>
                                                              @endforeach
                                                            </select>
                                                          </div> --}}
                                                          <div class="modal-footer">
                                                            <button type="submit" class="btn btn-round bg-primary text-white ">update</button>
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
                                        <div class="modal fade " id="deletemodal{{$branch->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered  modal-md" role="document">
                                              <div class="modal-content card card-body  ">
                                                <div class="modal-header">
                                                  <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                  </button>
                                                </div>
                                                <form action="{{route('branches.destroy',$branch->id)}}" method="post">
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
                                {{ $branches->links('components.pagination') }}
                            </div>
                            
                            {{-- add --}}
                            <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-body p-0">
                                      <div class="card card-plain">
                                        <div class="card-header pb-0 text-left">
                                          <h3 class="font-weight-bolder text-dark">Add Branch</h3>
                                        </div>
                                        <div class="card-body">
                                          <form action="{{route('branches.store')}}" method="post" role="form text-left">
                                            @method("POST")
                                            @csrf
                                                <div class="row">
                                                    <div class=" col-6">
                                                        <label>Branch Name <span class="text-danger">*</span> </label>
                                                        <div class="input-group mb-3">
                                                          <input type="text" required name="name"  class="form-control"  placeholder="branch name" aria-label="permission name" aria-describedby="role name addon">
                                                        </div>
                                                    </div>
                                                    <div class=" col-6">
                                                        <label>Address <span class="text-danger">*</span></label>
                                                        <div class="input-group mb-3">
                                                          <input type="text" required name="address"  class="form-control"  placeholder="addess" aria-label="permission name" aria-describedby="role name addon">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <label>Phone</label>
                                                        <div class="input-group mb-3">
                                                          <input type="text" required name="phone"  class="form-control"  placeholder="phone" aria-label="permission name" aria-describedby="role name addon">
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-4">
                                                        <label>Manager</label>
                                                        <select name="role" class="form-control" required id="exampleFormControlSelect1">
                                                            <option value="">Assign BM</option>
                                                            @foreach ($branchManagers as $bm)
                                                            <option value="{{$bm->id}}">{{$bm->firstname . ' '.$bm->lastname}}</option>
                                                          @endforeach
                                                        </select>
                                                    </div> --}}
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
@endsection
