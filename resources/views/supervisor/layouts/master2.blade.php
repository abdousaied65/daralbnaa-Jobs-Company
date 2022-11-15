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
</head>
<body @if (\App::getLocale() == 'ar') direction="rtl" dir="rtl" style="direction: rtl"
      @else direction="ltr" dir="ltr" style="direction: ltr"@endif >
<div id="layout-a" class="theme-blue">
    @yield('content')
</div>
@include('supervisor.layouts.footer-scripts')
</body>
</html>
