@extends('layouts.cutube')
@section('content')

    {{-- <div class="page-banner-area" style="background-image:url(../wp-content/uploads/2018/02/2-2.jpg)">
        <div class="container">
            <div class="row">
				<div class="page-banner">
					<div class="col-sm-9">


							<div class="page-title">
															<h1>Grid &#8211; 4 Column</h1>

							</div>


					</div>
					<div class="col-sm-3">
												<div class="page-breadcrumb">
							<p> <a href="../index.html">
																Home
							</a> / Grid &#8211; 4 Column</p>
						</div>

					</div>
				</div>
            </div>
        </div>
    </div>


    <!-- End Page Banner --> --}}


<!--=============== video-grid-wrapper ===============-->





    <div class="video-posts-area themeix-ptb-3 bg-info">
        <div class="container">
            <div class="row">
			    <div class=" col-md-12">
				<div class="row">
                    @if ($determiner == 'event')
                        @if (count($event->videos) > 0)
                            @foreach ($event->videos as $video)
                                <div class="col-md-3 themeix-half">
                                    <div class="single-video">
                                        <div class="video-img">
                                            <a href="{{route('video.view', ['event' => $event->id, 'event_video' => $video->id])}}">
                                            <img class="lazy" data-src="{{asset($video->image)}}" alt="" />
                                            <noscript>
                                            <img src="{{asset($video->image)}}" alt="" />
                                            </noscript>
                                            </a>
                                            <span class="video-duration">7.10</span>
                                        </div>
                                        <div class="video-content">
                                            <h4><a href="{{route('video.view', ['event' => $event->id, 'event_video' => $video->id])}}" class="video-title">{{$video->title}}</a></h4>
                                                                                <div class="video-counter">
                                                                                        <div class="video-viewers">
                                                        <span class="fa fa-eye view-icon"></span>
                                                        <span>513 views</span>
                                                    </div>

                                                    <div class="video-feedback">
                                                        <div class="video-like-counter">
                                                            <span>													 <a href="#" class="jm-post-like button" data-post_id="79" title="Like"><i class="fa fa-thumbs-o-up like-icon"></i>&nbsp;8</a>  												</span>
                                                        </div>
                                                    </div>
                                                </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-3 themeix-half">
                                <p>No Video Found</p>
                            </div>
                        @endif
                    @endif
                    <?php $counter = 0 ?>
                    @if ($determiner == 'all')
                        @if (count($sermons) > 0)
                            @foreach ($sermons as $sermon)
                                <div class="col-md-3 themeix-half">
                                    <div class="single-video">
                                        <div class="video-img">
                                            <a href="{{route('sermon.show', ['sermon' => $sermon->id])}}">
                                            <img class="lazy" data-src="{{asset($sermon->image)}}" alt="" />
                                            <noscript>
                                            <img src="{{asset($sermon->image)}}" alt="" />
                                            </noscript>
                                            </a>
                                            <span class="video-duration">7.10</span>
                                        </div>
                                        <div class="video-content">
                                            <h4><a href="{{route('sermon.show', ['sermon' => $sermon->id])}}" class="video-title">{{$sermon->title}}</a></h4>
                                                                                <div class="video-counter">
                                                                                        <div class="video-viewers">
                                                        <span class="fa fa-eye view-icon"></span>
                                                        <span>513 views</span>
                                                    </div>

                                                    <div class="video-feedback">
                                                        <div class="video-like-counter">
                                                            <span>													 <a href="#" class="jm-post-like button" data-post_id="79" title="Like"><i class="fa fa-thumbs-o-up like-icon"></i>&nbsp;8</a>  												</span>
                                                        </div>
                                                    </div>
                                                </div>

                                        </div>
                                    </div>
                                </div>
                                <?php $counter = 1 ?>
                            @endforeach
                        @endif
                        @if (count($events) > 0)
                            @foreach ($events as $eventVideo)
                                <div class="col-md-3 themeix-half">
                                    <div class="single-video">
                                        <div class="video-img">
                                            <a href="{{route('video.view', ['event' => $eventVideo->event->id, 'event_video' => $eventVideo->id])}}">
                                            <img class="lazy" data-src="{{asset($eventVideo->image)}}" alt="" />
                                            <noscript>
                                            <img src="{{asset($eventVideo->image)}}" alt="" />
                                            </noscript>
                                            </a>
                                            <span class="video-duration">7.10</span>
                                        </div>
                                        <div class="video-content">
                                            <h4><a href="{{route('video.view', ['event' => $eventVideo->event->id, 'event_video' => $eventVideo->id])}}" class="video-title">{{$eventVideo->title}}</a></h4>
                                                                                <div class="video-counter">
                                                                                        <div class="video-viewers">
                                                        <span class="fa fa-eye view-icon"></span>
                                                        <span>513 views</span>
                                                    </div>

                                                    <div class="video-feedback">
                                                        <div class="video-like-counter">
                                                            <span>													 <a href="#" class="jm-post-like button" data-post_id="79" title="Like"><i class="fa fa-thumbs-o-up like-icon"></i>&nbsp;8</a>  												</span>
                                                        </div>
                                                    </div>
                                                </div>

                                        </div>
                                    </div>
                                </div>
                                <?php $counter = 1 ?>
                            @endforeach
                        @endif
                    @endif
                    @if ($counter == 0)
                        <div class="col-md-3 themeix-half">
                            <p>No Video Found</p>
                        </div>
                    @endif

			    </div>
				    <!-- pagination-->
				    <div class='pagination'><a href='#' class='blog-page current-page transition'>1</a><a href='page/2/index.html' class='blog-page transition' >2</a><a href='page/3/index.html' class='blog-page transition' >3</a></div>
			    </div>

            </div>
        </div>
    </div>

@endsection
