@extends('layouts.template')
@section('content')
    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area br_image">
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle">Our Policy</h2>
                <ol class="breadcrumb">
                    <li><a href="index.html">{Praise and Worship}</a></li>
                    <li class="active">Policy</li>
                </ol>
            </div>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->

    <!--================Policy Area =================-->
    <div class="whole-wrap">
        <div class="container">
            <div class="section-top-border">
                <h3 class="mb-30 title_color">{Praise And Worship} Policy</h3>
                <div class="row">
                    <div class="col-12 mt-sm-20 left-align-p">
                        <iframe src="{{asset('image/policy/pw_policy.pdf')}}" class="w-100" style="height: 300vh;" frameborder="0">
                            <div>
                                <h1>Hello there</h1>
                            </div>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================Policy Area =================-->
@endsection
