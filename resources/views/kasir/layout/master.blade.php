<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title> Seafood Resto - @yield('title')</title>
  <link rel="icon" href="{{asset('assets/settings/logo3.png')}}">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/maxtexttablesettings.css')}}">
  <link rel="stylesheet" href="{{ asset('asset/css/othercustom.css')}}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owlcustom.css')}}">
  <link rel="stylesheet" href="{{ asset('owlcarousel/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{ asset('owlcarousel/owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/inhomecard.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/circlebutton.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/inpuandtable.css')}}">

  <link rel="stylesheet" href="{{ asset('assets/css/fixpage.css')}}">

  <style>
    body {
      position: relative;
      margin: 0;
      padding-bottom: 6rem;
      min-height: 100%;
    }

    footer {
      position: absolute;
      right: 0;
      bottom: 0;
      left: 0;
      padding: 1rem;
      background-color: #efefef;
      text-align: center;
    }
  </style>


  <!-- Template CSS -->
  <!--   <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css')}}"> -->

  @yield('page-styles')
</head>

<body>


  <div class="row">
    <div class="col-md-12">
      @include('waiter.layout.header')
    </div>
  </div>
  <div class="container-fluid col-md-11 mt-5 mb-5">
    @include('kasir.layout.menus')
    @yield('konten')
  </div>

  <footer class="footer bg-dark mt-5">
    <div class="text-center text-light py-3">
      Copyright Seafood Restaurant &copy; 2021 <div class="bullet">
      </div>
    </div>
  </footer>


  @stack('before-scripts')
  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('assets/js/stisla.js')}}"></script>


  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  @stack('page-scripts')

  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js')}}"></script>
  <script src="{{ asset('assets/js/custom.js')}}"></script>
  <script src="{{ asset('jquery.min.js')}}"></script>
  <script src="{{ asset('owlcarousel/owl.carousel.min.js')}}"></script>

  @stack('after-scripts')

  @stack('modal')
  <script src="{{url('js/jquery.slim.min.js')}}"></script>
  <script src="{{url('js/popper.min.js')}}"></script>
  <script src="{{url('js/bootstrap.min.js')}}"></script>

  @stack('js')

  <script>
    $('.stick-top').affix({
      offset: {
        top: 50
      }
    });
  </script>

</body>

</html>