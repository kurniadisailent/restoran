@extends('waiter.layout.master')

@section('title','Keranjang')
@section('title2','index')

@section('konten')

<div class="section-body mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

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

                    @if(session('stok'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        {{ session('stok')}}.
                    </div>
                    @endif
                    <link rel="stylesheet" href="{{asset('assets/css/inpuandtable.css')}}">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col" class="text-center">Nama Menu</th>
                                    <th scope="col" class="text-center">Harga</th>
                                    <th scope="col" class="text-center">Jumlah Pesan</th>
                                    <th scope="col" class="text-center">Diskon</th>
                                    <th scope="col" class="text-center">Total</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                @foreach($data as $row)
                                <tr>
                                    <th scope="row">{{$no++}}</th>
                                    <?php $gambar = App\Menu::select('file_gambar_menu')->where('id_menu', '=', $row->id_menu)->pluck('file_gambar_menu')->first(); ?>
                                    <?php $deskripsi = App\Menu::select('deskripsi')->where('id_menu', '=', $row->id_menu)->pluck('deskripsi')->first(); ?>
                                    <?php $stok = App\Menu::select('stok')->where('id_menu', '=', $row->id_menu)->pluck('stok')->first(); ?>
                                    <td><img src="{{asset('assets/menus/'.$gambar)}}" width="100px" class="img-fluid img-thumbnail mt-2 mb-2" alt="Sheep"></td>
                                    <td class="text-center">{{$row->nama_menu}}</td>
                                    <td class="text-center">{{$row->harga_menu}}</td>
                                    <td class="text-center">{{$row->jumlah_pesan}}</td>
                                    <td class="text-center">{{$row->diskon}}%</td>
                                    <td class="text-center">{{$row->total_bayar}}</td>
                                    <td>
                                        <button class="btn btn btn-success mr-1" data-toggle="modal" data-target="#edit-{{ $row->id_menu }}"><i class="fas fa-edit"></i></button>
                                        <!-- <button class="btn btn btn-warning mr-1" data-toggle="modal" data-target="#kurangi-{{ $row->id_menu }}"><i class="fas fa-minus"></i></button> -->
                                        </form>
                                        <a href="#" class="btn btn-danger confirm_script-{{$row->id_detail_order}} mr-3">
                                            <form action="{{ route('waiterorder.destroy',['id_detail_order'=>$row->id_detail_order,'kode_order'=>$row->kode_order,'id_petugas'=>\Auth::guard('waiter')->user()->id_waiter ])}}" class="delete-{{$row->id_detail_order}}" method="POST">
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
                                    $(".confirm_script-{{$row->id_detail_order}}").click(function(e) {
                                        // id = e.target.dataset.id;
                                        swal({
                                                title: 'Yakin Batalkan Order {{$row->nama_menu}}?',
                                                text: '{{$row->nama_menu}} akan di hapus dari keranjang',
                                                icon: 'warning',
                                                buttons: true,
                                                dangerMode: true,
                                            })
                                            .then((willDelete) => {
                                                if (willDelete) {
                                                    $('.delete-{{$row->id_detail_order}}').submit();
                                                } else {
                                                    swal('Hapus {{$row->nama_menu}} Dari keranjang telah di batalkan');
                                                }
                                            });
                                    });
                                </script>
                                @endpush
                                @push('modal')
                                <div class="modal fade" id="edit-{{ $row->id_menu }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{$row->nama_menu}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="">
                                                    <form action="{{route('waiterorder.ubah')}}" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <img src="{{asset('assets/menus/'.$gambar)}}" class="card-img-top" style="">
                                                            </div>
                                                            <div class="col-md-7">
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="form-label">Deskripsi :</label>
                                                                    <textarea class="form-control" style="height:100%;" rows="5" id="message-text" readonly>{{$deskripsi}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-center">
                                                            <div class="col-md-9">
                                                                <div class="form-group text-center">
                                                                    <label for="exampleFormControlInput1" class="text-center">Ubah Jumlah Pesan</label>
                                                                    <input type="number" onchange="" name="jumlah_pesan" class="form-control" id="jumlah_pesan" value="{{$row->jumlah_pesan}}" placeholder="" min="1" max="{{$stok}}" required>
                                                                </div>
                                                                <!-- @if($row->diskon > 0)
                                                                <div class="text-center">
                                                                    <h6><span class="text-danger" id="harga_normal"><s>Rp.{{$row->harga}}</s></span></h6>
                                                                    <?php $diskon = $row->diskon;
                                                                    $tahap1 = $diskon / 100 * $row->harga;
                                                                    $harga_diskon = $row->harga - $tahap1; ?>
                                                                    <span class="">Diskon {{$row->diskon}}%</span>
                                                                    <h4><span class="text-danger" id="harga_diskon">Rp.{{$harga_diskon}}</span></h4>
                                                                    <button class="btn btn-danger btn-block col-lg-12 mt-5 mr-1 text-center" data-toggle="modal" data-target="#ordermenu-{{ $row->id_menu }}">Order</button>
                                                                    <input type="hidden" hidden name="jumlah_bayar" value="{{$harga_diskon}}">
                                                                    <input type="hidden" id="harga" hidden name="harga" value="{{$row->harga}}">
                                                                    <input type="hidden" id="diskon" hidden name="diskon" value="{{$row->diskon}}">
                                                                    <input type="hidden" id="id_menu" hidden name="id_menu" value="{{$row->id_menu}}">
                                                                </div>
                                                            @else
                                                                <div class="text-center mt-4">
                                                                    <h5><span class="text-danger" id="harga_norm">Rp.{{$row->harga}}</span></h5>
                                                                    <button class="btn btn-danger btn-block col-lg-12 mt-5 mr-1 text-center" data-toggle="modal" data-target="#ordermenu-{{ $row->id_menu }}">Order</button>
                                                                </div>
                                                            @endif  -->
                                                                <input type="hidden" onchange="" name="id_petugas" class="form-control" value="{{ \Auth::guard('waiter')->user()->id_waiter }}" hidden>
                                                                <!-- <input type="hidden" onchange="" name="level_petugas" class="form-control" value="waiter" hidden> -->
                                                                <input type="hidden" onchange="" name="id_menu" class="form-control" value="{{$row->id_menu}}" hidden>
                                                                <!-- <input type="hidden" onchange="" name="nama_menu" class="form-control" value="{{$row->nama_menu}}" hidden> -->
                                                                <!-- <input type="hidden" onchange="" name="harga_menu" class="form-control" value="{{$row->harga}}" hidden> -->
                                                                <!-- <input type="hidden" onchange="" name="diskon" class="form-control" value="{{$row->diskon}}" hidden> -->

                                                                <div class="row d-flex justify-content-center">
                                                                    <button type="button" class="btn btn-secondary col-md-4 text-center mr-2" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-primary col-md-4 text-center" data-toggle="modal">Ubah</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary">Order</button>
                                            -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endpush
                                @push('js')
                                <script>
                                    $(function() {
                                        $('.tombol-edit').click(function() {
                                            var url = $(this).attr('data-url');
                                            $("#edit-{{ $row->id_menu }} form").attr('action', url);
                                            $('#edit-{{ $row->id_menu }}').modal('show');
                                        });
                                    });
                                    // function hitung_jumlah_bayar(){
                                    //     var harga = document.getElementById("harga").value;
                                    //     var diskon = document.getElementById("diskon").value;
                                    //     var jumlah_pesan = document.getElementById("jumlah_pesan").value;
                                    //     var total_harga = harga * jumlah_pesan;
                                    //     var tahap1 = diskon / 100 * harga;
                                    //     var tahap2 = harga - tahap1;
                                    //     var total_diskon = tahap2 * jumlah_pesan;
                                    //     if (diskon <= 0)
                                    //     {
                                    //         document.getElementById('harga_norm').innerHTML = total_harga;
                                    //     }else
                                    //     {
                                    //         document.getElementById('harga_normal').innerHTML = total_harga;
                                    //         document.getElementById('harga_diskon').innerHTML = total_diskon;
                                    //     }
                                    // }
                                </script>
                                @endpush
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <form action="{{route('waiterorder.prosses')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 float-right">
                                <div class="input-group float-right mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Nomor Meja</span>
                                    </div>
                                    <select id="nomeja" name="no_meja" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                        <?php $nomeja = App\Meja::select('no_meja')->where('status', 'KOSONG')->orderBy('no_meja', 'ASC')->get(); ?>
                                        <option value=""></option>
                                        @foreach($nomeja as $nomor)
                                        <option value="{{$nomor->no_meja}}">{{$nomor->no_meja}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-3 float-right">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Total Bayar</span>
                                    </div>
                                    <input type="text" id="" name="jumlah_bayar" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly value="{{$jumlah_bayar}}">
                                </div>
                            </div>
                            <div class="col-md-3 float-right mt-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Atas Nama
                                            <pre> </pre>

                                        </span>
                                    </div>
                                    <input type="text" id="totalbayar" name="nama_pelanggan" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                </div>
                            </div>
                            <!-- hidden input -->
                            <input type="hidden" hidden id="id_petugas" name="id_petugas" class="form-control" value="{{\Auth::guard('waiter')->user()->id_waiter}}">
                            <input type="hidden" hidden id="level_petugas" name="level_petugas" class="form-control" value="waiter">
                        </div>
                        <div class="mt-3 ">
                            <div class="float-md-left mb-2 d-flex justify-content-center">
                                <a href="{{route('waiterorder.index')}}" class="btn btn-success text-white col-xs-7">Kembali ke Menu</a>
                            </div>
                            <div class="float-md-right d-flex justify-content-center">
                                <a href="#" data-id="{{ route('waiterorder.reset',['id_petugas'=>\Auth::guard('waiter')->user()->id_waiter])}}" class="btn btn-danger confirm_script mb-2 ">
                                Reset Keranjang &nbsp;
                                </a>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="">Prosses Sekarang</button>
                            </div>
                        </div>
                    </form>
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
                title: 'Yakin Kosongkan keranjang',
                text: 'Keranjang yang di kosongkan tidak bisa di kembalikan',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "{{ route('waiterorder.reset',['id_petugas'=>\Auth::guard('waiter')->user()->id_waiter])}}"
                } else {
                    swal('Hapus data telah di batalkan');
                }
            });
    });
</script>
@endpush