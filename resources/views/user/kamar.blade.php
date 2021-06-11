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
                            <h2>Kamar</h2>
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
