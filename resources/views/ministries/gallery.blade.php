@extends('layouts.template')
@section('content')
    @if ($category == 'event')
        <!--================Breadcrumb Area =================-->
        <section class="breadcrumb_area br_image">
            <div class="container">
                <div class="page-cover text-center">
                    <h2 class="page-cover-tittle">{{$event->name}} Event Gallery</h2>
                    <ol class="breadcrumb">
                    <li><a href="{{route('index')}}">Home</a></li>
                    <li><a href="{{route('cohort', ['cohort' => $event->cohort->id])}}">{{$event->cohort->name}} {{ucwords($event->cohort->category)}}</a></li>
                    <li><a href="{{route('event.show', ['event' => $event->id])}}">{{$event->name}}</a></li>
                        <li class="active">Gallery</li>
                    </ol>
                </div>
            </div>
        </section>
        <!--================Breadcrumb Area =================-->

        <!--================Breadcrumb Area =================-->
        <section class="gallery_area section_gap">
            <div class="container">
                <div class="row imageGallery1" id="gallery">
                    @if (count($event->images) > 0)
                        @foreach ($event->images as $image)
                            <div class="col-md-4 gallery_item">
                                <div class="gallery_img">
                                <img src="{{asset($image->image)}}" alt="event image">
                                    <div class="hover">
                                    <a class="light" href="{{asset($image->image)}}"><i class="fa fa-expand"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-4 m-auto gallery_item">
                            <div class="gallery_img">
                            <p>No Images Found</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <!--================Gallery Area =================-->
    @elseif($category == 'cohort')
        <!--================Breadcrumb Area =================-->
        <section class="breadcrumb_area br_image">
            <div class="container">
                <div class="page-cover text-center">
                    <h2 class="page-cover-tittle">{{$cohort->name}} Gallery</h2>
                    <ol class="breadcrumb">
                    <li><a href="{{route('index')}}">Home</a></li>
                    <li><a href="{{route('cohort', ['cohort' => $cohort->id])}}">{{$cohort->name}} {{ucwords($cohort->category)}}</a></li>
                        <li class="active">Gallery</li>
                    </ol>
                </div>
            </div>
        </section>
        <!--================Breadcrumb Area =================-->

        <!--================Breadcrumb Area =================-->
        <section class="gallery_area section_gap">
            <div class="container">
                <div class="row imageGallery1" id="gallery">
                    @if (count($cohort->images) > 0)
                        @foreach ($cohort->images as $image)
                            <div class="col-md-4 gallery_item">
                                <div class="gallery_img">
                                <img src="{{asset($image->image)}}" alt="event image">
                                    <div class="hover">
                                    <a class="light" href="{{asset($image->image)}}"><i class="fa fa-expand"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-4 m-auto gallery_item">
                            <div class="gallery_img">
                            <p>No Images Found</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <!--================Gallery Area =================-->
    @endif

@endsection

@section('footer')
    <script src="{{asset('template/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('template/js/popper.js')}}"></script>
    <script src="{{asset('template/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('template/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('template/vendors/lightbox/simpleLightbox.min.js')}}"></script>
    <script src="{{asset('template/vendors/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('template/vendors/isotope/isotope-min.js')}}"></script>
    <script src="{{asset('template/js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('template/js/mail-script.js')}}"></script>
    <script src="{{asset('template/vendors/nice-select/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('template/js/stellar.js')}}"></script>
    <script src="{{asset('template/js/custom.js')}}"></script>
@endsection
