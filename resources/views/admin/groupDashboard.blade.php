@extends('layouts.admin')
@section('content')
<!-- Page Heading-->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$cohort->name}} Dashboard</h1>
    </div>
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <a class="text-decoration-none" href="{{ route('event.edit', ['cohort' => $cohort->id])}}">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Event Profile</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Past Events</div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="{{ route('event.create', ['cohort' => $cohort->id])}}" class="text-decoration-none">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Notification</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Scheduled Events</div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="{{ route('cohort.edit', ['cohort' => $cohort->id])}}" class="text-decoration-none">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">About {{$cohort->name}}</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Profile</div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-info-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
        <a href="{{ route('member-dashboard.show', ['cohort' => $cohort->id])}}" class="text-decoration-none">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Membership</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">View Members</div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="#" class="text-decoration-none">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Library</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">E-Books</div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
        <a href="{{route('cohort-image.create', ['cohort' => $cohort->id])}}" class="text-decoration-none">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Gallery</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Recording</div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-image fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
            </a>
        </div>

        @foreach ($cohort->permissions as $permission)
            @if ($permission->right == 'publish')
                <!-- Pending Requests Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="#" class="text-decoration-none">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Content Management</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Publish Content</div>
                                </div>
                                <div class="col-auto">
                                <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                </div>
                            </div>
                            </div>
                        </div>
                    </a>
                </div>
            @elseif($permission->right == 'alerts')
                <!-- Pending Requests Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="{{route('alert.create')}}" class="text-decoration-none">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Alerts</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Approve Alerts</div>
                                    </div>
                                    <div class="col-auto">
                                    <i class="fas fa-bell fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </a>
                    </div>
            @elseif($permission->right == 'photos')
                <!-- Pending Requests Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="{{route('photo.create')}}" class="text-decoration-none">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Trade</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Photos</div>
                                    </div>
                                    <div class="col-auto">
                                    <i class="fas fa-images fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </a>
                    </div>
            @elseif($permission->right == 'sermons')
                <!-- Sermons Card -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <a class="text-decoration-none" href="{{ route('sermon.create')}}">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Sermons</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Edit Sermons</div>
                                </div>
                                <div class="col-auto">
                                <i class="fas fa-bible fa-2x text-gray-300"></i>
                                </div>
                            </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach

        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
        <a href="{{route('cohort', ['cohort' => $cohort->id])}}" class="text-decoration-none">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">View</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$cohort->name}}</div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-eye fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
            </a>
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
