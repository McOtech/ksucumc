@extends('layouts.admin')
@section('content')
<!-- Page Heading-->
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{Praise and Worship} Active Members</h1>
    </div> --}}
    <div class="row">
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="card shadow mb-4 border-bottom-primary">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">{{$cohort->name}} Active Members</h6>
                </div>
                <div class="card-body">
                  <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                      <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 55px;">Image</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 66px;">Name</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 66px;">Contact</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 31px;">Actions</th>
                      </thead>
                      <tfoot>
                        <tr>
                            <th rowspan="1" colspan="1">Image</th>
                            <th rowspan="1" colspan="1">Name</th>
                            <th rowspan="1" colspan="1">Contact</th>
                            <th rowspan="1" colspan="1">Action</th>
                        </tr>
                      </tfoot>
                      <tbody>
                          <?php $notFound = 0; ?>
                          @if ($cohort != null)
                            @foreach ($cohort->membership as $member)
                                @if ($member->right == 'yes' && $member->post != 'alumni' && $member->cohort_id == $cohort->id)
                                    <tr role="row" class="odd m-category">
                                        <td class="sorting_1">
                                        <img class="img-profile rounded-circle d-block m-auto" style="height: 50px; width: 50px" src="{{ asset('' . $member->user->profile->image)}}">
                                        </td>
                                        <td>{{$member->user->profile->fname}} {{$member->user->profile->lname}} {{$member->user->profile->sname}}</td>
                                        <td>{{$member->user->profile->phone}}</td>
                                        <td>
                                            <div class="d-flex">
                                            <a href="{{route('leader.show', ['user' => $member->user->id])}}" class="btn btn-info btn-circle btn-sm mr-1">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <span>
                                                <form action="{{route('leader.update', ['leader' => $member->id])}}" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="right" value="yes">
                                                    <input type="hidden" name="post" value="alumni">
                                                    <button type="submit" class="btn btn-danger btn-sm btn-icon-split">
                                                        <span class="icon text-white-50">
                                                        <i class="fas fa-flag"></i>
                                                        </span>
                                                        <span class="text">Join Alumni</span>
                                                    </button>
                                                </form>
                                            </span>
                                            </div>
                                        </td>
                                        <?php $notFound = 1; ?>
                                    </tr>
                                @endif
                            @endforeach
                          @endif
                          @if ($notFound == 0)
                            <tr><td>No Member Found</td> </tr>
                          @endif
                        </tbody>
                    </table>
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
