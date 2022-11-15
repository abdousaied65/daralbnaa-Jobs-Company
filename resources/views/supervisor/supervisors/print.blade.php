<!DOCTYPE html>
<html>
<head>
    <title> {{__('main.print_supervisors')}} </title>
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
            <h4>{{__('main.print_supervisors')}}</h4>
        </td>
    </tr>
    <tr>
        <td>
            <table dir="rtl" class="table table-condensed display table-bordered text-center">
                <thead>
                <tr>
                    <th class="border-bottom-0 text-center">#</th>
                    <th class="border-bottom-0 text-center">
                        {{__('main.supervisor_name')}} {{__('main.arabic')}}
                    </th>
                    <th class="border-bottom-0 text-center">
                        {{__('main.supervisor_name')}} {{__('main.english')}}
                    </th>

                    <th class="border-bottom-0 text-center">
                        {{__('main.email')}}
                    </th>
                    <th class="border-bottom-0 text-center">
                        {{__('main.phone_number')}}
                    </th>

                    <th class="border-bottom-0 text-center">
                        {{__('main.dept_name')}}
                    </th>

                    <th class="border-bottom-0 text-center">
                        {{__('main.job_title')}}
                    </th>

                    <th class="border-bottom-0 text-center">
                        {{__('main.projects')}}
                    </th>

                    <th class="border-bottom-0 text-center">
                        {{__('main.profile_picture')}}
                    </th>

                    <th class="border-bottom-0 text-center">
                        {{__('main.privilege')}}
                    </th>
                </tr>
                </thead>
                <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach ($supervisors as $supervisor)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $supervisor->supervisor_name_ar }}</td>
                        <td>{{ $supervisor->supervisor_name_en }}</td>
                        <td>{{ $supervisor->email }}</td>
                        <td>{{ $supervisor->phone_number }}</td>
                        <td>
                            @if(!empty($supervisor->dept_id))
                                @if(App::getLocale() == "ar")
                                    {{$supervisor->dept->dept_name_ar}}
                                @else
                                    {{$supervisor->dept->dept_name_en}}
                                @endif
                            @endif
                        </td>
                        <td>
                            @if(!empty($supervisor->job_title_id))
                                @if(App::getLocale() == "ar")
                                    {{$supervisor->job_title->job_title_ar}}
                                @else
                                    {{$supervisor->job_title->job_title_en}}
                                @endif
                            @endif
                        </td>
                        <td>
                            @foreach($supervisor->projects as $key => $project)
                                @if(App::getLocale() == "ar")
                                    - {{$project->project_name_ar}}
                                    <br>
                                @else
                                    - {{$project->project_name_en}}
                                    <br>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @if(empty($supervisor->profile_pic))
                                <img data-bs-toggle="modal" href="javascript:;"
                                     data-bs-target="#exampleModal10"
                                     src="{{asset('assets/img/guest.png')}}"
                                     style="width: 70px;cursor: pointer; height: 70px;border-radius: 100%; padding: 3px; border: 1px solid #aaa;">
                            @else
                                <img data-bs-toggle="modal" href="javascript:;"
                                     data-bs-target="#exampleModal10"
                                     src="{{asset($supervisor->profile_pic)}}"
                                     style="width: 70px;cursor: pointer; height: 70px;border-radius: 100%; padding: 3px; border: 1px solid #aaa;">
                            @endif
                        </td>
                        <td>
                            {{$supervisor->role_name}}
                        </td>
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
