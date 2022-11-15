@extends('employee.layouts.master')
<link rel="stylesheet" href="{{asset('admin-assets/css/bootstrap.min.css')}}">
<style>
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }

    .btn-md {
        height: 40px !important;
        min-width: 100px !important;
        padding: 10px !important;
        text-align: center !important;
    }

    input[type="checkbox"] {
        width: 20px;
        height: 20px;
    }

    span.badge {
        padding: 10px !important;
    }

    @media only screen and (max-width: 768px) {
        /* For mobile phones: */
        .wrapper-signature {
            width: 100% !important;
        }
    }

    @media only screen and (min-width: 768px) {
        /* For mobile phones: */
        .wrapper-signature {
            width: 400px !important;
            margin: 10px auto !important;
        }
    }

    .wrapper-signature {
        position: relative;
        height: 200px;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .signature-pad {
        position: relative;
        width: 100% !important;
        height: 200px;
        border: 1px solid #000;
        background-color: white;
    }
</style>
@section('content')
    @if (session('success'))
        <div class="alert alert-success  fade show">
            {{ session('success') }}
        </div>
    @endif
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-12 mb-5">
            <div class="card">
                <div class="card-header py-3 bg-transparent border-bottom-0">
                    <h6 class="card-title mb-0">
                        <strong> {{__('main.show_all_contracts')}} </strong>
                    </h6>
                </div>
                <div class="card-body">

                    @foreach ($data as $key => $contract)
                        <div class="table-responsive mb-3">
                            <table id="myTable" class="table display dataTable table-bordered">
                                <tbody>
                                <tr>
                                    <td>{{__('main.application')}}</td>
                                    <td>
                                        <a data-bs-toggle="modal" href="javascript:;" class="get_application"
                                           data-bs-target="#exampleModal30"
                                           application_id="{{$contract->application->id}}">
                                            {{__('main.click')}}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{__('main.employee_name')}}</td>
                                    <td>{{ $contract->employee_name }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('main.date')}}</td>
                                    <td>{{ $contract->date }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('main.nationality')}}</td>
                                    <td>
                                        @if(!empty($contract->nationality_id))
                                            @if(App::getLocale() == "ar")
                                                {{$contract->nationality->nationality_ar}}
                                            @else
                                                {{$contract->nationality->nationality_en}}
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{__('main.identity_residency_number')}}</td>
                                    <td>{{$contract->identity_number}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('main.passport_number')}}</td>
                                    <td>{{$contract->passport_number}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('main.employee_address')}}</td>
                                    <td>{{$contract->employee_address}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('main.phone_number')}}</td>
                                    <td>{{$contract->phone_number}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('main.another_phone_number')}}</td>
                                    <td>{{$contract->another_phone_number}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('main.email')}}</td>
                                    <td>{{$contract->email}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('main.job_title')}}</td>
                                    <td>
                                        @if(!empty($contract->job_title_id))
                                            @if(App::getLocale() == "ar")
                                                {{$contract->job_title->job_title_ar}}
                                            @else
                                                {{$contract->job_title->job_title_en}}
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{__('main.contract_period')}}</td>
                                    <td>{{$contract->contract_period}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('main.start_date')}}</td>
                                    <td>{{$contract->start_date}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('main.end_date')}}</td>
                                    <td>{{$contract->end_date}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('main.basic_salary')}}</td>
                                    <td>{{$contract->basic_salary}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('main.housing_allowance')}}</td>
                                    <td>{{$contract->housing_allowance}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('main.transport_allowance')}}</td>
                                    <td>{{$contract->transport_allowance}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('main.another_allowance')}}</td>
                                    <td>{{$contract->another_allowance}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('main.total_salary')}}</td>
                                    <td>{{$contract->total_salary}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('main.employee_signature')}}</td>
                                    <td><img src="{{asset($contract->employee_signature)}}"
                                             style="width:60px; height: 60px;border: 1px solid #000; padding:3px; border-radius: 100%;"
                                             alt=""></td>
                                </tr>
                                <tr>
                                    <td>{{__('main.notes')}}</td>
                                    <td>{{$contract->notes}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('main.status')}}</td>
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
                                </tr>
                                <tr>
                                    <td>{{__('main.created_at')}}</td>
                                    <td>{{$contract->created_at}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('main.control')}}</td>
                                    <td>
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                id="dropdownMenuButton"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-wrench"></i>
                                            {{__('main.control')}}
                                        </button>
                                        <ul class="dropdown-menu border-0 shadow p-3">
                                            <li>
                                                <a href="{{ route('employee.contracts.show', $contract->id) }}"
                                                   class="dropdown-item py-2 rounded">
                                                    <i class="fa fa-eye"></i>
                                                    {{__('main.show')}}
                                                </a>
                                            </li>
                                            <li>
                                                <a target="_blank"
                                                   href="{{ route('employee.contract.print', $contract->id) }}"
                                                   class="dropdown-item py-2 rounded text-primary">
                                                    <i class="fa fa-print"></i>
                                                    {{__('main.print')}}
                                                </a>
                                            </li>

                                        </ul>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                    @endforeach
                </div>
            </div>
        </div>


        <div class="modal fade" id="exampleModal30" tabindex="-1" aria-labelledby="exampleModalLabel30"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title w-100" id="exampleModalLabel30">
                            {{__('main.show_application')}}
                        </h5>
                        <button type="button" class="btn btn-default btn-md btn-close" data-bs-dismiss="modal">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                    <div class="modal-body text-right">
                        <div class="form-group">
                            <label class="d-block" for="reason">
                                {{__('main.application')}}
                            </label>
                            <div class="application_details"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{__('main.cancel')}}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal40" tabindex="-1" aria-labelledby="exampleModalLabel40"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title w-100" id="exampleModalLabel40">
                            {{__('main.show_contract')}}
                        </h5>
                        <button type="button" class="btn btn-default btn-md btn-close" data-bs-dismiss="modal">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                    <div class="modal-body text-right">
                        <div class="form-group">
                            <label class="d-block" for="reason">
                                {{__('main.contract')}}
                            </label>
                            <div class="contract_details">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{__('main.cancel')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.get_application').on('click', function () {
                $('.application_details').html('');
                var application_id = $(this).attr('application_id');
                $.post('{{route('employee.show.application.details')}}', {
                    "_token": "{{ csrf_token() }}", application_id: application_id
                }, function (data) {
                    $('.application_details').html(data);
                });
            });
            $('#myTable').DataTable({
                "columnDefs": [
                    {"orderable": false, "targets": [0, 20, 21, 22, 23, 24]}
                ],
                "paging": false,
            });
        });
    </script>
@endsection
