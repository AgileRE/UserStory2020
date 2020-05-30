<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>User Story</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <!-- <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}"> -->
    <link rel="stylesheet" href="{{asset('admin/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/gijgo.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/slicknav.css')}}">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
    @yield('style')
    <style media="screen">
    .form-control{
      width: 100%;
      display: block;
    }
    </style>
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>
<body>
  @yield('content')
  <!-- JS here -->
  <script src="{{asset('admin/js/vendor/modernizr-3.5.0.min.js')}}"></script>
  <script src="{{asset('admin/js/vendor/jquery-1.12.4.min.js')}}"></script>
  <!-- <script src="{{asset('admin/js/popper.min.js')}}"></script> -->
  <!-- <script src="{{asset('admin/js/bootstrap.min.js')}}"></script> -->
  <script src="{{asset('admin/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('admin/js/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('admin/js/ajax-form.js')}}"></script>
  <script src="{{asset('admin/js/waypoints.min.js')}}"></script>
  <script src="{{asset('admin/js/jquery.counterup.min.js')}}"></script>
  <script src="{{asset('admin/js/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{asset('admin/js/scrollIt.js')}}"></script>
  <script src="{{asset('admin/js/jquery.scrollUp.min.js')}}"></script>
  <script src="{{asset('admin/js/wow.min.js')}}"></script>
  <script src="{{asset('admin/js/nice-select.min.js')}}"></script>
  <script src="{{asset('admin/js/jquery.slicknav.min.js')}}"></script>
  <script src="{{asset('admin/js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{asset('admin/js/plugins.js')}}"></script>
  <script src="{{asset('admin/js/gijgo.min.js')}}"></script>
  <script src="{{asset('admin/js/slick.min.js')}}"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/e3f68e4941.js" crossorigin="anonymous"></script>


  <!--contact js-->
  <script src="{{asset('admin/js/contact.js')}}"></script>
  <script src="{{asset('admin/js/jquery.ajaxchimp.min.js')}}"></script>
  <script src="{{asset('admin/js/jquery.form.js')}}"></script>
  <script src="{{asset('admin/js/jquery.validate.min.js')}}"></script>
  <script src="{{asset('admin/js/mail-script.js')}}"></script>


  <script src="{{asset('admin/js/main.js')}}"></script>
  <script>
      $('#datepicker').datepicker({
          iconsLibrary: 'fontawesome',
          icons: {
           rightIcon: '<span class="fa fa-caret-down"></span>'
       }
      });
  </script>
  @yield('script')
  </body>

  </html>
