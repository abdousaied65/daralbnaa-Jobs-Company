<!DOCTYPE html>
<html>
<head>
    <title> {{__('main.print_applications')}} </title>
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
            right: 61px !important;
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
            left: 61px !important;
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
            <h4>{{__('main.print_applications')}}</h4>
        </td>
    </tr>
    <tr>
        <td>
            <table dir="rtl" class="table table-condensed display table-bordered text-center">
                <thead>
                <tr>
                    <th class="border-bottom-0 text-center">#</th>
                    <th class="border-bottom-0 text-center">
                        {{__('main.employee_name')}}
                    </th>
                    <th class="border-bottom-0 text-center">
                        {{__('main.date')}}
                    </th>
                    <th class="border-bottom-0 text-center">
                        {{__('main.application_type')}}
                    </th>
                    <th class="border-bottom-0 text-center">
                        {{__('main.dept_name')}}
                    </th>
                    <th class="border-bottom-0 text-center">
                        {{__('main.project_name')}}
                    </th>
                    <th class="border-bottom-0 text-center">
                        {{__('main.supervisors')}}
                    </th>
                    <th class="border-bottom-0 text-center">
                        {{__('main.basic_salary')}}
                    </th>
                    <th class="border-bottom-0 text-center">
                        {{__('main.identity_residency_number')}}
                    </th>
                    <th class="border-bottom-0 text-center">
                        {{__('main.identity_expiration_date')}}
                    </th>
                    <th class="border-bottom-0 text-center">
                        {{__('main.created_at')}}
                    </th>
                </tr>
                </thead>
                <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach ($applications as $application)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $application->offer->employee_name }}</td>
                        <td>{{$application->date}}</td>
                        <td>{{__('main.'.$application->application_type.'')}}</td>

                        <td>
                            @if(!empty($application->dept_id))
                                @if(App::getLocale() == "ar")
                                    {{$application->dept->dept_name_ar}}
                                @else
                                    {{$application->dept->dept_name_en}}
                                @endif
                            @endif
                        </td>
                        <td>
                            @if(!empty($application->project_id))
                                @if(App::getLocale() == "ar")
                                    {{$application->project->project_name_ar}}
                                @else
                                    {{$application->project->project_name_en}}
                                @endif
                            @endif
                        </td>

                        <td>
                            @foreach($application->job_titles as $job_title)
                                @if(App::getLocale() == "ar")
                                    - {{$job_title->job_title->job_title_ar}}
                                    <br>
                                @else
                                    - {{$job_title->job_title->job_title_en}}
                                    <br>
                                @endif
                            @endforeach
                        </td>

                        <td>{{ $application->basic_salary }}</td>
                        <td>{{ $application->identity_number }}</td>
                        <td>{{$application->identity_expiration_date}}</td>
                        <td>{{$application->created_at}}</td>
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
