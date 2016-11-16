<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="admin login">
    <meta name="author" content="">

    <title>{!! config('app.name','Iloilo Finest') !!}</title>

    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,300italic">
    <link rel="stylesheet" href=" {{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }} ">
    <link rel="stylesheet" href=" {{ asset('vendors/font-awesome/css/font-awesome.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/w3.css') }}">

    <style>

     html, body{
          padding:0px;
          margin:0px;
          height:100%;
          font-family: Roboto,sans-serif;
          font-size: 14px;
          line-height: 1.57142857;
          color: #76838f;
          background-color: #fff;
         }

        /*   .login-page {
            background-image: url('');
            background-size: cover;
            margin: 0;
            padding: 0;
        }*/

        .logo-img {
            width: 100px;
            z-index: 999;
            position: relative;
            float: left;
            -webkit-animation: spin 1s linear 1;
            -moz-animation: spin 1s linear 1;
            animation: spin 1s linear 1;
        }

        #bgdim {
            background: rgba(38, 50, 56, .6);
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        #title_section {
            width: auto;
            position: absolute;
            margin-left: 120px;
            top: 50%;
            margin-top: 25%;
        }

        #title_section .copy {
            float: left;
        }

        #title_section h1 {
            display: inline-block;
            vertical-align: middle;
            color: #fff;
            z-index: 9999;
            position: relative;
            text-transform: uppercase;
            font-size: 50px;
            font-weight: 400;
            top: -10px;
            line-height: 45px;
            margin: 20px 0 0 20px;
        }

        #title_section p {
            color: #fff;
            font-size: 20px;
            max-width: 650px;
            opacity: .6;
            position: relative;
            z-index: 99;
            font-weight: 200;
            margin-top: 0;
            left: 25px;
        }


        #login_section {
            /*padding: 0;*/
            margin: 0;
            height: 100%;
            position: absolute;
            right: 0;
            top: 0;
            text-align: center;
            background: #fff;
            z-index: 99;
        }
        #login_section_box {
            margin-top: 30%;
        }


        #login_section h2 {
            text-align: left;
            /*margin-left: 50px;*/
            font-weight: 200;
            margin-bottom: 20px;
            margin-top: 3px;
            color: #275e96;
            font-size: 40px;
            text-align: center;
        }

        #login_section .btn {
            background: #275e96;
            border-radius: 0;
            color: #fff;
            width: 100%;
            margin-left: 0;
            text-align: center;
            padding: 13px 10px 13px 10px;
            border-width: 0;
            -webkit-transition-duration: 0.4s; /* Safari */
            transition-duration: 0.4s;
        }

        #login_section .btn:hover {
            background-color: #164b80;
            color: white;
        }

        .btn-login {
            text-decoration: none;
        }

    
        #login_section p {
            font-weight: 100;
            margin-top: 10px;
            float: left;
            margin-left: 50px;
        }

        #login_section .content {       
            margin-top: 40%;
        }

        .cls-controls {
            padding: 20px 50px;
            border: 0;
            background: #f5f5f5;
            border-radius: 0;
            float: left;
            margin-left: 0;
            margin-bottom: 10px;
            font-size: 13px;
            font-weight: 100;
        }

        #group_remember {
            padding: 0px 50px;
            /*margin-left: 0;*/
            font-size: 12px;
            font-weight: 200;
            float: left
        }

        textarea, input, button {
            outline: none;
        }

        button {
            cursor: pointer;
        }


        #voyager-login-btn{
            margin-top: 10px;
        }

        #forgot{
            margin-top: 50px;
        }
        
        .btn-loading {
            height: 16px;
             width: 16px;
            float: left;
            margin: 3px 3px 0 -1px;
            -webkit-animation: spin 0.4s linear infinite;
            -moz-animation: spin 0.4s linear infinite;
            animation: spin 0.4s linear infinite;
        }

        .login_loader {
            display: none;
        }


        @-moz-keyframes spin {
            100% {
                -moz-transform: rotate(90deg);
            }
        }

        @-webkit-keyframes spin {
            100% {
                -webkit-transform: rotate(90deg);
            }
        }

        @keyframes spin {
            100% {
                -webkit-transform: rotate(90deg);
                transform: rotate(90deg);
            }
        }

        #messagebox{
            position: absolute;
            padding: 0;
            border:0;
            margin: 0;
            bottom: 0;
            right: 0;
        }

        #messagebox .alert{
            margin: 0;
        }
        

    </style>



</head>
<body class="login-page">

                

<div id="bgdim" class="hidden-xs hidden-sm"></div>

    {{-- right sidebar --}}
    <div class="hidden-xs hidden-sm col-md-9">
        <div id="title_section">

            <img class="logo-img" src="{{ asset('img/logo-light.png') }}" alt="Admin Login">
            <div class="copy">
                <h1>{{ config('setup.login_title','Title Here') }}</h1>
                <p>{{ config('setup.login_description','Description Here') }}</p>
            </div>
            <div style="clear:both"></div>

        </div>
    </div>

    {{-- left sidebar --}}
    <div class="col-xs-12 col-sm-12 col-md-3" id="login_section">

       

        <div id="login_section_box">
            @yield('authcontent')
        </div>
         <div id="messagebox">
            @yield('messagebox')
            @include('errors.errors')
        </div>

    </div>

  <img class="mySlides w3-animate-fading" src="{!! asset('img/bg.jpg') !!}" style="width:100%;height: 99.9%;">
  <img class="mySlides w3-animate-fading" src="{!! asset('img/bg2.jpg') !!}" style="width:100%;height: 99.9%;">
  <img class="mySlides w3-animate-fading" src="{!! asset('img/bg3.jpg') !!}" style="width:100%;height: 99.9%;">


<script src=" {{ asset('vendors/jquery/dist/jquery.min.js') }} "></script>
<script src=" {{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }} "></script>



<script>

    login_btn = document.getElementById("voyager-login-btn");
    login_btn.addEventListener("click", function () {
        var originalHeight = login_btn.offsetHeight;
        login_btn.style.height = originalHeight + 'px';

        document.querySelector('#voyager-login-btn span.login_text').style.display = 'none';
        document.querySelector('#voyager-login-btn span.login_loader').style.display = 'block';

        var duration = 500;
        setTimeout(function() {
            document.querySelector('#voyager-login-btn span.login_text').style.display = 'block';
            document.querySelector('#voyager-login-btn span.login_loader').style.display = 'none';
        }, duration);

    });



var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}
    x[myIndex-1].style.display = "block";
    setTimeout(carousel, 9000);
}


</script>


</body>
</html>