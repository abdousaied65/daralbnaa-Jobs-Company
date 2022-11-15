@extends('supervisor.layouts.master')
<link rel="stylesheet" href="{{asset('admin-assets/css/bootstrap.min.css')}}">
<style>
    i.la {
        font-size: 15px !important;
    }

    span.badge {
        padding: 10px !important;
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
                            <thead>
                            <tr>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.application')}}
                                </th>
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
                                    {{__('main.passport_number')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.employee_address')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.phone_number')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.another_phone_number')}}
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
                                    {{__('main.start_date')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.end_date')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.basic_salary')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.housing_allowance')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.transport_allowance')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.another_allowance')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.total_salary')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.employee_signature')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.notes')}}
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
                            <tr class="border-top-0 text-center">
                                <td>
                                    <a data-bs-toggle="modal" href="javascript:;" class="get_application"
                                       data-bs-target="#exampleModal30" application_id="{{$contract->application->id}}">
                                        {{__('main.click')}}
                                    </a>
                                </td>
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
                                <td>{{$contract->passport_number}}</td>
                                <td>{{$contract->employee_address}}</td>
                                <td>{{$contract->phone_number}}</td>
                                <td>{{$contract->another_phone_number}}</td>
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
                                <td>{{$contract->start_date}}</td>
                                <td>{{$contract->end_date}}</td>
                                <td>{{$contract->basic_salary}}</td>
                                <td>{{$contract->housing_allowance}}</td>
                                <td>{{$contract->transport_allowance}}</td>
                                <td>{{$contract->another_allowance}}</td>
                                <td>{{$contract->total_salary}}</td>
                                <td><img src="{{asset($contract->employee_signature)}}"
                                         style="width:60px; height: 60px;border: 1px solid #000; padding:3px; border-radius: 100%;" alt=""></td>
                                <td>{{$contract->notes}}</td>
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
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>
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
    </div>
@endsection

<script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.get_application').on('click', function () {
            $('.application_details').html('');
            var application_id = $(this).attr('application_id');
            $.post('{{route('show.application.details')}}', {
                "_token": "{{ csrf_token() }}", application_id: application_id
            }, function (data) {
                $('.application_details').html(data);
            });
        });
    });
</script>

