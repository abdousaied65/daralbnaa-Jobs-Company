<!DOCTYPE html>
<html @if (\App::getLocale() == 'ar') direction="rtl" dir="rtl" style="direction: rtl"
      @else direction="ltr" dir="ltr" style="direction: ltr"@endif>
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
    @include('supervisor.layouts.head')
    <style>
        .select2-selection__rendered {
            line-height: 50px !important;
            border-radius: 0 !important;
        }

        .select2-container .select2-selection--single {
            height: 50px !important;
            border-radius: 0 !important;
        }

        .select2-selection__arrow {
            height: 50px !important;
            border-radius: 0 !important;
        }

        .select2-search__field {
            height: 50px !important;
            line-height: 50px !important;
            outline: 0 !important;
        }

        .select2-container .select2-dropdown .select2-search__field {
            height: 45px !important;
        }

        table tr td {
            font-size: 14px !important;
        }
    </style>
</head>
<body @if (\App::getLocale() == 'ar') direction="rtl" dir="rtl" style="direction: rtl"
      @else direction="ltr" dir="ltr" style="direction: ltr"@endif>
<div id="layout-a" class="theme-blue">
    <!-- Navigation -->
    @include('supervisor.layouts.main-sidebar')
    <!-- main body area -->
    <div class="main px-xl-5 px-lg-4 px-md-3">
        @include('supervisor.layouts.main-header')
        @yield('content')
        @include('supervisor.layouts.footer')
    </div>

</div>
@include('supervisor.layouts.footer-scripts')
</body>
</html>
