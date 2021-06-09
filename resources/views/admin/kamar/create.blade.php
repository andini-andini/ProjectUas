@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" />
@endsection


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
                    Tambah kamar
                </div>
                <div class="card-body">
                    <form action="{{route('kamar.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name')}}" placeholder="Enter name">

                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>Price</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price')}}" placeholder="Enter price">

                            @error('price')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-check-label" for="fasilitas">Fasilitas</label>
                            <select class="form-control mul-select @error('fasilitas') is-invalid @enderror" id="fasilitas" name="fasilitas[]" multiple="true">

                                @foreach ($fasilitas as $fas)
                                <option value="{{ $fas->id }}">{{ $fas->name }}</option>
                                @endforeach
                            </select>
                            @error('fasilitas')
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
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" accept="image/*">
                            @error('image')
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

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
{{-- <script src="{{ asset('js/kamar.js') }}"></script> --}}
<script>
    $("#fasilitas").select2({
        placeholder: "Pilih fasilitas"
        , tags: true
        , allowClear: true
        , theme: "bootstrap"
        , tokenSeparators: ["/", ",", ";", " "]
        , createTag: function() {
            return null;
        }
    , });

</script>
@endsection
