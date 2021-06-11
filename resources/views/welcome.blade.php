@extends('layouts.user')

@section('content')
<div id="home" class="slider-area">
    <div class="bend niceties preview-2">
        <div id="ensign-nivoslider" class="slides">
            <img src="{{asset('templates/user')}}/assets/img/slider/slider3.jpg" alt="" title="#slider-direction-3" />
        </div>
        <!-- direction 3 -->
        <div id="slider-direction-3" class="slider-direction slider-two">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="slider-content">
                            <div class="layer-1-1 hidden-xs wow animate__slideInUp animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                                <h2 class="title1">WELCOME TO HOTELLY</h2>
                            </div>
                            <div class="layer-1-2 wow animate__fadeIn animate__animated" data-wow-duration="2s" data-wow-delay=".1s">
                                <h1 class="title2">Helping Business Security & Peace of Mind for Your Family</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<main>
    <div id="blog" class="blog-area">
        <div class="blog-inner area-padding">
            <div class="blog-overly"></div>
            <div class="container ">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="section-headline text-center">
                            <h2>Kamar Terfavorit</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- Jika data kamar kosong --}}
                    @if ($kamar->isEmpty())
                    <div class="col-12">
                        <div class="alert alert-danger">
                            Kamar masih belum tersedia.
                        </div>
                    </div>
                    @else
                    {{-- Jika data kamar ada --}}
                    @foreach ($kamar as $item)
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="single-blog">
                            <div class="single-blog-img">
                                <a href="{{route('beranda.showkamar', $item->id)}}">
                                    <img src="{{asset('storage/kamar/' . $item->image)}}" class="img-thumbnail" alt="">
                                </a>
                            </div>
                            <div class="blog-text mt-3">
                                <h4>
                                    <a href="{{route('beranda.showkamar', $item->id)}}">{{$item->name}}</a>
                                </h4>
                                <p>
                                    {{strlen($item->description) > 100 ? substr($item->description, 0, 100) . '...' : $item->description}}
                                </p>
                            </div>
                            <span>
                                <a href="{{route('beranda.showkamar', $item->id)}}" class="ready-btn">Detail</a>
                            </span>
                        </div>
                    </div>
                    @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>

</main>

@endsection
