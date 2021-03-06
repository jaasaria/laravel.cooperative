<!DOCTYPE html>
<html lang="en">
  <head>
    {{-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> --}}
    <title>{{ config('app.name', 'Iloilo|Finest') }}</title>

    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta  name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href=" {{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }} ">
    <link rel="stylesheet" href=" {{ asset('vendors/font-awesome/css/font-awesome.min.css') }} ">
    <link rel="stylesheet" href=" {{ asset('css/custom.min.css') }} ">  

    <link rel="stylesheet" href=" {{ asset('css/toastr.min.css') }} ">
    <link rel="stylesheet" href=" {{ asset('css/sweetalert/sweetalert.css') }} ">
    <link rel="stylesheet" href=" {{ asset('css/jquery-ui.css') }} ">

    {{-- Datatable --}}
    <link rel="stylesheet" href=" {{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }} ">
    <link rel="stylesheet" href=" {{ asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }} ">

    <link rel="stylesheet" href=" {{ asset('vendors/iCheck/skins/flat/green.css') }} ">
    <link rel="stylesheet" href=" {{ asset('vendors/select2/dist/css/select2.min.css') }} ">
    <link rel="stylesheet" href=" {{ asset('css/hover-min.css') }} ">

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

        @include('closure.toastr')

        {{-- @include('flash::message') --}}

        
        <div class="right_col" role="main">
            @yield('content')
        </div>

        @include('back.layouts.admin_footer')
        
      </div>
    </div>



    <script>
        window.Laravel = { csrfToken: '{{ csrf_token() }}'};
    </script>

    <script src="{{ asset('js/app.js') }}"></script>

    <script src=" {{ asset('js/jquery.min.js') }} "></script>

    <script src=" {{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }} "></script>
    <script src=" {{ asset('vendors/fastclick/lib/fastclick.js') }} "></script>
    <script src=" {{ asset('vendors/nprogress/nprogress.js') }} "></script>
    <script src=" {{ asset('js/custom.min.js') }} "></script>

    <script src=" {{ asset('js/sweetalert/sweetalert.min.js') }} "></script>
    <script src=" {{ asset('js/toastr.min.js') }} "></script>

    
    {{-- Datatable --}}
    <script src=" {{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src=" {{ asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>
    <script src=" {{ asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }} "></script>
    <script src=" {{ asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }} "></script>
    <script src=" {{ asset('vendors/iCheck/icheck.min.js') }} "></script>
    <script src=" {{ asset('vendors/switchery/dist/switchery.min.js') }} "></script>
    <script src=" {{ asset('vendors/jquery.tagsinput/src/jquery.tagsinput.js') }} "></script>
    <script src=" {{ asset('vendors/select2/dist/js/select2.full.min.js') }} "></script>

    <script src=" {{ asset('js/moment/moment.min.js') }} "></script>
    <script src=" {{ asset('js/datepicker/daterangepicker.js') }} "></script>

    <script src=" {{ asset('js/jquery-ui.js') }} "></script>


    @yield('jsscript')     
    @stack('scripts')



  </body>
</html>

