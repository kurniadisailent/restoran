@if(Request::is('pelanggan/order*'))
@else
<div class="row ">
    <div class="col-md-8 p-0">
        <div class="owl-carousel owl-theme ">
            <div class="item"><img src="{{asset('assets/settings/banner1.png')}}" style="width:100%;" class="img-responsive shadow"></div>
            <div class="item"><img src="{{asset('assets/settings/banner2.jpg')}}" style="width:100%;" class="img-responsive shadow"></div>
            <div class="item"><img src="{{asset('assets/settings/banner3.jpg')}}" style="width:100%;" class="img-responsive shadow"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div><img class="mb-3 shadow" src="{{asset('assets/settings/banner4.jpg')}}" style="width:100%"></div>
        <div><img class="mt-1 shadow" src="{{asset('assets/settings/banner5.jpg')}}" style="width:100%"></div>
    </div>
</div>
<script>
    if (IE9) {
        $(".row.equal-cols > [class*='col-']").matchHeight();
    }
</script>
@endif

<!-- Lihat Order Button -->
<div class="container-fluid">
    <div class="row d-flex justify-content-end float-right mb-5 mr-5 fixed-bottom ">
        @if(\Auth::guard('pelanggan')->user())
        <a href="{{route('pelangganorder.cart',['id_pelanggan'=>\Auth::guard('pelanggan')->user()->id_pelanggan])}}" class="btn btn-warning shadow btn-circle btn-lg d-flex justify-content-center"><i class=" text-danger fas fa-shopping-basket mt-1"></i></a>
        @else
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
                $('.tombol-login').click(function() {
                    var url = $(this).attr('data-url');
                    $("#login form").attr('action', url);
                    $('#login').modal('show');
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
    </div>
</div>