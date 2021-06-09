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
            <a href="{{route('user.index')}}" class="btn btn-sm- btn-outline-secondary">Kembali</a>
        </div>
    </div>

    <div class="row">
        @if (Session::has('success'))
        <div class="col mb-4">
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        </div>
        @endif
        @if (Session::has('error'))
        <div class="col mb-4">
            <div class="alert alert-danger">
                {{Session::get('error')}}
            </div>
        </div>
        @endif

        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    Tambah User
                </div>
                <div class="card-body">
                    <form action="{{route('user.update', $data->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$data->name}}">
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$data->email}}">

                            @error('email')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>Phone</label>
                            <input type="number" class="form-control" id="phone" name="phone" value="{{$data->phone}}">

                            @error('phone')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>Adress</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{$data->address}}">
                            @error('address')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
