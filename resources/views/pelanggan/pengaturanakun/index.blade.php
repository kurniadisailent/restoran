@extends('pelanggan.layout.master')
@section('title','Pengaturan Akun')
@section('konten')
<div class="section-body mt-5 mb-5">
    <div class="container">
        @if (session('sukses'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            <strong>Success!</strong> {{ session('sukses') }}.
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h5 class="text-danger">Pengaturan Akun</h5>
            </div>
            <div class="card-body">
                <form action="{{route('pelanggan.pengaturan.submit')}}" method="post" class="d-flex justify-content-center">
                    @csrf
                    <div class="form-group col-md-6">
                        <label for="nama_pelanggan">Nama Pelanggan</label>
                        <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control mb-4" value="{{$nama_pelanggan}}" required>

                        <label for="nama_pelanggan">Email</label>
                        <input type="text" id="nama_pelanggan" name="email" class="form-control mb-4" value="{{$email}}" required>

                        <label for="nama_pelanggan">Username</label>
                        <input type="text" id="nama_pelanggan" name="username" class="form-control mb-4" value="{{$username}}" required>

                        <label for="nama_pelanggan">Password</label>
                        <input type="text" id="nama_pelanggan" name="password" class="form-control mb-4">
                        <div class="col d-flex justify-content-center">
                            <button type="submit" class="btn btn-secondary mr-2"> Batal</button>
                            <button type="submit" class="btn btn-danger"> Simpan</button>
                        </div>
                        <div class="d-flex justify-content-center">
                            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->color(38, 38, 38, 0.85)->backgroundColor(255, 255, 255, 0.82)->size(200)->generate($qrpassword)) !!} ">
                        </div>

                        <div class="col d-flex justify-content-center">
                            <a href="{{route('pelanggan.pengaturan.download')}}" target="_blank" class="btn btn-danger mr-2"> Download QR Code</button>
                            <a class="btn btn-danger text-white" href="{{route('pelanggan.pengaturan.generate')}}"> <i class="fas fa-sync"></i> Ubah Code</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection