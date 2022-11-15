<!DOCTYPE html>
<html>
<head>
    <title> {{__('main.print_depts')}} </title>
    <meta charset="utf-8"/>
    <link href="{{asset('/admin-assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <style type="text/css" media="screen">
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
            #layout-a .sidebar.sidebar-mini .menu-list .sub-menu {
                right: 61px!important;
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
            #layout-a .sidebar.sidebar-mini .menu-list .sub-menu {
                left: 61px!important;
            }
        @endif

        * {
            color: #000 !important;
            font-size: 14px !important;
            font-weight: bold !important;
        }

        .img-footer {
            width: 100% !important;
            height: 120px !important;
            max-height: 120px !important;

        }

        .table-container {
            width: 70%;
            margin: 10px auto;
        }

        .no-print {
            position: fixed;
            bottom: 0;
            right: 10px;
            border-radius: 0;
            z-index: 9999;
        }
    </style>
    <style type="text/css" media="print">

        * {
            font-size: 14px !important;
            color: #000 !important;
            font-weight: bold !important;
        }

        .img-footer {

            width: 100% !important;
            height: 120px !important;
            max-height: 120px !important;

        }

        .no-print, .noprint {
            display: none;
        }
    </style>
</head>
<body style="background: #fff">
<table class="table table-bordered table-container">
    <tbody>
    <tr>
        <td class="text-center">
            <img style="width: 100px!important; height: 100px!important;" src="{{asset('assets/img/logo.png')}}" alt="">
        </td>
    </tr>
    <tr>
        <td class="text-center">
            <h4>{{__('main.print_depts')}}</h4>
        </td>
    </tr>
    <tr>
        <td>
            <table dir="rtl" class="table table-condensed display table-bordered text-center">
                <thead>
                <tr>
                    <th class="border-bottom-0 text-center">#</th>
                    <th class="border-bottom-0 text-center"> {{__('main.dept_name')}} {{__('main.arabic')}}</th>
                    <th class="border-bottom-0 text-center"> {{__('main.dept_name')}} {{__('main.english')}}</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach ($depts as $dept)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $dept->dept_name_ar }}</td>
                        <td>{{ $dept->dept_name_en }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<button onclick="window.print();" class="no-print btn btn-lg btn-success text-white">{{__('main.print')}}</button>
<script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
</body>
</html>
