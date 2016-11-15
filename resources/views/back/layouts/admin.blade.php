<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Iloilo|Finest') }}</title>

    <link rel="stylesheet" href=" {{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }} ">
    <link rel="stylesheet" href=" {{ asset('vendors/font-awesome/css/font-awesome.min.css') }} ">
    <link rel="stylesheet" href=" {{ asset('css/custom.min.css') }} ">  

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>



{{-- 
    <link rel="stylesheet" href=" {{ asset('bootstrap/css/bootstrap.min.css') }} ">
    <link rel="stylesheet" href=" {{ asset('dist/sweetalert/sweetalert.css') }} ">
    <link rel="stylesheet" href=" {{ asset('dist/icons/ionicons.min.css') }} ">
    <link rel="stylesheet" href=" {{ asset('dist/icons/font-awesome-4.6.3/css/font-awesome.min.css') }} ">
    <link rel="stylesheet" href=" {{ asset('dist/css/toastr.min.css') }} ">
    <link rel="stylesheet" href=" {{ asset('dist/css/bootstrap-select.min.css') }} ">
    <link rel="stylesheet" href=" {{ asset('plugins/datepicker/datepicker3.css') }} ">
 --}}


    @yield('css.import')

    <style type="text/css">        
            @yield('css')
    </style>


  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">

        
        @include('back.layouts.admin_header')
        @include('back.layouts.admin_sidebar')
        @include('back.layouts.admin_content')


        <div class="right_col" role="main">
            @yield('content')
        </div>

        @yield('notificationfooter')
        @include('back.layouts.admin_footer')
        
      </div>
    </div>


        
    @yield('jsscript')     
    @stack('scripts')

    <script src=" {{ asset('vendors/jquery/dist/jquery.min.js') }} "></script>
    <script src=" {{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }} "></script>
    <script src=" {{ asset('vendors/fastclick/lib/fastclick.js') }} "></script>
    <script src=" {{ asset('vendors/nprogress/nprogress.js') }} "></script>
    <script src=" {{ asset('js/custom.min.js') }} "></script>
    <script src=" {{ asset('js/sweetalert/sweetalert.min.js') }} "></script>


{{-- <script src=" {{ asset('js/jquery.min.js') }} "></script>
<script src=" {{ asset('bootstrap/js/bootstrap.min.js') }} "></script>

<script src=" {{ asset('dist/sweetalert/sweetalert.min.js') }} "></script>
<script src=" {{ asset('dist/js/toastr.min.js') }} "></script>

<script src=" {{ asset('dist/js/bootstrap-select.min.js') }}"></script>
<script src=" {{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>


<script src=" {{ asset('js/buttons.print.min.js') }} "></script>
<script src=" {{ asset('js/dataTables.buttons.min.js') }} "></script>
<script src=" {{ asset('js/buttons.flash.min.js') }} "></script>
<script src=" {{ asset('js/jszip.min.js') }} "></script>
<script src=" {{ asset('js/pdfmake.min.js') }} "></script>
<script src=" {{ asset('js/vfs_fonts.js') }} "></script>
<script src=" {{ asset('js/buttons.html5.min.js') }} "></script>
 --}}


  </body>
</html>

