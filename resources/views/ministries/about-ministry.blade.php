@extends('layouts.template')
@section('content')
    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area br_image">
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle">{{$cohort->name}}</h2>
                <ol class="breadcrumb">
                <li><a href="{{route('index')}}">Home</a></li>
                    <li><a href="{{route('cohorts.index')}}">Cohorts</a></li>
                    <li class="active">About {{$cohort->name}}</li>
                </ol>
            </div>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->

    <!--================Sermons work Area =================-->
    <section class="sermons_work_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2>Welcome To {{$cohort->name}}</h2>
                <p>Our Memorable Events</p>
            </div>
            <div class="sermons_slider owl-carousel">
            @if (count($cohort->events) > 0)
                @foreach ($cohort->events as $event)
                    @if ($event->status == 'past')
                        <div class="item row">
                            <div class="col-lg-8">
                                <div class="sermons_image">
                                <img src="{{asset($event->image)}}" alt="cohort image" style="height: 27em;">
                                    <p>{!! $event->description !!}</p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="sermons_content">
                                    <h3 class="title_color">{{$event->name}}</h3>
                                    <ul class="list_style sermons_category">
                                        <li><i class="lnr lnr-user"></i><span>Location: </span><a href="#"> {{$event->location}}</a></li>
                                        <li><i class="lnr lnr-database"></i><span>Event: </span> {{$event->venue}}</li>
                                        <li><i class="lnr lnr-calendar-full"></i><span>Date:</span> {{$event->date}}</li>
                                    </ul>
                                <a href="{{ route('event.show', ['event' => $event->id])}}" class="btn_hover">View More Details</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
                </div>
            </div>
        </div>
    </section>
    <!--================Sermons work Area=================-->

    <!--================ Ministry Description Area =================-->
    <div class="whole-wrap">
        <div class="container">
            @if (count($cohort->membership) > 0)
                @foreach($cohort->membership as $member)
                    @if ($member->post == 'chairperson' && $member->right == 'yes')
                        <div class="section-top-border">
                            <h3 class="mb-30 title_color">Chairperson</h3>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="team_item">
                                        <div class="team_img">
                                        <img src="{{asset($member->user->profile->image)}}" alt="team" class="img-fluid">
                                            <ul class="list_style">
                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="content">
                                            <h3>{{$member->user->profile->sname}} {{$member->user->profile->fname}} {{$member->user->profile->lname}}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9 mt-sm-20 left-align-p">
                                    <p>{{$member->user->profile->sname}} description....</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif

            @if (count($cohort->membership) > 0)
                @foreach($cohort->membership as $member)
                    @if ($member->post == 'secretary' && $member->right == 'yes')
                        <div class="section-top-border">
                            <h3 class="mb-30 title_color">Secretary</h3>
                            <div class="row">
                                <div class="col-md-9 mt-sm-20 left-align-p">
                                    <p>{{$member->user->profile->sname}} description....</p>
                                </div>
                                <div class="col-md-3">
                                    <div class="team_item">
                                        <div class="team_img">
                                        <img src="{{asset($member->user->profile->image)}}" alt="team" class="img-fluid">
                                            <ul class="list_style">
                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="content">
                                            <h3>{{$member->user->profile->sname}} {{$member->user->profile->fname}} {{$member->user->profile->lname}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
            <div class="section-top-border">
            <h3 class="mb-30 title_color">About {{$cohort->name}}</h3>
                <div class="row">
                    <div class="col-lg-12">
                        <blockquote class="generic-blockquote">
                            {!!$cohort->about!!}
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================ Ministry Description Area =================-->

    <!--================Features Area =================-->
    <section class="features_area">
        <div class="row m0">
            <div class="col-md-3 features_item">
                <h3>Our Policy</h3>
            <p>Want to know how we conduct our activities and well acquainted with {{$cohort->name}}?<br>Consider reading through our policies.</p>
                <a href="{{asset($cohort->policy)}}" class="btn_hover view_btn">View Details</a>{{-- 'image/policy/pw_policy.pdf'--}}
            </div>
            <div class="col-md-3 features_item">
                <h3>Members</h3>
            <p>View {{$cohort->name}} members including the alumni and keep in touch witht them as well. <br>A family in Christ working towards evangelising the gospel.</p>
            <a href="{{ route('members.show', ['cohort' => $cohort->id])}}" class="btn_hover view_btn">View Details</a>
            </div>
            <div class="col-md-3 features_item">
                <h3>Our Library</h3>
                <p>Find inspirational, educative, evaluative and religious books books that sourt your needs.<br>Acollection of these from our online library platform.</p>
                <a href="{{ route('library.show', ['id' => 1])}}" class="btn_hover view_btn">View Details</a>
            </div>
            <div class="col-md-3 features_item">
                <h3>Our Gallery</h3>
            <p>Memories of the good and bad times is good. View our collective gallery as {{$cohort->name}} {{$cohort->category}}<br>and walk through our journey upto now.</p>
            <a href="{{ route('cohort-gallery.show', ['cohort' => $cohort->id])}}" class="btn_hover view_btn">View Details</a>
            </div>
        </div>
    </section>
    <!--================Features Area =================-->

    <!--================Event Blog Area=================-->
    <section class="event_blog_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2>Upcoming Events</h2>
                <p>Here are our upcoming events. Follow closely so that you don't miss a single bit.</p>
            </div>
            @if (count($cohort->events) > 0)
                <div class="row">
                    @foreach ($cohort->events as $event)
                        @if ($event->status == 'present')
                            <div class="col-md-4 mb-4">
                                <div class="event_post">
                                <img src="{{asset($event->image)}}" alt="">
                                    <a href="{{ route('event.show', ['event' => $event->id])}}"><h2 class="event_title">{{$event->name}}</h2></a>
                                    <ul class="list_style sermons_category">
                                        <li><i class="lnr lnr-user"></i>{{$event->date}}</li>
                                        <li><i class="lnr lnr-apartment"></i>{{$event->venue}}</li>
                                        <li><i class="lnr lnr-location"></i>{{$event->location}}</li>
                                    </ul>
                                    <a href="{{ route('event.show', ['event' => $event->id])}}" class="btn_hover">View Details</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    <!--================Blog Area=================-->
@endsection
