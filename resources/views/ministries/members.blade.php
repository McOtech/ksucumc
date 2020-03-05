@extends('layouts.template')
@section('content')
    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area br_image">
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle">{{$cohort->name}} Members</h2>
                <ol class="breadcrumb">
                <li><a href="{{route('index')}}">Home</a></li>
                <li><a href="{{route('cohort', ['cohort' => $cohort->id])}}">{{$cohort->name}} {{ucwords($cohort->category)}}</a></li>
                @if ($category == 'members')
                    <li class="active">Members</li>
                @else
                    <li class="active">Alumni</li>
                @endif

                </ol>
            </div>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->

    <!--================Team Area =================-->
    <section class="team_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                @if ($category == 'members')
                    <h2>Current Members</h2>
            <p><a href="{{route('alumni.index', ['cohort' => $cohort->id])}}" class="genric-btn info-border circle arrow">View Alumni Here<span class="lnr lnr-arrow-right"></span></a></p>
                @else
                    <h2>Alumni</h2>
            <p><a href="{{route('members.show', ['cohort' => $cohort->id])}}" class="genric-btn info-border circle arrow">View Active Members Here<span class="lnr lnr-arrow-right"></span></a></p>
                @endif
            </div>
            <?php $noMemberNote = 0; ?>
            <div class="row mb_30">
                @if ($category == 'members')
                    @if (count($cohort->membership) > 0)
                    @foreach($cohort->membership as $member)
                        @if ($member->right == 'yes' and $member->post != 'alumni')
                            <div class="col-md-3 col-sm-6">
                                <div class="team_item">
                                    <div class="team_img">
                                    <img src="{{asset($member->user->profile->image)}}" alt="team">
                                        <ul class="list_style">
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        </ul>
                                    </div>
                                    <a href="#" style="color: inherit;">
                                        <div class="content">
                                            <h3>{{$member->user->profile->fname}} {{$member->user->profile->lname}} {{$member->user->profile->sname}}</h3>
                                            <p>{{ucwords($member->post)}}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php $noMemberNote = 1 ?>
                        @endif
                    @endforeach
                @endif
                @elseif($category == 'alumni')
                    @if (count($cohort->membership) > 0)
                    @foreach($cohort->membership as $member)
                        @if ($member->right == 'yes' and $member->post == 'alumni')
                            <div class="col-md-3 col-sm-6">
                                <div class="team_item">
                                    <div class="team_img">
                                    <img src="{{asset($member->user->profile->image)}}" alt="team">
                                        <ul class="list_style">
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        </ul>
                                    </div>
                                    <a href="#" style="color: inherit;">
                                        <div class="content">
                                            <h3>{{$member->user->profile->fname}} {{$member->user->profile->lname}} {{$member->user->profile->sname}}</h3>
                                            <p>{{ucwords($member->post)}}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php $noMemberNote = 1 ?>
                        @endif
                    @endforeach
                @endif
                @endif

                @if ($noMemberNote == 0)
                    <div class="col-md-3 col-sm-6 m-auto">
                        @if ($category == 'members')
                            {{_('No Active Members Found')}}
                        @else
                            {{_('No Alumni Found')}}
                        @endif

                    </div>
                @endif
            </div>
        </div>
    </section>
    <!--================Team Area =================-->
@endsection
