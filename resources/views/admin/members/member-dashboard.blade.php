@extends('layouts.admin')
@section('content')
<!-- Page Heading-->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$cohort->name}} Membership Dashboard</h1>
    </div>
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <a class="text-decoration-none" href="{{ route('active-members.show', ['cohort' => $cohort->id]) }}">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Active Members</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Members</div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="{{ route('requests.show', ['cohort' => $cohort->id])}}" class="text-decoration-none">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Membership</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Requests</div>
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
            <a href="{{ route('alumni.show', ['cohort' => $cohort->id])}}" class="text-decoration-none">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Passive Members</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Alumni</div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-flag fa-2x text-gray-300"></i>
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
            @if($leader->post != 'member' && $leader->right == 'yes')
                <a class="collapse-item" href="{{route('cohort.show', ['cohort' => $leader->cohort_id])}}">{{$leader->cohort->name}}</a>
            @endif
        @endforeach
    @endif
@endsection
