@extends('layouts.cutube')
@section('content')

<!-- Blog Single Page -->

<div class="page-banner-area" style="background-image:url(../../wp-content/uploads/2018/02/2-2.jpg)">
    <!-- Start Page Banner -->
        <div class="container">
            <div class="row">
			    <div class="page-banner">
					<div class="col-sm-9">
						<div class="page-title">
                            @if ($category == 'event')
                                <h1>{{$event_video->title}}</h1>
                            @else
                                <h1>{{$sermon->title}}</h1>
                            @endif


						</div>
					</div>
					<div class="col-sm-3">
                        <div class="page-breadcrumb">
                            @if ($category == 'event')
                                <p> <a href="{{route('video.show', ['event' => $event_video->event_id])}}">Home</a> / {{$event_video->title}}</p>
                            @else
                                <p> <a href="{{route('sermon.index')}}">Home</a> / {{$sermon->title}}</p>
                            @endif

						</div>

					</div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Banner -->



    <!-- Start Page Content Area -->
    <div class="page-content-area themeix-ptb">
        <div class="container">
            <div class="row">
                @if ($category == 'event')
                    <div class="col-md-8">
                        <!-- Start Video Post -->
                        <div class="video-post-wrapper">


                            <div class="video-posts-video">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe src="{{$event_video->url}}" allowfullscreen class="embed-responsive-item"></iframe>
                                </div>
                            </div>

                            <div id="write-to-pdf">
                            <div class="video-posts-data">

                                <div class="video-post-title">
                                    <span class="video-icons"><i class="fa fa-info-circle"></i></span>
                                    <div class="video-post-info">
                                    <h4 id="pdf-name">{{$event_video->title}}</h4>
                                        <div class="video-post-date">
                                            <span><i class="fa fa-calendar"></i></span>
                                            <p>{{$event_video->updated_at}}, Kisii University Christian Union Main Campus</p>

                                            <span class="video-posts-author">
                                            <i class="fa fa-tag"></i>
                                            By {{ucwords($event_video->event->cohort->name)}}  {{ucwords($event_video->event->cohort->category)}}</span>

                                        </div>
                                    </div>
                                </div>
                                                                                            <div id="ignored-post-share" class="video-post-counter">
                                                                        <div class="video-post-viewers">
                                            <h3>1,303 views </h3>
                                        </div>
                                                                        <div class="video-like">
                                            <span>											 <a href="#" class="jm-post-like button" data-post_id="33" title="Like"><i class="fa fa-thumbs-o-up like-icon"></i>&nbsp;17</a>  										</span>
                                        </div>
                                    </div>
                                                        </div>
                            <div class="video-post-text">

                                    {!!$event_video->description!!}
                            </div>
                            <!-- Start Tags And Share Options -->
                            <div class="tags-and-share">
                                <div class="pagination">
                                    <a href="javascript:void(0)" id="download" class="blog-page current-page transition"><span><i class="fa fa-download"></i> Download</span></a>
                                </div>
                                                            {{-- <div class="share-options">
                                                                    <ul class="blog-share social-share share-container" data-share="['facebook','pinterest','googleplus','twitter','linkedin']"></ul>
                                </div> --}}
                                                        </div>
                            <!-- End Tags And Share Options -->

                            {{-- <!-- Start Posts Pagination -->
                            <div class="posts-pagination">
                                <div class="row">
                                                                                                    <div class="posts-prev">
                                        <div class="col-xs-6 col-sm-5">
                                            <a href="../french-cheese-puffs-gougeres/index.html" class="prev-btn">
                                                                                    Previous Video																				</a>
                                            <p>French Cheese Puffs (Gougeres)</p>
                                        </div>
                                    </div>


                                                                                                    <div class="posts-next">
                                        <div class=" col-xs-6 col-sm-offset-2  col-sm-5">
                                            <a href="../funny-videos-2016-funny-pranks-try-not-to-laugh/index.html" class="next-btn">
                                                                                    Next Video																				</a>
                                            <p>Funny videos 2016 funny pranks try not to laugh</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- End Posts Pagination --> --}}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-8">
                        <!-- Start Video Post -->
                        <div class="video-post-wrapper">


                            <div class="video-posts-video">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe src="{{$sermon->url}}" allowfullscreen class="embed-responsive-item"></iframe>
                                </div>
                            </div>

                            <div id="write-to-pdf">
                            <div class="video-posts-data">

                                <div class="video-post-title">
                                    <span class="video-icons"><i class="fa fa-info-circle"></i></span>
                                    <div class="video-post-info">
                                    <h4 id="pdf-name">{{$sermon->title}}</h4>
                                        <div class="video-post-date">
                                            <span><i class="fa fa-calendar"></i></span>
                                            <p>{{$sermon->date}}, Kisii University Christian Union Main Campus</p>

                                            <span class="video-posts-author">
                                            <i class="fa fa-tag"></i>
                                            By {{$sermon->preacher}}                                        </span>

                                        </div>
                                    </div>
                                </div>
                                                                                            <div id="ignored-post-share" class="video-post-counter">
                                                                        <div class="video-post-viewers">
                                            <h3>1,303 views </h3>
                                        </div>
                                                                        <div class="video-like">
                                            <span>											 <a href="#" class="jm-post-like button" data-post_id="33" title="Like"><i class="fa fa-thumbs-o-up like-icon"></i>&nbsp;17</a>  										</span>
                                        </div>
                                    </div>
                                                        </div>
                            <div class="video-post-text">

                                    {!!$sermon->content!!}
                            </div>
                            <!-- Start Tags And Share Options -->
                            <div class="tags-and-share">
                                <div class="pagination">
                                    <a href="javascript:void(0)" id="download" class="blog-page current-page transition"><span><i class="fa fa-download"></i> Download</span></a>
                                </div>
                                                            {{-- <div class="share-options">
                                                                    <ul class="blog-share social-share share-container" data-share="['facebook','pinterest','googleplus','twitter','linkedin']"></ul>
                                </div> --}}
                                                        </div>
                            <!-- End Tags And Share Options -->

                            {{-- <!-- Start Posts Pagination -->
                            <div class="posts-pagination">
                                <div class="row">
                                                                                                    <div class="posts-prev">
                                        <div class="col-xs-6 col-sm-5">
                                            <a href="../french-cheese-puffs-gougeres/index.html" class="prev-btn">
                                                                                    Previous Video																				</a>
                                            <p>French Cheese Puffs (Gougeres)</p>
                                        </div>
                                    </div>


                                                                                                    <div class="posts-next">
                                        <div class=" col-xs-6 col-sm-offset-2  col-sm-5">
                                            <a href="../funny-videos-2016-funny-pranks-try-not-to-laugh/index.html" class="next-btn">
                                                                                    Next Video																				</a>
                                            <p>Funny videos 2016 funny pranks try not to laugh</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- End Posts Pagination --> --}}
                            </div>
                        </div>
                    </div>
                @endif

				<div class="col-md-offset-1 col-md-3">

					<div class="section-sidebar">

				        				        		<div id="custom-video-recent-posts-2" class="widget widget-block video-sidebar spo-sidebar-widget widget_video_recent_entries">		<div class="themeix-section-h"><span class="heading-icon"><i class="fa fa-tasks" aria-hidden="true"></i></span><h3 class="spo-sidebar-widget-title">Latest Videos</h3></div>
	<div class="video-posts-area">


                    <?php $counter = 0 ?>
                @if (count($sermons) > 0)
                    @foreach ($sermons as $sermon)
                                @if ($counter < 3)
                                    <div class="single-video">
                                                                                <div class="video-img">
                                            <a href="{{route('sermon.show', ['sermon' => $sermon->id])}}">
                                            <img class="lazy" src="{{asset($sermon->image)}}" alt="" /> {{--data---}}
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
                                                            <span>											 <a href="#" class="jm-post-like button" data-post_id="79" title="Like"><i class="fa fa-thumbs-o-up like-icon"></i>&nbsp;8</a>  										</span>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div><?php $counter++ ;?>
                                @else
                                    @break
                                @endif
                    @endforeach
                @else
                    <div class="single-video">
                        <p>No Videos Found</p>
                    </div>
                @endif




	</div>
		{{-- </div>		<div id="custom-video-ctegory-1" class="widget widget-block video-sidebar spo-sidebar-widget widget_video_category">		<div class="themeix-section-h"><span class="heading-icon"><i class="fa fa-tasks" aria-hidden="true"></i></span><h3 class="spo-sidebar-widget-title">Video Categories</h3></div>		 				<ul>
				<li><a href="../../videos_category/appetizers/index.html">Appetizers</a></li>
				<li><a href="../../videos_category/nature/index.html">Nature</a></li>
				<li><a href="../../videos_category/planet/index.html">Planet</a></li>
				<li><a href="../../videos_category/trending/index.html">Trending</a></li>
				</u>
		        		</div> --}}
					</div>

				</div>

            </div>
        </div>
    </div>
    <!-- End Page Content Area -->



    <!-- Start Video Carousel -->
    <div class="video-carousel-area themeix-ptb bg-semi-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="themeix-section-h">
                        <span class="heading-icon"><i class="fa fa-copy"></i></span>
												<h3>Related Videos</h3>

                    </div>
					<div class="video-carousel">

                        <?php $count = 0;?>
                        @if (count($event_videos) > 0)
                            @foreach ($event_videos as $video)
                                @if ($count < 25)
                                    <div class="single-video">
					        							                            <div class="video-img">
                                            <a href="{{route('video.view', ['event' => $video->event->id, 'event_video' => $video->id])}}">
                                            <img class="lazy" data-src="{{asset($video->image)}}" alt="" />
                                            <noscript>
                                                <img src="{{asset($video->image)}}" alt="" />
                                            </noscript>
                                            </a>
                                                                            <span class="video-duration">7.10</span>

                                        </div>
                                                                    <div class="video-content">
                                            <h4><a href="{{route('video.view', ['event' => $video->event->id, 'event_video' => $video->id])}}" class="video-title">{{$video->title}}</a></h4>
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
                                    <?php $count++?>
                                @else
                                    @break
                                @endif
                            @endforeach
                        @endif

			        </div>
		        </div>
		    </div>
		</div>
	</div>


@endsection

@section('js_pdf')
<script type='text/javascript' src="{{asset('template/js/jspdf.min.js')}}"></script>
<script type='text/javascript' src="{{asset('template/js/jquery.min.js')}}"></script>
<script type="text/javascript">
    const downloadBtn = document.querySelector('#download')
    const pdfname = document.querySelector('#pdf-name').textContent

    var fromHtmlPlugin = () => {
        var pdf = new jsPDF('p', 'pt', 'letter')

        // source can be HTML-formatted string, or a reference
        // to an actual DOM element from which the text will be scraped.
        , source = $('#write-to-pdf')[0]

        // we support special element handlers. Register them with jQuery-style
        // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
        // There is no support for any other type of selectors
        // (class, of compound) at this time.
        , specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#ignored-post-share': function(element, renderer){
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        }

        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        // all coords and widths are in jsPDF instance's declared units
        // 'inches' in this case
        pdf.fromHTML(
            source // HTML string or DOM elem ref.
            , margins.left // x coord
            , margins.top // y coord
            , {
                'width': margins.width // max width of content on PDF
                , 'elementHandlers': specialElementHandlers
            },
            function (dispose) {
            // dispose: object with X, Y of the last line add to the PDF
            //          this allow the insertion of new lines after html
                pdf.save(`${pdfname}.pdf`);
            },
            margins
        )
    }

    downloadBtn.onclick = function(){
        fromHtmlPlugin()
    }
</script>
@endsection
