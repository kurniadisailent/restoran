@extends('admin/layout.master')

@section('title','Entri Order')
@section('title2','index')

@section('konten')

<div class="section-body">
  <div class="row">
    <div class="col-md-12">
      <div class="card mt-3">
        <div class="card-body">
        @if (session('berhasil'))
              <div class="alert alert-success alert-dismissible fade show">
                  <button type="button" class="close" data-dismiss="alert">
                      <span>&times;</span>
                  </button>
                  <strong>Success!</strong> {{ session('berhasil') }}.
              </div>  
        @endif
          <div class="col-md-12">
            <div class="float-right">
              <form action="{{route('adminadminentriorder.cari')}}" method="GET">
                <div class="input-group mb-3">
                  <input name="keyword" id="caribuku" type="text" class="form-control" placeholder="Cari..." aria-label="Cari" aria-describedby="button-addon2" value="{{ Request()->keyword }}">
                  <div class="input-group-append">
                    <button id="btncaribuku" class="btn btn-outline-secondary bg-primary" type="submit" id="button-addon2"><i class="fas fa-search text-light"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
              <ul class="nav nav-tabs mb-3">
	              <li class="nav-item">
		              <a class="nav-link {{ Request::is('admin/entriorder') ? 'active':'' }}" href="{{route('adminentriorder.index')}}"> Semua </a>
	              </li>
	              <li class="nav-item">
		              <a class="nav-link {{ Request::is('admin/entriorder/status/order') ? 'active':'' }}" href="{{route('adminadminentriorder.status.order')}}"> Proses Order </a>
	              </li>
	              <li class="nav-item">
		              <a class="nav-link {{ Request::is('admin/entriorder/status/belumbayar') ? 'active':'' }}" href="{{route('adminadminentriorder.status.belumbayar')}}"> Belum Bayar </a>
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
                          <td>@if($row->nama_pelanggan == null) Dalam Proses Order @else {{$row->nama_pelanggan}} @endif</td>
                          <td>{{$row->tanggal}}</td>
                          <td>@if($row->total_bayar == null) Dalam Proses Order @else {{$row->total_bayar}} @endif</td>
                          @if ($row->status == 'BELUM_BAYAR')
                            <td class="text-warning">BELUM BAYAR</td>
                          @else
                            <td class="text-danger">ORDER</td>
                          @endif
                          <td>
                            @if($row->status == 'BELUM_BAYAR')
                            <div class="row">
                              <a id="btncaripesanan" class="btn btn-success text-white mb-1 mt-1" href="{{route('adminadminentriorder.detail',['kode_order'=>$row->kode_order])}}" id="button-addon2"><i class="fas fa-edit text-white"></i></a>
                            </div>
                            @elseif($row->status == 'ORDER')
                            <div class="row">
                            <a id="btncaripesanan" class="btn btn-success text-white mb-1 mt-1 mr-1" href="{{route('adminadminentriorder.detail',['kode_order'=>$row->kode_order])}}" id="button-addon2"><i class="fas fa-edit text-white"></i></a>
                            <a href="#" class="btn btn-danger text-white mb-1 mt-1 confirm_script-{{$row->kode_order}}">
                              <form action="{{ route('adminadminentriorder.destroy',['kodeorder'=>$row->kode_order])}}" class="delete-{{$row->kode_order}}" method="get">
                                @csrf
                              </form>
                              <i class="fas fa-trash"></i>
                            </a>
                            </div>
                            @endif 
                          </td>
                      </tr>
                      @push('page-scripts')

                      <script src="{{ asset('node_modules/sweetalert/dist/sweetalert.min.js')}}"></script>

                      @endpush

                      @push('after-scripts')

                      <script>
                      $(".confirm_script-{{$row->kode_order}}").click(function(e) {
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
                              $('.delete-{{$row->kode_order}}').submit();
                            } else {
                            swal('Hapus data telah di batalkan');
                            }
                          });
                      });
                      </script>
                      @endpush
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