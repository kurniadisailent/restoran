@extends('admin/layout.master')

@section('title','Menu')
@section('title2','index')

@section('konten')

<div class="section-body">
  <div class="row">
    <div class="col-md-12">
      <div class="card mt-3">
          <div class="card-body">
            <div class="col-md-12">
              <a href="{{route('menu.create')}}" class="btn btn-icon icon-left btn-primary mb-3 px-3"><i class="fas fa-plus"></i> Tambah</a>
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
                  <strong>Succes!</strong>{{ session('destroy')}}.
              </div>
              @endif
            
              <table class="table table-responsive">
                  <thead>
                      <tr class="">
                          <th scope="col" style="width:1%" class="text-center">No</th>
                          <th scope="col">Menu</th>
                          <th class="text-center">Aksi</th>
                      </tr>
                  </thead>
                  <tbody class="mt-2">
                  <?php $no = 1 ?>
                    @foreach($data as $row)
                      <tr>
                          <th scope="row" class="text-center">{{$no++}}</th>
                          <td>
                            <img src="{{url('assets/menus/'.$row->file_gambar_menu)}}" width="100" class="img-thumbnail mr-3 mt-4" align="left">
                            <br>
                            <a href="#" class="font-weight-normal">
                                <b>{{$row->nama_menu}}</b>
                            </a><br>
                            <span>  <b>Harga     :</b> {{$row->harga}}</span><br>
                            <span>  <b>Kategori  :</b> {{$row->nama_kategori}}</span><br>
                            <span>  <b>Stok  :</b> {{$row->stok}}</span><br>
                            <span>  
                            @if($row->status == 'Tersedia') <b>Status :</b> <span class="text-success">Tersedia</span>
                            @elseif($row->status == 'Habis') <b>Status :</b> <span class="text-warning">Habis</span>
                            @endif
                            </span><br>
                          </td>
                          <td>
                            <div class="d-flex justify-content-center p-0">
                            <a href="{{route('menu.edit',['menu'=>$row->id_menu])}}" class="btn btn-primary mr-1"><i class="fas fa-edit"></i></a>
                            <a href="#" data-id="" class="btn btn-danger confirm_script-{{$row->id_menu}} mr-3">
                              <form action="{{ route('menu.destroy',['menu'=>$row->id_menu])}}" class="delete-{{$row->id_menu}}" method="POST">
                                @method('DELETE')
                                @csrf
                              </form>
                              <i class="fas fa-trash"></i>
                            </a>
                            </div>
                          </td>
                      </tr>
                      @push('page-scripts')

                      <script src="{{ asset('node_modules/sweetalert/dist/sweetalert.min.js')}}"></script>

                      @endpush

                      @push('after-scripts')

                      <script>
                      $(".confirm_script-{{$row->id_menu}}").click(function(e) {
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
                              $('.delete-{{$row->id_menu}}').submit();
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
