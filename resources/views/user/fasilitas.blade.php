@extends('layouts.user')

@section('content')
<main class="my-5">

    <div id="blog" class="blog-area">
        <div class="blog-inner area-padding">
            <div class="blog-overly"></div>
            <div class="container ">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="section-headline text-center">
                            <h2>Fasilitas</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="single-blog">
                            <div class="single-blog-img">
                                <a href="blog.html">
                                    <img src="{{asset('templates/user')}}/assets/img/blog/1.jpg" alt="">
                                </a>
                            </div>
                            <div class="blog-text">
                                <h4>
                                    <a href="blog.html">Assumenda repud eum veniam</a>
                                </h4>
                                <p>
                                    Lorem ipsum dolor sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.
                                </p>
                            </div>
                            <span>
                                <a href="blog.html" class="ready-btn">Detail</a>
                            </span>
                        </div>
                        <!-- Start single blog -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

@endsection
