@extends('kasir.layout.master')

@section('title','Entri Transaksi')

@section('konten')

<div class="section-body">
  <div class="row">
    <div class="col-md-12">
      <div class="card mt-3">

          <div class="card-body">
            <div class="col-md-12">
              <div class="float-right">
                <form action="{{route('kasirkasirentritransaksi.cari')}}" method="GET">
                  <div class="input-group mb-3">
                    <input name="keyword" id="caribuku" type="text" class="form-control" placeholder="Cari..." aria-label="Cari" aria-describedby="button-addon2" value="{{ Request()->keyword }}">
                    <div class="input-group-append">
                      <button id="btncaribuku" class="btn btn-outline-secondary bg-primary" type="submit" id="button-addon2"><i class="fas fa-search text-light"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          
            
              @if (session('store'))
              <div class="alert alert-success alert-dismissible fade show">
                  <button type="button" class="close" data-dismiss="alert">
                      <span>&times;</span>
                  </button>
                  <strong>Success!</strong> {{ session('destroy') }}.
              </div>  
              @endif

              @if (session('update'))
              <div class="alert alert-success alert-dismissible fade show">
                  <button type="button" class="close" data-dismiss="alert">
                      <span>&times;</span>
                  </button>
              <strong>Success!</strong> {{ session('destroy') }}.
              </div>  
              @endif

              @if(session('destroy'))
              <div class="alert alert-success alert-dismissible fade show">
                  <button type="button" class="close" data-dismiss="alert">
                      <span>&times;</span>
                  </button>
                  <strong>Succes!</strong>Data Berhasil di hapus
              </div>
              @endif
              <ul class="nav nav-tabs mb-3">
	              <li class="nav-item">
                  <a class="nav-link {{ Request::is('kasir/entritransaksi') ? 'active':'' }}" href="{{route('kasirentritransaksi.index')}}"> Semua </a>
	              </li>
	              <li class="nav-item">
                <a class="nav-link {{ Request::is('kasir/entritransaksi/status/selesai') ? 'active':'' }}" href="{{route('kasirkasirentritransaksi.status.selesai')}}"> Selesai </a>
	              </li>
	              <li class="nav-item">
                  <a class="nav-link {{ Request::is('kasir/entritransaksi/status/belumbayar') ? 'active':'' }}" href="{{route('kasirkasirentritransaksi.status.belumbayar')}}"> Belum Bayar </a>
	              </li>
              </ul>
              <table class="table">
                  <thead>
                      <tr>
                          <th scope="col">No</th>
                          <th scope="col">Kode Order</th>
                          <th>Nama Pelanggan</th>
                          <th>Tanggal</th>
                          <th>Total Bayar</th>
                          <th>Status</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody class="mt-2">
                  <?php $no = 1 ?>
                    @foreach($data as $row)
                      <tr>
                          <th scope="row">{{$no++}}</th>
                          <td>{{$row->kode_order}}</td>
                          <td>{{$row->nama_pelanggan}}</td>
                          <td>{{$row->tanggal}}</td>
                          <td>{{$row->total_bayar}}</td>
                          @if ($row->status == 'SELESAI')
                            <td class="text-success">SELESAI</td>
                          @else
                            <td class="text-warning">BELUM BAYAR</td>
                          @endif
                          <td>
                            @if($row->status == 'SELESAI')
                              <a href="{{route('kasirentritransaksi.view',['kodeorder'=>$row->kode_order])}}" target='_blank' class="btn btn-primary mr-3"><i class="fas fa-eye"></i></a>
                            @else
                            <form action="{{route('kasirtransaksi.carikode')}}" method="POST">
                              @csrf
                              <div class="input-group">
                                <input name="kode_order" id="caripesanan" hidden type="text" class="form-control" placeholder="Cari..." aria-label="Cari" aria-describedby="button-addon2" value="{{ $row->kode_order}}">
                                <button id="btncaripesanan" class="btn bg-success shadow" type="submit" id="button-addon2"><i class="fas fa-comments-dollar text-white"></i></button>
                              </div>
                            </form>
                            @endif 
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
              <div class="d-flex justify-content-center">
                {{ $data->links() }}
              </div> 
          </div>
      </div>
    </div>
  </div>    
</div>
@endsection

@push('page-scripts')

<script src="{{ asset('node_modules/sweetalert/dist/sweetalert.min.js')}}"></script>

@endpush

@push('after-scripts')

<script>
$(".confirm_script").click(function(e) {
  // id = e.target.dataset.id;
  swal({
      title: 'Yakin hapus data?',
      text: 'Data yang dihapus tidak bisa di kembalikan',
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $('.delete_form').submit();
      } else {
      swal('Hapus data telah di batalkan');
      }
    });
});
</script>
@endpush