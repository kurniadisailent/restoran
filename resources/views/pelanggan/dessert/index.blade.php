@extends('pelanggan.layout.master')
@section('title','Dessert')
@section('konten')
<div class="section-body">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="col-md-12">
                        <!-- HEADER -->
                        <div class="d-flext col-12">
                            <h4 class="mb-3 mt-3 px-3 text-center">Daftar Menu Dessert</h4>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="col-md-6">
                                <form action="?" method="GET">
                                    <div class="input-group mb-3 mt-3 ">
                                        <input name="keyword" id="caribuku" type="text" class="form-control" placeholder="Cari..." aria-label="Cari" aria-describedby="button-addon2" value="{{ Request()->keyword }}">
                                        <div class="input-group-append">
                                            <button id="btncaribuku" class="btn btn-outline-secondary bg-danger type=" submit" id="button-addon2"><i class="fas fa-search text-light"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- END HEADER -->
                    <!-- ITEMS-LIST -->
                    <div class="row">
                        <?php $id_mod = 1 ?>
                        @foreach ($data as $row)
                        <!-- ITEM -->
                        <div class="col-md-2">
                            <div class="card mb-6 shadow-sm">
                                <div class="row no-gutters">
                                    <img src="{{asset('assets/menus/'.$row->file_gambar_menu)}}" class="card-img-top mt-3" alt="...">
                                    <div class="card-body">
                                        <p class="card-title text-center"><b>{{$row->nama_menu}}</b></p>
                                        @if($row->diskon > 0)
                                        <div class="text-center">
                                            <h6><span class="text-danger"><s>Rp.{{$row->harga}}</s></span></h6>
                                            <?php $diskon = $row->diskon;
                                            $tahap1 = $diskon / 100 * $row->harga;
                                            $harga_diskon = $row->harga - $tahap1; ?>
                                            <span class="">Diskon {{$row->diskon}}%</span>
                                            <h4><span class="text-danger">Rp.{{$harga_diskon}}</span></h4>
                                            @if($row->status == "Tersedia")
                                            <div class="d-flex justify-content-center">
                                                @if(\Auth::guard('pelanggan')->user())
                                                <button class="btn btn-danger btn-block col-lg-12 mt-2 mr-1 text-center" data-toggle="modal" data-target="#ordermenu-{{ $row->id_menu }}">Order</button>
                                                @else
                                                <button class="btn btn-danger btn-block col-lg-12 mt-2 mr-1 text-center" data-toggle="modal" data-target="#login">Order</button>
                                                @endif
                                            </div>
                                            @else
                                            <div class="d-flex justify-content-center">
                                                <a href="" class="btn btn-warning btn-block col-lg-12 mt-2 mr-1 text-center" onclick="return false;">HABIS</a>
                                            </div>
                                            @endif
                                        </div>
                                        @else
                                        <div class="text-center mt-4">
                                            <h5><span class="text-danger">Rp.{{$row->harga}}</span></h5>
                                            @if($row->status === "Tersedia")
                                            <div class="d-flex justify-content-center">
                                                @if(\Auth::guard('pelanggan')->user())
                                                <button class="btn btn-danger btn-block col-lg-12 mt-5 mr-1 text-center" data-toggle="modal" data-target="#ordermenu-{{ $row->id_menu }}">Order</button>
                                                @else
                                                <button class="btn btn-danger btn-block col-lg-12 mt-5 mr-1 text-center" data-toggle="modal" data-target="#login">Order</button>
                                                @endif
                                            </div>
                                            @else
                                            <div class="d-flex justify-content-center">
                                                <a href="" class="btn btn-warning btn-block col-lg-12 mt-5 mr-1 text-center" onclick="return false;">HABIS</a>
                                            </div>
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END-ITEM -->
                        @if(\Auth::guard('pelanggan')->user())
                        @push('modal')
                        <div class="modal fade" id="ordermenu-{{ $row->id_menu }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <form action="{{route('pelangganorder.order')}}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <img src="{{asset('assets/menus/'.$row->file_gambar_menu)}}" class="card-img-top" style="">
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="form-label">Deskripsi :</label>
                                                            <textarea class="form-control" style="height:100%;" rows="5" id="message-text" readonly>{{$row->deskripsi}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <div class="col-md-9">
                                                        <div class="form-group text-center">
                                                            <label for="exampleFormControlInput1" class="text-center">Jumlah Pesan</label>
                                                            <input type="number" onchange="" name="jumlah_pesan" class="form-control" id="jumlah_pesan" value="1" placeholder="" min="1" max="{{$row->stok}}" required>
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
                                                            @endif -->
                                                        <!-- hidden input -->
                                                        <input type="hidden" onchange="" name="id_pelanggan" class="form-control" value="{{ \Auth::guard('pelanggan')->user()->id_pelanggan }}" hidden>
                                                        <input type="hidden" onchange="" name="level_petugas" class="form-control" value="pelanggan" hidden>
                                                        <input type="hidden" onchange="" name="id_menu" class="form-control" value="{{$row->id_menu}}" hidden>
                                                        <input type="hidden" onchange="" name="nama_menu" class="form-control" value="{{$row->nama_menu}}" hidden>
                                                        <input type="hidden" onchange="" name="harga_menu" class="form-control" value="{{$row->harga}}" hidden>
                                                        <input type="hidden" onchange="" name="diskon" class="form-control" value="{{$row->diskon}}" hidden>
                                                        <input type="hidden" onchange="" name="nama_pelanggan" class="form-control" value="{{ \Auth::guard('pelanggan')->user()->nama_pelanggan }}" hidden>

                                                        <?php $diskon = $row->diskon;
                                                        $tahap1 = $diskon / 100 * $row->harga;
                                                        $harga_diskon = $row->harga - $tahap1; ?>
                                                        <input type="number" onchange="" name="total_bayar" class="form-control" value="{{$harga_diskon}}" hidden>
                                                        <div class="row d-flex justify-content-center">
                                                            <button type="button" class="btn btn-secondary col-md-4 text-center mr-2" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger col-md-4 text-center" data-toggle="modal">Order</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary">Order</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endpush
                        @push('js')
                        <script>
                            $(function() {
                                $('.tombol-hapus').click(function() {
                                    var url = $(this).attr('data-url');
                                    $("#ordermenu-{{ $row->id_menu }} form").attr('action', url);
                                    $('#ordermenu-{{ $row->id_menu }}').modal('show');
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
                        @endif
                        @endforeach
                    </div>
                    <!-- END-ITEMS-LIST -->
                    <div class="d-flex justify-content-center mt-3">
                        <div class="text-danger">{{ $data->links() }}</div>
                    </div>
                </div>
                <!-- Button Keranjang -->

            </div>
        </div>
    </div>
</div>

</div>


@push('modal')
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-danger">Login</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" class="user" action="/pelanggan/login" class="needs-validation" novalidate="">
                    {{ csrf_field() }}
                    <small class="text-danger">*Anda Perlu login menggunakan akun yang telah terdaftar, atau hubungi waiter untuk pesan tanpa akun pribadi</small>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input id="username" type="username" class="form-control" name="username" tabindex="1" required autofocus>
                        <div class="invalid-feedback">
                            Silahkan masukan username
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">Password</label>
                        </div>
                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                        <div class="invalid-feedback">
                            Silahkan masukan password
                        </div>
                    </div>

                    @if(session('gagal'))
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>×</span>
                            </button>
                            Password atau Username Salah
                        </div>
                    </div>
                    @endif

                    @if(session('regis'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>×</span>
                            </button>
                            Berhasil Daftar, Silahkan login
                        </div>
                    </div>
                    @endif

                    <button type="submit" class="btn btn-danger btn-lg btn-block">
                        Login
                    </button>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class=" ">
                    Belum punya akun ? <a href="{{route('pelanggan.daftar')}}" class="text-primary">Daftar Disini</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endpush
@push('js')
<script>
    $(function() {
        $('.tombol-hapus').click(function() {
            var url = $(this).attr('data-url');
            $("#ordermenuform").attr('action', url);
            $('#login').modal('show');
        });
    });
</script>
@endpush



@endsection

@push('after-scripts')
<script type="text/javascript">
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        autoplay: 1000,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })
</script>
@endpush

@push('page-scripts')

<script src="{{ asset('node_modules/sweetalert/dist/sweetalert.min.js')}}"></script>

@endpush

@push('after-scripts')
@if(!empty(Session::get('sukses')))
<script>
    $(document).ready(function() {
        // id = e.target.dataset.id;
        swal({
            title: 'Order Sukses',
            text: 'Pesanan Anda Telah di proses, Akun anda otomatis logout dari halaman ini, Hubungi Waiter jika ada yang ditanyakan',
            icon: 'success',
            showCancelButton: false,
            timer: 5000,
        });
    });
</script>
@endif
@endpush