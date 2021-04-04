@extends('admin/layout.master')

@section('title','Laporan')
@section('title2','index')

@section('konten')


<div class="row">
  <div class="col-lg-12 col-md-12 col-12 col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4>Tabel Laporan</h4>
        <div class="card-header-action">
          <div class="btn btn-group">
            <a href="{{route('adminlaporan.month')}}" class="btn btn-primary">Last Month</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Tanggal</th>
              <th>Jumlah Transaksi</th>
              <th>Jumlah Penghasilan</th>
              <th>Jumlah Produk Terjual</th>
            </tr>
          </thead>
          <tbody class="mt-2">
            <?php $no = 1 ?>
            @foreach($data_laporan_bulan as $row)
            <tr>
              <th scope="row">{{$no++}}</th>
              <td>{{$row->tanggal}}</td>
              <td>{{$row->jumlah_transaksi}}</td>
              <td>{{$row->jumlah_penghasilan}}</td>
              <td>{{$row->jumlah_produk_terjual}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer">
        <div class="d-flex justify-content-center">
          <a href="{{route('adminlaporan.month.export')}}" class="btn btn-success" target="_blank"> EXPORT CSV </a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('page-scripts')

<script src="{{ asset('node_modules/simpleweather/jquery.simpleWeather.min.js')}}"></script>
<script src="{{ asset('node_modules/chart.js/dist/Chart.min.js')}}"></script>
<script src="{{ asset('node_modules/jqvmap/dist/jquery.vmap.min.js')}}"></script>
<script src="{{ asset('node_modules/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
<script src="{{ asset('node_modules/summernote/dist/summernote-bs4.js')}}"></script>
<script src="{{ asset('node_modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>

@endpush