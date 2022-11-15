<!doctype html>
<html class="no-js " lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="شركة دار البناء للمقاولات">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Author" content="شركة دار البناء للمقاولات">
    <link rel="icon" href="{{asset('assets/img/favicon.ico')}}" type="image/png">
    <meta name="Keywords" content="شركة دار البناء للمقاولات"/>
    <title>
        {{__('main.system_name')}}
    </title>
    <link rel="stylesheet" href="{{asset('admin-assets/css/al.style.min.css')}}">
    <!-- project layout css file -->
    <link rel="stylesheet" href="{{asset('admin-assets/css/layout.a.min.css')}}">
    <style>
        @if(App::getLocale() == "ar")
            @font-face {
            font-family: 'Almarai';
            src: url("{{asset('fonts/Almarai.ttf')}}");
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Almarai' !important;
        }
        body, html {
            font-family: 'Almarai';
        }
        @else
            @font-face {
            font-family: 'IBMPlexSans';
            src: url("{{asset('fonts/IBMPlexSans.ttf')}}");
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'IBMPlexSans' !important;
        }
        body, html {
            font-family: 'IBMPlexSans';
        }
        @endif
    </style>
</head>
<body>
<div id="layout-a" class="theme-blue">
    <!-- main body area -->
    <div class="main auth-div p-2 py-3 p-xl-5">
        <!-- Body: Body -->
        <div class="body d-flex p-0 p-xl-5">
            <div class="container-fluid">
                <div class="row g-0">
                    <div
                        class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                        <div class="w-100 p-4 p-md-5 card border-0">
                            <!-- Form -->
                            <form class="row g-1 p-0 p-md-4">
                                <div class="col-12 text-center mb-4">
                                    <img src="{{asset('admin-assets/images/auth-404.svg')}}" class="w240 mb-4" alt=""/>
                                    <h1 class="display-1">500</h1>
                                    @if(App::getLocale() == "ar")
                                        <h5>خطأ داخلى فى الخادم</h5>
                                        <span class="text-muted">
                                            النظام ربنا يواجه مشاكل او اخطاء  داخلية فى الخادم الرئيسي للموقع
                                    </span>
                                    @else
                                        <h5>Internal Server Error</h5>
                                        <span class="text-muted">
                                        the system encountered an error in the internal server !
                                    </span>
                                    @endif
                                </div>
                                <div class="col-12 text-center">
                                    <a href="{{route('supervisor.home')}}" title=""
                                       class="btn btn-lg btn-block btn-dark lift text-uppercase">
                                        @if(App::getLocale() == "ar")
                                            الرجوع الى الصفحة الرئيسية
                                        @else
                                            Back to Home
                                        @endif
                                    </a>
                                </div>
                            </form>
                            <!-- End Form -->
                        </div>
                    </div>
                </div> <!-- End Row -->
            </div>
        </div>
    </div>
</div>
<!-- Jquery Core Js -->
<script src="{{asset('admin-assets/bundles/libscripts.bundle.js')}}"></script>
<!-- Jquery Page Js -->
<script src="{{asset('admin-assets/js/template.js')}}"></script>
</body>
</html>
