@extends('layouts.template')
@section('content')
    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area br_image">
            <div class="container">
                <div class="page-cover text-center">
                    <h2 class="page-cover-tittle">Cohorts</h2>
                    <ol class="breadcrumb">
                    <li><a href="{{route('index')}}">Home</a></li>
                        <li class="active">Cohorts</li>
                    </ol>
                </div>
            </div>
        </section>
        <!--================Breadcrumb Area =================-->

        <!--================Event Blog Area=================-->
        <section class="event_blog_area section_gap">
            <div class="container">
                <div class="row ministries_info">
                    @if (count($cohorts) > 0)
                        @foreach($cohorts as $cohort)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="event_post">
                                <img src="{{asset($cohort->image)}}" alt="Cohort Image">
                                <a href="{{ route('cohort', ['cohort' => $cohort->id]) }}"><h2 class="event_title">{{$cohort->name}}</h2></a>
                                    <p>{!! $cohort->about !!}</p>
                                    <a href="{{ route('cohort', ['cohort' => $cohort->id]) }}" class="btn_hover">View Details</a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
        <!--================Blog Area=================-->
@endsection
