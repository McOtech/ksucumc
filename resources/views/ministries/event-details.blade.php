@extends('layouts.template')
@section('content')
    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area br_image">
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle">{{$event->name}}</h2>
                <ol class="breadcrumb">
                <li><a href="{{route('index')}}">Home</a></li>
                <li><a href="{{route('cohort', ['cohort' => $event->cohort->id])}}">{{$event->cohort->name}} {{ucwords($event->cohort->category)}}</a></li>
                    <li class="active">{{$event->name}}</li>
                </ol>
            </div>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->
    <section class="event_details_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                <img class="img-fluid" src="{{asset($event->image)}}" alt="">
                </div>
                <div class="col-md-4 align-self-center">
                    <ul class="list_style sermons_category event_category">
                        <li><i class="lnr lnr-user"></i>{{$event->date}}</li>
                        <li><i class="lnr lnr-apartment"></i>{{$event->venue}}</li>
                        <li><i class="lnr lnr-location"></i>{{$event->location}}</li>
                        <li><a href="{{ route('gallery.show', ['event' => $event->id])}}" class="genric-btn info-border circle arrow">Gallery<span class="lnr lnr-arrow-right"></span></a></li>
                        <li><a href="{{ route('video.show', ['event' => $event->id])}}" class="genric-btn info-border circle arrow">Videos<span class="lnr lnr-arrow-right"></span></a></li>
                    </ul>
                </div>
                <div class="col-md-9 event_details">
                    <a href="#"><h2 class="event_title">{{$event->name}}</h2></a>
                    <p>{!!$event->description!!}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
