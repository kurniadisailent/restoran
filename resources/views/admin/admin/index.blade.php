@extends('admin/layout.master')

@section('title','Admin')
@section('title2','index')

@section('konten')

<div class="section-body">
  <div class="row">
    <div class="col-md-12">
      <div class="card mt-3">

          <div class="card-body">
          <div class="col-md-12">
              <a href="{{route('adminaccount.create')}}" class="btn btn-icon icon-left btn-primary mb-3 px-3"><i class="fas fa-plus"></i> Tambah</a>
              <div class="float-right">
              <form action="?" method="GET">
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

              <table class="table">
                  <thead>
                      <tr>
                          <th scope="col">No</th>
                          <th scope="col">Nama Admin</th>
                          <th>Username</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody class="mt-2">
                  <?php $no = 1 ?>
                    @foreach($data as $row)
                      <tr>
                          <th scope="row">{{$no++}}</th>
                          <td>{{$row->nama_admin}}</td>
                          <td>{{$row->username}}</td>
                          <td>
                            <a href="{{route('adminaccount.edit',['adminaccount'=>$row->id_admin])}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                            <a href="#" data-id="" class="btn btn-danger confirm_script-{{$row->id_admin}} mr-3">
                              <form action="{{ route('adminaccount.destroy',['adminaccount'=>$row->id_admin])}}" class="delete_form-{{$row->id_admin}}" method="POST">
                                @method('DELETE')
                                @csrf
                              </form>
                              <i class="fas fa-trash"></i>
                            </a>
                          </td>
                      </tr>

                      @push('page-scripts')

                      <script src="{{ asset('node_modules/sweetalert/dist/sweetalert.min.js')}}"></script>

                      @endpush

                      @push('after-scripts')

                      <script>
                      $(".confirm_script-{{$row->id_admin}}").click(function(e) {
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
                              $('.delete_form-{{$row->id_admin}}').submit();
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