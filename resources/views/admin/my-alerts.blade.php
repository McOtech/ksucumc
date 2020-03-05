@extends('layouts.admin')
@section('content')
<!-- Page Heading-->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Notifications</h1>
    </div>
    <div class="row dropdown-list border-left-info">
        @if (count($alerts) > 0)
            @foreach ($alerts as $alert)
                <div class="col-10 m-auto">
                    <div class="card shadow">
                        <!-- Card Header - Accordion -->
                    <a class="d-flex align-items-center d-block card-header py-3" href="#collapseCardExample{{$alert->id}}"  data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <div class="mr-3">
                                <div class="icon-circle bg-info">
                                <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-blue-500">{{$alert->date}}</div>
                                <span class="font-weight-bold text-dark">{{$alert->title}}</span>
                            </div>
                            </a>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse" id="collapseCardExample{{$alert->id}}">
                        <div class="card-body">
                            {!! $alert->content !!}
                        </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-10 m-auto mb-4">
                <p>No Alerts Found</p>
            </div>
        @endif
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
