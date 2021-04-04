<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SEAFOOD RESTO - Register Pelanggan</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-social/bootstrap-social.css')}}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css')}}">
</head>


<body>
<style type="text/css">
    body
    {
      background-image:url('../assets/settings/bg_login.jpg');
      width: 100%;

      /* Center and scale the image nicely */
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="{{asset('assets/settings/logo3.png')}}" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>
            <div class="card card-danger">
              <div class="card-header">
                <h4 class="text-danger">Daftar</h4>
              </div>
              <div class="card-body">
                <form method="post" class="user" action="{{route('pelanggan.daftar.prosses')}}" class="needs-validation" novalidate="">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="username">Nama Pelanggan</label>
                    <input id="username" type="text" class="form-control" name="nama_pelanggan" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Silahkan masukan Nama
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="username">Email</label>
                    <input id="username" type="email" class="form-control" name="email" tabindex="2" required autofocus>
                    <div class="invalid-feedback">
                      Silahkan masukan Email
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="username" class="form-control" name="username" tabindex="3" required autofocus>
                    <div class="invalid-feedback">
                      Silahkan masukan username
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="4" required>
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

                  <button type="submit" class="btn btn-danger btn-lg btn-block">
                    Daftar
                  </button>
                </form>
              </div>
              <div class="card-footer d-flex justify-content-center">
                <a href="{{route('pelanggan.login')}}" class="text-primary mr-1">Login</a>|<a href="/" class="text-primary ml-1"> Home </a>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy;
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js')}}"></script>
  <script src="{{ asset('assets/js/custom.js')}}"></script>

  <!-- Page Specific JS File -->
</body>

</html>