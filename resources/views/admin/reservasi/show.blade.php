@if (Auth::user()->role == "usr")
<div class="row">
    <div class="col-12">
        @if ($data->status == 0)
        <div class="alert alert-warning text-center">
            Silahkan lakukan pembayaran ke : <br>
            No. Rekening 123456789 (ABC)
            A.N Customer Service <br>
            dan Konfirmasi pembayaran via WA (+6285123xxxxx)
        </div>
        @else
        <div class="alert alert-success text-center">
            Pemesanan Sudah Diverifikasi. <br> Silahkan Kunjungi Hotel Kami dengan memberikan bukti screenshot halaman ini.
        </div>
        @endif
    </div>
</div>
@endif

<ul class="list-group">
    <li class="list-group-item">
        <div class="row">
            <div class="col-md-4">Nama Customer</div>
            <div class="col-md-6">{{$data->user->name}}</div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-md-4">Nama Kamar</div>
            <div class="col-md-6">{{$data->kamar->name}}</div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-md-4">Fasilitas</div>
            <div class="col-md-6">
                @foreach ($data->kamar->fasilitas as $item)
                <button class="btn btn-sm btn-outline-dark">{{$item->name}}</button>
                @endforeach
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-md-4">Harga Kamar</div>
            <div class="col-md-6">{{ $dataPrice['price']}}</div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-md-4">Check-in</div>
            <div class="col-md-6">{{$data->check_in}}</div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-md-4">Check-out</div>
            <div class="col-md-6">{{$data->check_out}}</div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-md-4">Jumlah Orang</div>
            <div class="col-md-6">{{$data->guest}}</div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-md-4">Total Hari</div>
            <div class="col-md-6">{{ $dataPrice['days']}} hari</div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-md-4">Total Harga</div>
            <div class="col-md-6">{{ $dataPrice['totalPrice'] }}</div>

        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-md-4">Status</div>
            <div class="col-md-6">
                @if ($data->status == 0)
                <button class="btn btn-sam btn-danger">Belum Diverifikasi</button>
                @else
                <button class="btn btn-sam btn-success">Sudah Diverifikasi</button>
                @endif
            </div>
        </div>
    </li>
</ul>
