@extends('layouts.admin')
@section('content')
<!-- Page Heading-->
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{Praise and Worship} Active Members</h1>
    </div> --}}
    <div class="row">
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="card shadow mb-4 border-bottom-primary">
                <div class="card-header py-3 d-flex">
                    <div class="col-10">
                        <strong class="m-0 display-6 font-weight-bold text-primary">KSUCU leaders</strong>
                    </div>
                  <div class="col-auto">
                    <a href="javascript:void(0)" class="btn btn-outline-info btn-sm btn-icon-split" data-toggle="modal" data-target="#leaderModal">
                      <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                      </span>
                      <span class="text">Add Leader</span>
                    </a>
                    </div>
                </div>
                <div class="card-body">
                  <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                      <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 55px;">Image</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 66px;">Name</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 66px;">Cohort</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 31px;">Actions</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 31px;">Administrator</th>
                      </thead>
                      <tfoot>
                        <tr>
                            <th rowspan="1" colspan="1">Image</th>
                            <th rowspan="1" colspan="1">Name</th>
                            <th rowspan="1" colspan="1">Cohort</th>
                            <th rowspan="1" colspan="1">Action</th>
                            <th rowspan="1" colspan="1">Administrator</th>
                        </tr>
                      </tfoot>
                      <tbody>
                          @if (count($leaders) > 0)
                            @foreach ($leaders as $leader)
                                @if ($leader->user->profile != null)
                                    <tr id="m1" role="row" class="odd m-category">
                                        <td class="sorting_1">
                                            <img class="img-profile rounded-circle d-block m-auto" style="height: 50px; width: 50px" src="{{ asset('' . $leader->user->profile->image)}}">
                                        </td>
                                        <td>{{$leader->user->profile->fname}} {{$leader->user->profile->lname}} {{$leader->user->profile->sname}}</td>
                                        <td>{{$leader->cohort->name}}</td>
                                        <td>
                                            <div class="d-flex">
                                            <a href="{{ route('leader.show', ['user' => $leader->user->id])}}" class="btn btn-info btn-circle btn-sm mr-1" >
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if ($leader->right == 'yes')
                                                <span>
                                                <form action="{{ route('leader.update', ['leader' => $leader->id])}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="right" value="no">
                                                        <button type="submit" class="btn btn-success btn-sm btn-icon-split">
                                                            <span class="icon text-white-50">
                                                            <i class="fas fa-check"></i>
                                                            </span>
                                                            <span class="text">Active</span>
                                                        </button>
                                                    </form>
                                                </span>
                                            @else
                                                <span>
                                                    <form action="{{ route('leader.update', ['leader' => $leader->id])}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="right" value="yes">
                                                        <button type="submit" class="btn btn-danger btn-sm btn-icon-split">
                                                            <span class="icon text-white-50">
                                                            <i class="fas fa-exclamation-triangle"></i>
                                                            </span>
                                                            <span class="text">Suspended</span>
                                                        </button>
                                                    </form>
                                                </span>
                                            @endif
                                            <span>
                                                <form action="{{ route('leader.delete', ['leader' => $leader->id])}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger ml-1 btn-circle btn-sm mr-1">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </span>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($leader->right == 'yes' and $leader->post == 'admin')
                                                <span>
                                                    <form action="{{ route('leader.delete', ['leader' => $leader->id])}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-success ml-1 btn-circle btn-sm mr-1">
                                                            <i class="fas fa-star"></i>
                                                        </button>
                                                    </form>
                                                </span>
                                            @else
                                                <span>
                                                    <form action="{{ route('leader.update', ['leader' => $leader->id])}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="right" value="yes">
                                                        <input type="hidden" name="post" value="admin">
                                                        <button type="submit" class="btn btn-danger ml-1 btn-circle btn-sm mr-1">
                                                            <i class="fas fa-star"></i>
                                                        </button>
                                                    </form>
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                          @else
                            <tr>
                                <td>No Leader Found</td>
                            </tr>
                          @endif
                        </tbody>
                    </table>
                </div>
              </div>
        </div>
    </div>

    <!-- Update Modal-->
    <div class="modal fade" id="leaderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Register Leader</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                    <form class="user"  action="{{ route('leader.store')}}" method="POST">
                        @csrf
                            <div class="form-group row">
                            <div class="col-sm-12 mt-3 mb-sm-0">
                                <input type="text" name="username" value="{{old('username')}}" class="form-control form-control-user  @error('username') is-invalid @enderror" placeholder="Username" required>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <select name="cohort_id" id="cohort_id" class="form-control form-control-user p-1 @error('cohort_id') is-invalid @enderror" required>
                                        <option selected>-----SELECT COHORT-----</option>
                                        <option value="0" selected>Super User</option>
                                        @if ($cohorts != null)
                                            @foreach($cohorts as $cohort)
                                                <option value="{{$cohort->id}}">{{$cohort->name}}</option>
                                            @endforeach
                                        @else
                                        @endif
                                    </select>
                                    @error('cohort_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <select name="post" id="post" class="form-control form-control-user p-1 @error('post') is-invalid @enderror">
                                        <option value="admin">Administrator</option>
                                        <option value="overseer">Overseer</option>
                                        <option value="chairperson" selected>Chairperson</option>
                                        <option value="secretary">Secretary</option>
                                        <option value="treasurer">Treasurer</option>
                                    </select>
                                    @error('post')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                <input type="submit" class="btn btn-primary btn-user btn-block" value="Register">
                                </div>
                            </div>
                        </form>
                        </div>
                </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
        </div>
    </div>
@endsection

@section('groups')
    @if (Auth::user()->membership != null)
        @foreach(Auth::user()->membership as $leader)
            @if($leader->post != 'member' && $leader->post != 'alumni' && $leader->right == 'yes')
                <a class="collapse-item" href="{{route('cohort.show', ['cohort' => $leader->cohort_id])}}">{{$leader->cohort->name}}</a>
            @endif
        @endforeach
    @endif
@endsection
