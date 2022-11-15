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
                            {{__('main.show_application')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-3">
                        <table id="myTable" class="table display dataTable table-bordered">
                            <thead>
                            <tr>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.employee_name')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.offer')}}
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
                                    {{__('main.status')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.created_at')}}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="border-top-0 text-center">
                                <td>{{ $application->offer->employee_name }}</td>
                                <td>
                                    <a data-bs-toggle="modal" href="javascript:;" class="get_offer"
                                       data-bs-target="#exampleModal30" offer_id="{{$application->offer->id}}">
                                        {{__('main.click')}}
                                    </a>
                                </td>
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
                                <td>{{ $application->identity_expiration_date}}</td>
                                <td>
                                    @if($application->status == "waiting")
                                        <span class="badge badge-md badge-warning">
                                                {{__('main.'.$application->status.'')}}
                                            </span>
                                    @elseif($application->status == "approved")
                                        <span class="badge badge-md badge-success">
                                                {{__('main.'.$application->status.'')}}
                                            </span>
                                    @elseif($application->status == "declined")
                                        <a data-bs-toggle="modal" class="get_reason" href="javascript:;"
                                           data-bs-target="#exampleModal50" reason="{{$application->decline_reason}}">
                                                <span class="badge badge-danger">
                                                    {{__('main.'.$application->status.'')}}
                                                </span>
                                        </a>
                                    @endif
                                </td>
                                <td>{{$application->created_at}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>

                    <div class="table-responsive mt-5">
                        <table id="myTable" class="table display dataTable table-bordered">
                            <thead>
                            <tr>

                                <th class="border-bottom-0 text-center">
                                    {{__('main.social_security')}}
                                </th>

                                <th class="border-bottom-0 text-center">
                                    {{__('main.documents_complete')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.medical_insurance')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.support_registered')}}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="border-top-0 text-center">

                                <td>{{__('main.'.$application->social_security.'')}}</td>

                                <td>{{__('main.'.$application->documents_complete.'')}}</td>

                                <td>{{__('main.'.$application->medical_insurance.'')}}</td>

                                <td>{{__('main.'.$application->support_registered.'')}}</td>

                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        @if(Auth::user()->role_name == "مدير النظام")
            <div class="col-12 mt-5 mb-5">
                <div class="card">
                    <div class="card-header py-3 bg-transparent border-bottom-0">
                        <h6 class="card-title mb-0"><strong>
                                {{__('main.show_reviewers')}}
                            </strong></h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mb-3">
                            <table id="myTable" class="table display dataTable table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">
                                        {{trans('main.job_title')}}
                                    </th>
                                    <th class="text-center">
                                        {{trans('main.review')}}
                                    </th>
                                    <th class="text-center">
                                        {{trans('main.notes')}}
                                    </th>
                                    <th class="text-center">
                                        {{trans('main.created_at')}}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($application->job_titles as $reviewer)
                                    <tr>
                                        <td>
                                            @if(App::getLocale() == "ar")
                                                {{$reviewer->job_title->job_title_ar}}
                                            @else
                                                {{$reviewer->job_title->job_title_en}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($reviewer->review == "approved")
                                                <span class='badge badge-md badge-success'>
                                                {{trans('main.'.$reviewer->review)}}
                                            </span>
                                            @elseif($reviewer->review == "declined")
                                                <span class='badge badge-md badge-danger'>
                                                {{trans('main.'.$reviewer->review)}}
                                            </span>
                                            @else
                                                <span class='badge badge-md badge-secondary'>
                                                {{trans('main.no')}}
                                            </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($reviewer->notes))
                                                {{$reviewer->notes}}
                                            @else
                                                {{trans('main.no')}}
                                            @endif

                                        </td>
                                        <td>
                                            @if(!empty($reviewer->review))
                                                {{$reviewer->updated_at}}
                                            @else
                                                {{trans('main.no')}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>

    <div class="modal fade" id="exampleModal30" tabindex="-1" aria-labelledby="exampleModalLabel30"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title w-100" id="exampleModalLabel30">
                        {{__('main.show_offer')}}
                    </h5>
                    <button type="button" class="btn btn-default btn-md btn-close" data-bs-dismiss="modal">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <div class="form-group">
                        <label class="d-block" for="reason">
                            {{__('main.offer')}}
                        </label>
                        <div class="offer_details"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{__('main.cancel')}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal50" tabindex="-1" aria-labelledby="exampleModalLabel50"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title w-100" id="exampleModalLabel50">
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
        $('.get_offer').on('click', function () {
            $('.offer_details').html('');
            var offer_id = $(this).attr('offer_id');
            $.post('{{route('show.offer.details')}}', {
                "_token": "{{ csrf_token() }}", offer_id: offer_id
            }, function (data) {
                $('.offer_details').html(data);
            });
        });
        $('.get_reason').on('click', function () {
            var reason = $(this).attr('reason');
            $('#reason').val(reason);
        });
    });
</script>

