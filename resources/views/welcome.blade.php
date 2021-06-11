@extends('layouts.user')

@section('content')
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
    <div class="container position-relative text-lg-start" data-aos="zoom-in" data-aos-delay="100">
      <div class="row">
        <div class="col-lg-8">
          <h1>Welcome to <span>Hotelly</span></h1>
          <h2>Find Perfect Comfort in Your Vacation!</h2>
        </div>
      </div>
    </div>
  </section>
<section id="about" class="about">
    <div class="container" data-aos="fade-up">

      <div class="row">
        <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="100">
          <div class="about-img">
            <img src="templates/user/assets/img/about/about.jpg" alt="">
          </div>
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
          <h3>Hotelly Lampung</h3><br>
          <p class="fst-italic">
            Hotelly memiliki 286 kamar yang akan memberikan kenyamanan extra untuk anda.
            Hanya berjarak 15 menit naik mobil dari Pusat Wisata Lampung. Tiap kamar dilengkapi TV layar datar,
            shower, dan WIFI . Hotelly juga menyediakan sarapan prasmanan dan area parkir di lokasi hotel yang luas.
          </p><br>
          <p>
            Hotelly terletak di area Wisata . Dekat ke Pantai, area perkantoran, dan area gudang industri,
            sehingga cocok untuk berlibur atau keperluan bisnis.
          </p>
        </div>
      </div>

    </div>
  </section>
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
