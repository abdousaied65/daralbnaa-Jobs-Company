@extends('supervisor.layouts.master')
<link rel="stylesheet" href="{{asset('admin-assets/css/bootstrap.min.css')}}">
<style>
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
    tfoot {
        display: table-row-group;
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

    .table-responsive {
        min-height: 500px !important;
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
                        <strong> {{__('main.show_all_applications')}} </strong>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row mt-1 mb-1 text-center justify-content-center align-content-center">
                        <form class="col-6" method="GET" action="{{route('print.selected.applications')}}">
                            <button type="submit" class="btn btn-md btn-light-warning m-1 print_selected">
                                <i class="fa fa-print"></i>
                                {{__('main.print')}}
                            </button>
                        </form>
                        <form class="col-6" method="POST" action="{{route('export.applications.excel')}}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-md btn-light-success m-1">
                                <i class="fa fa-file-excel-o"></i>
                                {{__('main.export')}} EXCEL
                            </button>
                        </form>

                        <form class="col-6" method="POST" id="myForm"
                              action="{{route('remove.selected.applications')}}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-md btn-light-danger m-1 remove_selected">
                                <i class="fa fa-trash"></i>
                                {{__('main.delete')}}
                            </button>
                        </form>
                        <div class="col-6">
                            <a href="{{route('supervisor.applications.create')}}" role="button"
                               class="btn btn-md btn-light-info">
                                <i class="fa fa-plus"></i>
                                {{__('main.add')}}
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable"
                               class="table table-bordered table-condensed text-center justify-content-center w-100 display dataTable">
                            <thead>
                            <tr>
                                <th class="border-bottom-0 text-center">
                                    <input type="checkbox" id="check_all"/>
                                </th>
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
                                <th style="width: 5%!important;" class="border-bottom-0 text-center">
                                    {{__('main.control')}}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $key => $application)
                                <tr>
                                    <td>
                                        <input class="check" name="applications[]" form="myForm"
                                               value="{{$application->id}}"
                                               type="checkbox">
                                    </td>
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
                                    <td>{{$application->identity_expiration_date}}</td>
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
                                               data-bs-target="#exampleModal50"
                                               reason="{{$application->decline_reason}}">
                                                <span class="badge badge-danger">
                                                    {{__('main.'.$application->status.'')}}
                                                </span>
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{$application->created_at}}</td>
                                    <td>
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                id="dropdownMenuButton"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-wrench"></i>
                                            {{__('main.control')}}
                                        </button>
                                        <ul class="dropdown-menu border-0 shadow p-3">
                                            @can('عرض قرار توظيف')
                                                <li>
                                                    <a href="{{ route('supervisor.applications.show', $application->id) }}"
                                                       class="dropdown-item py-2 rounded">
                                                        <i class="fa fa-eye"></i>
                                                        {{__('main.show')}}
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('تعديل قرار توظيف')
                                                <li>
                                                    <a href="{{ route('supervisor.applications.edit', $application->id) }}"
                                                       class="dropdown-item py-2 rounded">
                                                        <i class="fa fa-edit"></i>
                                                        {{__('main.edit')}}
                                                    </a>
                                                </li>
                                                @foreach($application->job_titles as $reviewer)
                                                    @if($reviewer->application_id == $application->id && $reviewer->dept_id == Auth::user()->dept_id && $reviewer->job_title_id == Auth::user()->job_title_id)
                                                        <li>
                                                            <a class="dropdown-item py-2 rounded review_application"
                                                               review_id="{{ $reviewer->id }}"
                                                               review="{{$reviewer->review}}"
                                                               notes="{{$reviewer->notes}}"
                                                               data-bs-toggle="modal" href="javascript:;"
                                                               data-bs-target="#exampleModal40">
                                                                <i class="fa fa-paper-plane-o"></i>
                                                                {{__('main.review_application')}}
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                                <li>
                                                    <a href="{{ route('approve.application', $application->id) }}"
                                                       class="dropdown-item py-2 rounded text-success">
                                                        <i class="fa fa-check"></i>
                                                        {{__('main.approve')}}
                                                    </a>
                                                </li>

                                                <li>
                                                    <a data-bs-toggle="modal" href="javascript:;"
                                                       data-bs-target="#exampleModal60"
                                                       application_id="{{$application->id}}"
                                                       class="dropdown-item py-2 rounded text-danger decline_application">
                                                        <i class="fa fa-close"></i>
                                                        {{__('main.decline')}}
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('حذف قرار توظيف')
                                                <li>
                                                    <a class="dropdown-item py-2 rounded delete_application"
                                                       application_id="{{ $application->id }}"
                                                       application="{{ $application->offer->employee_name }}"
                                                       data-bs-toggle="modal" href="javascript:;"
                                                       data-bs-target="#exampleModal20">
                                                        <i class="fa fa-trash"></i>
                                                        {{__('main.delete')}}
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                    <div class="text-center">
                            <span @if(App::getLocale()=="ar")
                                  class="text-center" @else @endif>{{ $data->withQueryString()->links() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal20" tabindex="-1" aria-labelledby="exampleModalLabel20"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title w-100" id="exampleModalLabel20">
                            {{__('main.delete_application')}}
                        </h5>
                        <button type="button" class="btn btn-default btn-md btn-close" data-bs-dismiss="modal">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                    <div class="modal-body text-right">
                        <form action="{{ route('supervisor.applications.destroy', 'test') }}" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <p>{{__('main.sure_delete')}}</p>
                                <input type="hidden" name="application_id" id="application_id" value="">
                                <input class="form-control form-control-lg" name="application" id="application"
                                       type="text"
                                       readonly>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">{{__('main.cancel')}}</button>
                                <button type="submit" class="btn btn-danger">{{__('main.delete')}}</button>
                            </div>
                        </form>
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

        <div class="modal fade" id="exampleModal40" tabindex="-1" aria-labelledby="exampleModalLabel40"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title w-100" id="exampleModalLabel40">
                            {{__('main.show_review')}}
                        </h5>
                        <button type="button" class="btn btn-default btn-md btn-close" data-bs-dismiss="modal">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                    <div class="modal-body text-right">
                        <div class="form-group">
                            <div class="review_details">
                            </div>
                            <form id="review-form" method="POST" action="{{route('update.review.details')}}">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="review_id" id="review_id">
                                <div class="row mt-2 mb-4">
                                    <div class="form-group col-lg-4">
                                        <label for="review" class="d-block">
                                            {{__('main.review')}}
                                        </label>
                                        <select required name="review" id="review"
                                                data-title="{{__('main.choose')}}" data-live-search="true"
                                                class="form-control form-control-lg w-100 selectpicker show-tick">
                                            <option value="approved">{{__('main.approve')}}</option>
                                            <option value="declined">{{__('main.decline')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-8">
                                        <label for="notes" class="d-block">
                                            {{__('main.notes')}}
                                        </label>
                                        <textarea name="notes" id="notes" class="form-control"
                                                  style="resize: none; width: 100%; height: 200px;"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{__('main.cancel')}}</button>
                        <button form="review-form" type="submit" class="btn btn-success">
                            {{__('main.update')}}
                        </button>
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

        <div class="modal fade" id="exampleModal60" tabindex="-1" aria-labelledby="exampleModalLabel60"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title w-100" id="exampleModalLabel60">
                            {{__('main.decline_reason')}}
                        </h5>
                        <button type="button" class="btn btn-default btn-md btn-close" data-bs-dismiss="modal">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                    <div class="modal-body text-right">
                        <div class="form-group">
                            <form id="decline-form" method="POST" action="{{route('decline.application')}}">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="application_id" id="application_id_2">
                                <div class="row mt-2 mb-4">
                                    <div class="form-group col-lg-12">
                                        <label for="decline_reason" class="d-block">
                                            {{__('main.decline_reason')}}
                                        </label>
                                        <textarea name="decline_reason" id="decline_reason" class="form-control"
                                        style="resize: none; width: 100%; height: 200px;"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{__('main.cancel')}}</button>
                        <button form="decline-form" type="submit" class="btn btn-success">
                            {{__('main.update')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
<script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {

        $('tfoot').each(function () {
            $(this).insertAfter($(this).siblings('thead'));
        });


        $('.get_reason').on('click', function () {
            var reason = $(this).attr('reason');
            $('#reason').val(reason);
        });
        $('.decline_application').on('click', function () {
            var application_id = $(this).attr('application_id');
            $('#application_id_2').val(application_id);
        });
        $('.get_offer').on('click', function () {
            $('.offer_details').html('');
            var offer_id = $(this).attr('offer_id');
            $.post('{{route('show.offer.details')}}', {
                "_token": "{{ csrf_token() }}", offer_id: offer_id
            }, function (data) {
                $('.offer_details').html(data);
            });
        });

        $('.review_application').on('click', function () {
            $('.review_details').html('');
            var review_id = $(this).attr('review_id');
            var review = $(this).attr('review');
            var notes = $(this).attr('notes');
            $.post('{{route('show.review.details')}}', {
                "_token": "{{ csrf_token() }}", review_id: review_id
            }, function (data) {
                $('.review_details').html(data);
                $('#review').val(review).selectpicker('refresh');
                $('#notes').val(notes);
                $('#review_id').val(review_id);
            });
        });

        $('#check_all').click(function () {
            if (this.checked) {
                $('input.check').prop('checked', true);
            } else {
                $('input.check').prop('checked', false);
            }
        });
        $('.delete_application').on('click', function () {
            var application_id = $(this).attr('application_id');
            var application = $(this).attr('application');
            $('.modal-body #application_id').val(application_id);
            $('.modal-body #application').val(application);
        });
        $('.remove_selected').on('click', function (e) {
            e.preventDefault();
            let applications = [];
            $("input:checkbox[name*='applications']:checked").each(function () {
                applications.push($(this).val());
            });
            if (applications.length == 0) {
                alert('{{__('main.select_records_to_delete')}}');
            } else {
                $('#myForm').submit();
            }
        });
        $('#myTable tfoot tr th:nth-child(2)').html('<input class="form-control form-control-lg" type="text" placeholder="{{__('main.search')}}" />');
        $('#myTable tfoot tr th:nth-child(4)').html('<input class="form-control form-control-lg" type="date" placeholder="{{__('main.search')}}" />');
        $('#myTable tfoot tr th:nth-child(5)').html('<select name="application_type" class="form-control form-control-lg"><option value=""> {{__("main.choose")}} </option><option value="{{__("main.contract_extension")}}">{{__("main.contract_extension")}}</option><option value="{{__("main.new_contract")}}">{{__("main.new_contract")}}</option><option value="{{__("main.contract_renewal")}}">{{__("main.contract_renewal")}}</option><option value="{{__("main.renew_modify")}}">{{__("main.renew_modify")}}</option></select>');

        $('#myTable tfoot tr th:nth-child(6)').html('<select id="dept_id" class="form-control form-control-lg">@foreach($depts as $dept)<option value="@if(App::getLocale() == "ar"){{$dept->dept_name_ar}}@else {{$dept->dept_name_en}} @endif">@if(App::getLocale() == "ar") {{$dept->dept_name_ar}} @else {{$dept->dept_name_en}} @endif</option>@endforeach</select>');
        $('#myTable tfoot tr th:nth-child(7)').html('<select id="project_id" class="form-control form-control-lg">@foreach($projects as $project)<option value="@if(App::getLocale() == "ar"){{$project->project_name_ar}}@else {{$project->project_name_en}} @endif">@if(App::getLocale() == "ar") {{$project->project_name_ar}} @else {{$project->project_name_en}} @endif</option>@endforeach</select>');

        $('#myTable tfoot tr th:nth-child(9)').html('<input class="form-control form-control-lg" type="text" placeholder="{{__('main.search')}}" />');
        $('#myTable tfoot tr th:nth-child(10)').html('<input class="form-control form-control-lg" type="text" placeholder="{{__('main.search')}}" />');
        $('#myTable tfoot tr th:nth-child(11)').html('<input class="form-control form-control-lg" type="date" placeholder="{{__('main.search')}}" />');

        $('#myTable').DataTable({
            "columnDefs": [
                {"orderable": false, "targets": [0, 11]}
            ],
            "paging": false,
            initComplete: function () {
                this.api().columns().every(function () {
                    var that = this;
                    $('input[type="text"],input[type="date"]', this.footer()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                    $('select', this.footer()).on('change', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
            }
        });
    });
</script>
