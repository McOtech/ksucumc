@extends('layouts.template')
@section('content')
    <section class="event_blog_area section_gap">
        <div class="container">
            <div class="row">
                <?php $counter = 0 ?>
                @if (count($sermons) > 0)
                    @foreach ($sermons as $sermon)
                        <div class="col-md-4">
                            <div class="event_post">
                            <img src="{{asset($sermon->image)}}" alt="">
                                <a href="{{route('sermon.show', ['sermon' => $sermon->id])}}"><h2 class="event_title">{{$sermon->title}}</h2></a>
                                <ul class="list_style sermons_category">
                                    <li><i class="lnr lnr-user"></i>By {{$sermon->preacher}}</li>
                                    <li><i class="fa fa-calendar"></i>{{$sermon->date}}</li>
                                </ul>
                            <a href="{{route('sermon.show', ['sermon' => $sermon->id])}}" class="btn_hover">View Details</a>
                            </div>
                        </div>
                        <?php $counter = 1; ?>
                    @endforeach
                @endif
                @if ($counter == 0)
                    <div class="col-12">
                        <p>No Sermons Found.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
