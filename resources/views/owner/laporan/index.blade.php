@extends('owner/layout.master')

@section('title','Laporan')
@section('title2','index')

@section('konten')

<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-primary">
        <i class="fas fa-box"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Order</h4>
        </div>
        <div class="card-body">
          {{$totalorder}}
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-danger">
        <i class="fas fa-envelope"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Proses</h4>
        </div>
        <div class="card-body">
          {{$totalorder_pending}}
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-warning">
        <i class="fas fa-box-open"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Selesai</h4>
        </div>
        <div class="card-body">
          {{$totalorder_selesai}}
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-success">
        <i class="fas fa-users"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Karyawan Aktif</h4>
        </div>
        <div class="card-body">
          {{$totalkaryawan}}
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12 col-md-12 col-12 col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4>Statistik Pendapatan</h4>
        <div class="card-header-action">
          <div class="btn">
              <a href="{{route('owner.week')}}" class="btn btn-primary">Last Week</a>
              <!-- <a href="{{route('owner.week')}}" class="btn">Last Month</a>
              <a href="{{route('owner.week')}}" class="btn">Last Year</a> -->
          </div>
        </div>
      </div>
      <div class="card-body">
        <canvas id="myChart" height="182"></canvas>
        <div class="statistic-details mt-sm-4">
          <div class="statistic-details-item">
            <span class="text-muted">@if($total_pendapatan_hariini >= $total_pendapatan_satuharilalu) <span class="text-primary"><i class="fas fa-caret-up"></i>@else <span class="text-danger"> <i class="fas fa-caret-down"></i>@endif</span> {{number_format((float)$persentase_hari, 2, '.', '') }}%</span>
            <div class="detail-value">Rp. {{$total_pendapatan_hariini}}</div>
            <div class="detail-name">Penjualan Hari ini</div>
          </div>
          <div class="statistic-details-item">
            <span class="text-muted">@if($total_pendapatan_mingguini >= $total_pendapatan_satuminggulalu) <span class="text-primary"><i class="fas fa-caret-up"></i>@else <span class="text-danger"> <i class="fas fa-caret-down"></i>@endif</span> {{number_format((float)$persentase_minggu, 2, '.', '') }}%</span>
            <div class="detail-value">Rp. {{$total_pendapatan_mingguini}}</div>
            <div class="detail-name">Penjualan Minggu ini</div>
          </div>
          <div class="statistic-details-item">
            <span class="text-muted">@if($total_pendapatan_bulanini >= $total_pendapatan_satubulanlalu) <span class="text-primary"><i class="fas fa-caret-up"></i>@else <span class="text-danger"> <i class="fas fa-caret-down"></i>@endif</span>{{number_format((float)$persentase_bulan, 2, '.', '') }}%</span>
            <div class="detail-value">Rp. {{$total_pendapatan_bulanini}}</div>
            <div class="detail-name">Penjualan Bulan ini</div>
          </div>
          <div class="statistic-details-item">
            <span class="text-muted">@if($total_pendapatan_tahunini >= $total_pendapatan_satutahunlalu) <span class="text-primary"><i class="fas fa-caret-up"></i>@else <span class="text-danger"> <i class="fas fa-caret-down"></i>@endif</span> {{number_format((float)$persentase_tahun, 2, '.', '') }}%</span>
            <div class="detail-value">Rp. {{$total_pendapatan_tahunini}}</div>
            <div class="detail-name">Penjualan Tahun ini</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-12 col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4>Tabel Laporan</h4>
        <div class="card-header-action">
        @if(Request::is('owner/laporan'))
          <div class="btn btn-group">
              <a href="{{route('ownerlaporan.week')}}" class="btn btn-primary">Last Week</a>
              <a href="{{route('ownerlaporan.month')}}" class="btn">Last Month</a>
              <a href="{{route('ownerlaporan.year')}}" class="btn">Last Year</a>
          </div>
        @elseif(Request::is('owner/laporan/lastweek'))
          <div class="btn btn-group">
              <a href="{{route('ownerlaporan.week')}}" class="btn btn-primary">Last Week</a>
              <a href="{{route('ownerlaporan.month')}}" class="btn">Last Month</a>
              <a href="{{route('ownerlaporan.year')}}" class="btn">Last Year</a>
          </div>
        @elseif(Request::is('owner/laporan/lastmonth'))
          <div class="btn btn-group">
              <a href="{{route('ownerlaporan.week')}}" class="btn ">Last Week</a>
              <a href="{{route('ownerlaporan.month')}}" class="btn btn-primary">Last Month</a>
              <a href="{{route('ownerlaporan.year')}}" class="btn">Last Year</a>
          </div>
        @elseif(Request::is('owner/laporan/lastyear'))
          <div class="btn btn-group">
              <a href="{{route('ownerlaporan.week')}}" class="btn ">Last Week</a>
              <a href="{{route('ownerlaporan.month')}}" class="btn ">Last Month</a>
              <a href="{{route('ownerlaporan.year')}}" class="btn btn-primary">Last Year</a>
          </div>
        @endif
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
            @if(Request::is('owner/laporan'))
              @foreach($data_laporan_minggu as $row)
              <tr>
                <th scope="row">{{$no++}}</th>
                <td>{{$row->tanggal}}</td>
                <td>{{$row->jumlah_transaksi}}</td>
                <td>{{$row->jumlah_penghasilan}}</td>
                <td>{{$row->jumlah_produkterjual}}</td>
              </tr>
              @endforeach
            @elseif(Request::is('owner/laporan/lastweek'))
              @foreach($data_laporan_minggu as $row)
              <tr>
                <th scope="row">{{$no++}}</th>
                <td>{{$row->tanggal}}</td>
                <td>{{$row->jumlah_transaksi}}</td>
                <td>{{$row->jumlah_penghasilan}}</td>
                <td>{{$row->jumlah_produk_terjual}}</td>
              </tr>
              @endforeach
            @elseif(Request::is('owner/laporan/lastmonth'))
              @foreach($data_laporan_bulan as $row)
              <tr>
                <th scope="row">{{$no++}}</th>
                <td>{{$row->tanggal}}</td>
                <td>{{$row->jumlah_transaksi}}</td>
                <td>{{$row->jumlah_penghasilan}}</td>
                <td>{{$row->jumlah_produk_terjual}}</td>
              </tr>
              @endforeach
            @elseif(Request::is('owner/laporan/lastyear'))
              @foreach($data_laporan_bulan as $row)
              <tr>
                <th scope="row">{{$no++}}</th>
                <td>{{$row->tanggal}}</td>
                <td>{{$row->jumlah_transaksi}}</td>
                <td>{{$row->jumlah_penghasilan}}</td>
                <td>{{$row->jumlah_produk_terjual}}</td>
              </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
      <div class="card-footer">
        <div class="d-flex justify-content-center">
            @if(Request::is('owner/laporan'))
              <a href="{{route('ownerlaporan.week.export')}}" class="btn btn-success" target="_blank"> EXPORT CSV </a>
            @elseif(Request::is('owner/laporan/lastweek'))
              <a href="{{route('ownerlaporan.week.export')}}" class="btn btn-success" target="_blank"> EXPORT CSV </a>
            @elseif(Request::is('owner/laporan/lastmonth'))
              <a href="{{route('ownerlaporan.month.export')}}" class="btn btn-success" target="_blank"> EXPORT CSV </a>
            @elseif(Request::is('owner/laporan/lastyear'))
              <a href="{{route('ownerlaporan.year.export')}}" class="btn btn-success" target="_blank"> EXPORT CSV </a>
            @endif
          
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

@push('after-scripts')

<script>

"use strict";

var statistics_chart = document.getElementById("myChart").getContext('2d');
var datachrt = <?php echo json_encode($datachrt); ?>;
var myChart = new Chart(statistics_chart, {
  type: 'line',
  data: {
    labels: ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"],
    datasets: [{
      label: 'Statistics',
      data: datachrt,
      borderWidth: 5,
      borderColor: '#6777ef',
      backgroundColor: 'transparent',
      pointBackgroundColor: '#fff',
      pointBorderColor: '#6777ef',
      pointRadius: 4
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        gridLines: {
          display: false,
          drawBorder: false,
        },
        ticks: {
          stepSize: 100000
        }
      }],
      xAxes: [{
        gridLines: {
          color: '#fbfbfb',
          lineWidth: 2
        }
      }]
    },
  }
});

$('#visitorMap').vectorMap(
{
  map: 'world_en',
  backgroundColor: '#ffffff',
  borderColor: '#f2f2f2',
  borderOpacity: .8,
  borderWidth: 1,
  hoverColor: '#000',
  hoverOpacity: .8,
  color: '#ddd',
  normalizeFunction: 'linear',
  selectedRegions: false,
  showTooltip: true,
  pins: {
    id: '<div class="jqvmap-circle"></div>',
    my: '<div class="jqvmap-circle"></div>',
    th: '<div class="jqvmap-circle"></div>',
    sy: '<div class="jqvmap-circle"></div>',
    eg: '<div class="jqvmap-circle"></div>',
    ae: '<div class="jqvmap-circle"></div>',
    nz: '<div class="jqvmap-circle"></div>',
    tl: '<div class="jqvmap-circle"></div>',
    ng: '<div class="jqvmap-circle"></div>',
    si: '<div class="jqvmap-circle"></div>',
    pa: '<div class="jqvmap-circle"></div>',
    au: '<div class="jqvmap-circle"></div>',
    ca: '<div class="jqvmap-circle"></div>',
    tr: '<div class="jqvmap-circle"></div>',
  },
});

// weather
getWeather();
setInterval(getWeather, 600000);

function getWeather() {
  $.simpleWeather({
  location: 'Bogor, Indonesia',
  unit: 'c',
  success: function(weather) {
    var html = '';
    html += '<div class="weather">';
    html += '<div class="weather-icon text-primary"><span class="wi wi-yahoo-' + weather.code + '"></span></div>';
    html += '<div class="weather-desc">';
    html += '<h4>' + weather.temp + '&deg;' + weather.units.temp + '</h4>';
    html += '<div class="weather-text">' + weather.currently + '</div>';
    html += '<ul><li>' + weather.city + ', ' + weather.region + '</li>';
    html += '<li> <i class="wi wi-strong-wind"></i> ' + weather.wind.speed+' '+weather.units.speed + '</li></ul>';
    html += '</div>';
    html += '</div>';

    $("#myWeather").html(html);
  },
  error: function(error) {
    $("#myWeather").html('<div class="alert alert-danger">'+error+'</div>');
  }
  });
}
</script>

@endpush