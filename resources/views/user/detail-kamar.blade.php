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
                            <h2>Detail Kamar</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <img src="{{asset('storage/kamar/'.$kamar->image)}}" class="w-100 img-thumbnail mb-4" alt="">
                        <h3>{{$kamar->name}}</h3>
                        <h4 class="text-primary">Rp {{number_format($kamar->price, 0, ',', '.')}}<sub>/malam</sub> </h4>
                        <hr>
                        <h5>Overview</h5>
                        <p>{{$kamar->description}}</p>
                        <h5>Fasilitas</h5>
                        <div class="row">
                            {{-- Jika kamar mempunyai fasilitas --}}
                            @if ($kamar->fasilitas)
                            @foreach ($kamar->fasilitas as $item)
                            <div class="col-md-6">
                                <span class="badge badge-info p-2">{{$item->name}}</span>
                            </div>
                            @endforeach
                            @else
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    Kamar ini belum tersedia fasilitas.
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card rounded">
                            <div class="card-header text-center">
                                <h5 class="card-title m-0">Pemesanan Kamar</h5>
                            </div>
                            <div class="card-body">
                                <div class="card mb-3">
                                    <div class="card-body text-center">
                                        <h5 class="card-title mb-1">{{$kamar->name}}</h5>
                                        <h5 class="m-0 font-weight-bold text-primary">Rp. {{$kamar->price}}
                                            <sub class="font-weight-normal">/malam</sub>
                                        </h5>
                                    </div>
                                </div>
                                <form action="" method="POST">
                                    @csrf
                                    <input type="hidden" name="kamar_id" value="{{ $kamar->id}}">
                                    <div class="form-group">
                                        <label for="check_in">Check-in</label>
                                        <input type="date" class="form-control" id="check_in" name="check_in" placeholder="Check-in">
                                        @error('check_in')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="check_out">Check-out</label>
                                        <input type="date" class="form-control" id="check_out" name="check_out" placeholder="Check-out">
                                        @error('check_out')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="guest">Jumlah Orang</label>
                                        <input type="number" class="form-control" id="guest" name="guest" placeholder="Jumlah Orang" min="1">

                                        @error('guest')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-body text-center">
                                            <h5 class="card-title mb-1 font-weight-bold">TOTAL HARGA</h5>
                                            <h5 class="m-0 font-weight-bold text-danger">Rp. <span id="set-price"></span>
                                                <sub class="font-weight-normal">/malam</sub>
                                            </h5>
                                        </div>
                                    </div>
                                    @if (Auth::user())
                                    {{-- @if (isset($reserv))
                                    <button type="button" class="btn btn-danger w-100" disabled>Sudah Dipesan</button>
                                    @else --}}
                                    <button type="submit" class="btn btn-primary w-100">Pesan Sekarang</button>
                                    {{-- @endif --}}
                                    @else
                                    <a href="{{ route('login')}}" class="btn btn-primary w-100">Login Terlebih Dahulu</a>
                                    @endif
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

@endsection

@section('script')
<script>
    $(document).ready(function() {

        function parseDate(str) {
            var mdy = str.split('-');
            return new Date(mdy[0], mdy[1] - 1, mdy[2]);
        }

        function datediff(first, second) {
            return Math.round((second - first) / (1000 * 60 * 60 * 24));
        }

        var day = '';
        var cinValue = '';
        var coutValue = '';
        var price = "{{$kamar->price}}";
        $('#set-price').html(price)

        function cout(cout2) {
            return coutValue = cout2;
        }

        function cin(cin2) {
            return cinValue = cin2;
        }

        function getDays(cin, cout) {
            return datediff(parseDate(cin), parseDate(cout));
        }

        $('#check_in').on('change', function() {
            cin(this.value)
            day = getDays(cinValue, coutValue)
            $('#set-price').html(setPrice(day, price))
        });
        $('#check_out').on('change', function() {
            cout(this.value)
            day = getDays(cinValue, coutValue)
            $('#set-price').html(setPrice(day, price))
        });

        $('#guest').on('change', function() {
            guest = this.value;
            $('#set-price').html(setPrice(day, price))
        })

        function setPrice(days, price) {
            return days * price;
        }

    });

</script>
@endsection
