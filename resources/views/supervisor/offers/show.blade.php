@extends('supervisor.layouts.master')
<link rel="stylesheet" href="{{asset('admin-assets/css/bootstrap.min.css')}}">
<style>
    i.la {
        font-size: 15px !important;
    }
    span.badge{
        padding: 10px!important;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-3 bg-transparent border-bottom-0">
                    <h6 class="card-title mb-0"><strong>
                            {{__('main.show_offer')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table display dataTable table-bordered">
                            <thead>
                            <tr>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.employee_name')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.phone_number')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.nationality')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.job_title')}}
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
                                    {{__('main.weekend_vacation')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.yearly_vacation')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.contract_period')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.expired_at')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.employee_response')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.created_at')}}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="border-top-0 text-center">
                                <td>{{ $offer->employee_name }}</td>
                                <td>{{ $offer->phone_number }}</td>
                                <td>
                                    @if(!empty($offer->nationality_id))
                                        @if(App::getLocale() == "ar")
                                            {{$offer->nationality->nationality_ar}}
                                        @else
                                            {{$offer->nationality->nationality_en}}
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($offer->job_title_id))
                                        @if(App::getLocale() == "ar")
                                            {{$offer->job_title->job_title_ar}}
                                        @else
                                            {{$offer->job_title->job_title_en}}
                                        @endif
                                    @endif
                                </td>
                                <td>{{$offer->total_salary}}</td>
                                <td>{{$offer->weekend_vacation}}</td>
                                <td>{{$offer->yearly_vacation}}</td>
                                <td>{{$offer->contract_period}}</td>
                                <td>{{$offer->expired_at}}</td>
                                <td>
                                    @if($offer->employee_response == "waiting")
                                        <span class="badge badge-md badge-warning">
                                                {{__('main.'.$offer->employee_response.'')}}
                                            </span>
                                    @elseif($offer->employee_response == "approved")
                                        <span class="badge badge-success">
                                                {{__('main.'.$offer->employee_response.'')}}
                                            </span>
                                    @elseif($offer->employee_response == "declined")
                                        <a data-bs-toggle="modal" class="get_reason" href="javascript:;"
                                           data-bs-target="#exampleModal30" reason="{{$offer->decline_reason}}">
                                                <span class="badge badge-danger">
                                                    {{__('main.'.$offer->employee_response.'')}}
                                                </span>
                                        </a>
                                    @endif
                                </td>
                                <td>{{$offer->created_at}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal30" tabindex="-1" aria-labelledby="exampleModalLabel30"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title w-100" id="exampleModalLabel30">
                        {{__('main.decline_reason')}}
                    </h5>
                    <button type="button" class="btn btn-default btn-md btn-close" data-bs-dismiss="modal">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <div class="form-group">
                        <label class="d-block" for="reason">
                            {{__('main.decline_reason')}}
                        </label>
                        <textarea readonly name="decline_reason" class="form-control" id="reason"
                                  style="resize: none;width:100%!important; height: 200px!important;"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.get_reason').on('click', function () {
            var reason = $(this).attr('reason');
            $('#reason').val(reason);
        });
    });
</script>

