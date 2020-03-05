@extends('layouts.template')
@section('content')
    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area br_image">
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle">Library Collection</h2>
                <ol class="breadcrumb">
                    <li><a href="index.html">{Praise and Worship}</a></li>
                    <li class="active">Videos</li>
                </ol>
            </div>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->

    <!--================ Books Start =================-->
    <div class="whole-wrap">
        <div class="container">
            <div class="section-top-border text-left">
                <h3 class="mb-30 title_color">Library</h3>
                <div class="row">
                    <div class="col-12 p-3">
                        <div class="row">
                            <div class="col-md-9">
                                <blockquote class="generic-blockquote">
                                    <h6 class="title_color">Issue 19</h6>
                                    “Recently, the US Federal government banned online casinos from operating in America by making it illegal to transfer money to them through any US bank or payment system. Listed in this article are the electronic banking”
                                    <div class="p-1 text-right">
                                    <a href="{{ asset('image/policy/pw_policy.pdf') }}" class="genric-btn info-border circle arrow small">Preview<span class="lnr lnr-arrow-right"></span></a>
                                    </div>
                                </blockquote>
                            </div>
                            <div class="col-md-3">
                                <img src="{{asset('image/elements/d.jpg')}}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 p-3">
                        <div class="row">
                            <div class="col-md-9">
                                <blockquote class="generic-blockquote">
                                    “Recently, the US Federal government banned online casinos from operating in America by making it illegal to transfer money to them through any US bank or payment system. As a result of this law, most of the popular online casino networks such as Party Gaming and PlayTech left the United States. Overnight, online casino players found themselves being chased by the Federal government. But, after a fortnight, the online casino industry came up with a solution and new online casinos started taking root. These began to operate under a different business umbrella, and by doing that, rendered the transfer of money to and from them legal. A major part of this was enlisting electronic banking systems that would accept this new clarification and start doing business with me. Listed in this article are the electronic banking”
                                    <div class="p-1 text-right">
                                    <a href="{{ asset('image/policy/pw_policy.pdf') }}" class="genric-btn info-border circle arrow small">Preview<span class="lnr lnr-arrow-right"></span></a>
                                    </div>
                                </blockquote>
                            </div>
                            <div class="col-md-3">
                                <img src="{{asset('image/elements/d.jpg')}}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================ Books End ===================-->
@endsection

{{--@section('footer')
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
@endsection--}}
