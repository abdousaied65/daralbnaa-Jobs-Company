<!DOCTYPE html>
<html>
<head>
    <title> {{__('main.print_contracts')}} </title>
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
            <h4>{{__('main.print_contracts')}}</h4>
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
                        {{__('main.nationality')}}
                    </th>
                    <th class="border-bottom-0 text-center">
                        {{__('main.identity_residency_number')}}
                    </th>

                    <th class="border-bottom-0 text-center">
                        {{__('main.phone_number')}}
                    </th>
                    <th class="border-bottom-0 text-center">
                        {{__('main.email')}}
                    </th>
                    <th class="border-bottom-0 text-center">
                        {{__('main.job_title')}}
                    </th>
                    <th class="border-bottom-0 text-center">
                        {{__('main.contract_period')}}
                    </th>

                    <th class="border-bottom-0 text-center">
                        {{__('main.basic_salary')}}
                    </th>

                    <th class="border-bottom-0 text-center">
                        {{__('main.total_salary')}}
                    </th>
                    <th class="border-bottom-0 text-center">
                        {{__('main.status')}}
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
                @foreach ($contracts as $contract)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $contract->employee_name }}</td>
                        <td>{{ $contract->date }}</td>
                        <td>
                            @if(!empty($contract->nationality_id))
                                @if(App::getLocale() == "ar")
                                    {{$contract->nationality->nationality_ar}}
                                @else
                                    {{$contract->nationality->nationality_en}}
                                @endif
                            @endif
                        </td>
                        <td>{{$contract->identity_number}}</td>
                        <td>{{$contract->phone_number}}</td>
                        <td>{{$contract->email}}</td>
                        <td>
                            @if(!empty($contract->job_title_id))
                                @if(App::getLocale() == "ar")
                                    {{$contract->job_title->job_title_ar}}
                                @else
                                    {{$contract->job_title->job_title_en}}
                                @endif
                            @endif
                        </td>
                        <td>{{$contract->contract_period}}</td>
                        <td>{{$contract->basic_salary}}</td>
                        <td>{{$contract->total_salary}}</td>
                        <td>
                            @if($contract->status == "waiting" || $contract->status == "pending")
                                <span class="badge badge-md badge-warning">
                                                {{__('main.'.$contract->status.'')}}
                                            </span>
                            @elseif($contract->status == "approved")
                                <span class="badge badge-md badge-success">
                                                {{__('main.'.$contract->status.'')}}
                                            </span>
                            @elseif($contract->status == "expired" || $contract->status == "declined" )
                                <span class="badge badge-md badge-danger">
                                                {{__('main.'.$contract->status.'')}}
                                            </span>
                            @endif
                        </td>
                        <td>{{$contract->created_at}}</td>
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
