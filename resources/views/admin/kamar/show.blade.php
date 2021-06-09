@extends('layouts.admin')

@section('content')
<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-12">
            <div class="d-md-flex">
                <ol class="breadcrumb ms-auto">
                    <li><a class="fw-normal">Dashboard</a></li>
                </ol>
            </div>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{route('kamar.index')}}" class="btn btn-sm- btn-outline-secondary">Kembali</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    Detail Kamar
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <img src="{{asset('storage/kamar/' . $data->image)}}" class="img-thumbnail w-50" alt="">
                        </div>
                        <div class="col-md-4">Name</div>
                        <div class="col-md-8 fw-bold mb-3">{{$data->name}}</div>
                        <div class="col-md-4">Price</div>
                        <div class="col-md-8 fw-bold mb-3">Rp. {{ number_format($data->price, 0, ',', '.')}}</div>
                        <div class="col-md-4">Fasilitas</div>
                        <div class="col-md-8 fw-bold mb-3">
                            @foreach ($data->fasilitas as $item)
                            <span class="badge bg-dark">{{$item->name}}</span>
                            @endforeach
                        </div>
                        <div class="col-md-4">Description</div>
                        <div class="col-md-8 fw-bold mb-3">{{$data->description}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
