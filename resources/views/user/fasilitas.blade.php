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

                <section class="mb-5 py-5" style="min-height: 60vh">

                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    @if ($fasilitas->isEmpty())
                                    <div class="col text-center">
                                        <div class="alert alert-warning">
                                            Data tidak ditemukan
                                        </div>
                                    </div>
                                    @else
                                    @foreach ($fasilitas as $item)
                                    <div class="col-md-4 my-3">
                                        <div class="card shadow rounded" data-aos="fade-up">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-2 d-flex justify-content-center">
                                                        <img src="http://hotelkalimosodo.my.id/template-hotel/assets/icon/checked.svg" height="30" width="30" alt="">
                                                    </div>
                                                    <div class="col-9">
                                                        <h5 class="card-title m-0">{{$item->name}}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                </div>
            </div>
        </div>
    </div>

</main>

@endsection
