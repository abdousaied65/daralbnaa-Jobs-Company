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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-3 bg-transparent border-bottom-0">
                    <h6 class="card-title mb-0"><strong>
                            {{__('main.show_contract')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-3">
                        <table id="myTable" class="table display dataTable table-bordered">
                            <tbody>
                            <tr>
                                <td class="text-center">
                                    {{__('main.application')}}
                                </td>
                                <td>
                                    <a data-bs-toggle="modal" href="javascript:;" class="get_application"
                                       data-bs-target="#exampleModal30" application_id="{{$contract->application->id}}">
                                        {{__('main.click')}}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.employee_name')}}
                                </td>
                                <td>{{ $contract->employee_name }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.date')}}
                                </td>
                                <td>{{ $contract->date }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.nationality')}}
                                </td>
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
                                <td class="text-center">
                                    {{__('main.identity_residency_number')}}
                                </td>
                                <td>{{$contract->identity_number}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.passport_number')}}
                                </td>
                                <td>{{$contract->passport_number}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.employee_address')}}
                                </td>
                                <td>{{$contract->employee_address}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.phone_number')}}
                                </td>
                                <td>{{$contract->phone_number}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.another_phone_number')}}
                                </td>
                                <td>{{$contract->another_phone_number}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.email')}}
                                </td>
                                <td>{{$contract->email}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.job_title')}}
                                </td>
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
                                <td class="text-center">
                                    {{__('main.contract_period')}}
                                </td>
                                <td>{{$contract->contract_period}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.start_date')}}
                                </td>
                                <td>{{$contract->start_date}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.end_date')}}
                                </td>
                                <td>{{$contract->end_date}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.basic_salary')}}
                                </td>
                                <td>{{$contract->basic_salary}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.housing_allowance')}}
                                </td>
                                <td>{{$contract->housing_allowance}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.transport_allowance')}}
                                </td>
                                <td>{{$contract->transport_allowance}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.another_allowance')}}
                                </td>
                                <td>{{$contract->another_allowance}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.total_salary')}}
                                </td>
                                <td>{{$contract->total_salary}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.employee_signature')}}
                                </td>
                                <td><img src="{{asset($contract->employee_signature)}}"
                                         style="width:60px; height: 60px;border: 1px solid #000; padding:3px; border-radius: 100%;"
                                         alt="">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.notes')}}
                                </td>
                                <td>{{$contract->notes}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.status')}}
                                </td>
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
                                <td class="text-center">
                                    {{__('main.created_at')}}
                                </td>
                                <td>{{$contract->created_at}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        @if(empty($contract->employee_signature))
            <div class="col-12 mt-3 mb-5">
                <div class="card">
                    <div class="card-header py-3 bg-transparent border-bottom-0">
                        <h6 class="card-title mb-0"><strong>
                                {{__('main.approve_contract')}}
                            </strong></h6>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('employee.contract.approved')}}">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="contract_id" value="{{$contract->id}}" id="contract_id">
                            <label for="signature-pad" class="d-block">
                                {{__('main.signature')}}
                            </label>
                            <div class="wrapper-signature">
                                <canvas id="signature-pad" class="signature-pad d-block mt-1 mb-4"></canvas>
                                <textarea required id="signed" name="signed" style="display: none"></textarea>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="form-check">
                                    <p style="color: red !important;">
                                        <i class="fa fa-angle-double-left"></i>
                                        @if(App::getLocale() == "ar")
                                            عند توقيع الامضاء فإنك توافق على
                                            <a data-bs-toggle="modal" href="javascript:;"
                                               data-bs-target="#exampleModal100">
                                                الاقرار بالشروط والاحكام
                                            </a>
                                        @else
                                            By signing the signature, you agree to acknowledge
                                            عند تقديم الطلب فإنك توافق على
                                            <a data-bs-toggle="modal" href="javascript:;"
                                               data-bs-target="#exampleModal100">
                                                the terms and conditions
                                            </a>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="button mt-1 mb-5">
                                <button type="button" class="btn btn-md btn-danger" id="clear">
                                    {{__('main.delete_signature')}}
                                </button>
                                <button type="submit" class="btn btn-md btn-success" id="approve-contract">
                                    {{__('main.approve_contract')}}
                                </button>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        @endif

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
        });
    </script>

    <script src="{{asset('admin-assets/js/signature_pad.umd.js')}}"></script>
    <script>
        var canvas = document.getElementById('signature-pad');

        function resizeCanvas() {
            var ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
        }

        window.onresize = resizeCanvas;
        resizeCanvas();
        var signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
        });
        document.getElementById('approve-contract').addEventListener('click', function () {
            if (signaturePad.isEmpty()) {
                return alert("من فضلك قم بالتوقيع اولا");
            }
            var data = signaturePad.toDataURL('image/png');
            $('#signed').val(data);
        });
        document.getElementById('clear').addEventListener('click', function () {
            signaturePad.clear();
        });
    </script>
@endsection

