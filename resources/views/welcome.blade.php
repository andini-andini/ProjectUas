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
          <h3>Hotelly</h3><br>
          <p class="fst-italic">
            Hotelly has 286 rooms that will provide extra comfort for you.
            It is only 15 minutes by car from Lampung Tourism Center.
            Each room is equipped with a flat screen TV, shower and WIFI .
            Hotelly also provides a buffet breakfast and a large on-site parking area.
          </p><br>
          <p>
            Hotelly is located in the tourist area. Close to the beach, office areas,
            and industrial warehouse areas, making it suitable for vacation or business purposes.
          </p>
        </div>
      </div>

    </div>
  </section>
<main>
    <div id="blog" class="blog-area" style="background-color: rgb(17, 17, 17)">
        <div class="blog-inner area-padding">
            <div class="blog-overly"></div>
            <div class="container ">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="section-headline text-left">
                            <h2 style="color: #cda45e">Favorite Room</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- Jika data kamar kosong --}}
                    @if ($kamar->isEmpty())
                    <div class="col-12">
                        <div class="alert alert-danger">
                            Room still not available.
                        </div>
                    </div>
                    @else
                    {{-- Jika data kamar ada --}}
                    @foreach ($kamar as $item)
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="single-blog">
                            <div class="single-blog-img">
                                <a href="{{route('beranda.showkamar', $item->id)}}" >
                                    <img src="{{asset('storage/kamar/' . $item->image)}}"  style="height: 300px" class="img-thumbnail" alt="">
                                </a>
                            </div>
                            <div class="blog-text mt-3">
                                <h4>
                                    <a href="{{route('beranda.showkamar', $item->id)}}">{{$item->name}}</a>
                                </h4>
                                <p style="color: #ffffff">
                                    {{strlen($item->description) > 100 ? substr($item->description, 0, 100) . '...' : $item->description}}
                                </p>
                            </div>
                            <span>
                                <a href="{{route('beranda.showkamar', $item->id)}}" class="ready-btn">Details</a>
                            </span>
                        </div>
                    </div>
                    @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>

<!-- ======= Portfolio Section ======= -->
<div id="portfolio" class="portfolio-area area-padding fix">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-left">
            <h3 style="color: rgb(83, 83, 83)">Gallery</h3>
            <h2 style="color: #cda45e">Some photos from Our Hotel</h2>
          </div>
        </div>
      </div>
      <div class="row wesome-project-1 fix">
        <!-- Start Portfolio -page -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="awesome-menu ">
            <ul class="project-menu">
              <li>
                <a href="#" class="active" data-filter="*">All</a>
              </li>
              <li>
                <a href="#" data-filter=".party">Party</a>
              </li>
              <li>
                <a href="#" data-filter=".restaurant">Restaurant</a>
              </li>
              <li>
                <a href="#" data-filter=".photo">Photoshop</a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="row awesome-project-content">
        <!-- single-awesome-project start -->
        <div class="col-md-4 col-sm-4 col-xs-12 party">
          <div class="single-awesome-project">
            <div class="awesome-img">
              <a href="#"><img src="templates/user/assets/img/portfolio/1.jpg" alt="" /></a>
              <div class="add-actions text-center">
                <div class="project-dec">
                  <a class="venobox" data-gall="myGallery" href="templates/user/assets/img/portfolio/1.jpg">
                    <h4>Men Party</h4>
                    <span>Photoshot</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- single-awesome-project end -->
        <!-- single-awesome-project start -->
        <div class="col-md-4 col-sm-4 col-xs-12 party">
          <div class="single-awesome-project">
            <div class="awesome-img">
              <a href="#"><img src="templates/user/assets/img/portfolio/2.jpg" alt="" /></a>
              <div class="add-actions text-center">
                <div class="project-dec">
                  <a class="venobox" data-gall="myGallery" href="templates/user/assets/img/portfolio/2.jpg">
                    <h4>Birthday Patry</h4>
                    <span>Photoshot</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- single-awesome-project end -->
        <!-- single-awesome-project start -->
        <div class="col-md-4 col-sm-4 col-xs-12 photo restaurant">
          <div class="single-awesome-project">
            <div class="awesome-img">
              <a href="#"><img src="templates/user/assets/img/portfolio/3.jpg" alt="" /></a>
              <div class="add-actions text-center">
                <div class="project-dec">
                  <a class="venobox" data-gall="myGallery" href="templates/user/assets/img/portfolio/3.jpg">
                    <h4>Restaurant</h4>
                    <span>Room</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- single-awesome-project end -->
        <!-- single-awesome-project start -->
        <div class="col-md-4 col-sm-4 col-xs-12 party">
          <div class="single-awesome-project">
            <div class="awesome-img">
              <a href="#"><img src="templates/user/assets/img/portfolio/4.jpg" alt="" /></a>
              <div class="add-actions text-center">
                <div class="project-dec">
                  <a class="venobox" data-gall="myGallery" href="templates/user/assets/img/portfolio/4.jpg">
                    <h4>Christmas Party</h4>
                    <span>Photoshot</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- single-awesome-project end -->
        <!-- single-awesome-project start -->
        <div class="col-md-4 col-sm-4 col-xs-12 restaurant">
          <div class="single-awesome-project">
            <div class="awesome-img">
              <a href="#"><img src="templates/user/assets/img/portfolio/5.jpg" alt="" /></a>
              <div class="add-actions text-center text-center">
                <div class="project-dec">
                  <a class="venobox" data-gall="myGallery" href="templates/user/assets/img/portfolio/5.jpg">
                    <h4>Middle Eastern Food</h4>
                    <span>Food</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- single-awesome-project end -->
        <!-- single-awesome-project start -->
        <div class="col-md-4 col-sm-4 col-xs-12 photo">
          <div class="single-awesome-project">
            <div class="awesome-img">
              <a href="#"><img src="templates/user/assets/img/portfolio/6.jpg" alt="" /></a>
              <div class="add-actions text-center">
                <div class="project-dec">
                  <a class="venobox" data-gall="myGallery" href="templates/user/assets/img/portfolio/6.jpg">
                    <h4>Receptionist</h4>
                    <span>Room</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- single-awesome-project end -->
      </div>
    </div>
  </div><!-- End Portfolio Section -->


</main>

@endsection
