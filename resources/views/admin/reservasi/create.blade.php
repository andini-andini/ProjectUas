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
            <a href="{{route('reservasi.index')}}" class="btn btn-sm- btn-outline-secondary">Kembali</a>
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
                    Tambah Reservasi
                </div>
                <div class="card-body">
                    <form action="{{route('reservasi.store')}}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-check-label" for="user_id">User</label>
                            <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                                <option selected hidden disabled>-- Pilih User --</option>
                                @foreach ($user as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <small class="text-danger">{{$message}}</small>
                            @enderror

                        </div>
                        <div class="form-group mb-3">
                            <label class="form-check-label" for="kamar_id">Kamar</label>
                            <select class="form-control @error('kamar_id') is-invalid @enderror" id="kamar_id" name="kamar_id">
                                <option selected hidden disabled>-- Pilih Kamar --</option>
                                @foreach ($kamar as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                                @endforeach
                            </select>
                            @error('kamar_id')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>Check In</label>
                            <input type="date" class="form-control @error('check_in') is-invalid @enderror" id="check_in" name="check_in" value="{{ old('check_in')}}" placeholder="Enter check_in">
                            @error('check_in')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>Check Out</label>
                            <input type="date" class="form-control @error('check_out') is-invalid @enderror" id="check_out" name="check_out" value="{{ old('check_out')}}" placeholder="Enter check_in">
                            @error('check_out')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>Guest</label>
                            <input type="number" min="1" class="form-control @error('guest') is-invalid @enderror" id="guest" name="guest" value="{{ old('guest')}}" placeholder="Enter guest">
                            @error('guest')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Enter description"></textarea>

                            @error('price')
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
