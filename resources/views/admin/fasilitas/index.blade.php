@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins') }}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('plugins') }}/datatables-responsive/css/responsive.bootstrap4.min.css">
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
    @if (Session::has('success'))
    <div class="row">
        <div class="col">
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        </div>
    </div>
    @endif
    @if (Session::has('error'))
    <div class="row">
        <div class="col">
            <div class="alert alert-danger">
                {{Session::get('error')}}
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header">Tambah Fasilitas</div>
                <div class="card-body">
                    <form action="{{route('fasilitas.store')}}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name')}}" placeholder="Enter name">

                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    Data Fasilitas
                </div>
                <div class="card-body">
                    <table id="table-fasilitas" class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteFasilitasModal" tabindex="-1" aria-labelledby="deleteFasilitasModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteFasilitasModalLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah kamu yakin akan menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary m-1" data-bs-dismiss="modal">Close</button>
                <form id="form-delete-fasilitas" class="m-1">
                    @csrf
                    <button type="submit" class="btn btn-danger m-1">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('plugins') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('plugins') }}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('plugins') }}/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('plugins') }}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('js/fasilitas.js')}}"></script>

@endsection
