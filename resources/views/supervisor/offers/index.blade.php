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
                        <strong> {{__('main.show_all_offers')}} </strong>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row mt-1 mb-1 text-center justify-content-center align-content-center">
                        <form class="col-6" method="GET" action="{{route('print.selected.offers')}}">
                            <button type="submit" class="btn btn-md btn-light-warning m-1 print_selected">
                                <i class="fa fa-print"></i>
                                {{__('main.print')}}
                            </button>
                        </form>
                        <form class="col-6" method="POST" action="{{route('export.offers.excel')}}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-md btn-light-success m-1">
                                <i class="fa fa-file-excel-o"></i>
                                {{__('main.export')}} EXCEL
                            </button>
                        </form>

                        <form class="col-6" method="POST" id="myForm" action="{{route('remove.selected.offers')}}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-md btn-light-danger m-1 remove_selected">
                                <i class="fa fa-trash"></i>
                                {{__('main.delete')}}
                            </button>
                        </form>
                        <div class="col-6">
                            <a href="{{route('supervisor.offers.create')}}" role="button"
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
{{--                                <th class="border-bottom-0 text-center">--}}
{{--                                    {{__('main.housing_allowance')}}--}}
{{--                                </th>--}}
{{--                                <th class="border-bottom-0 text-center">--}}
{{--                                    {{__('main.transport_allowance')}}--}}
{{--                                </th>--}}
{{--                                <th class="border-bottom-0 text-center">--}}
{{--                                    {{__('main.another_allowance')}}--}}
{{--                                </th>--}}
                                <th class="border-bottom-0 text-center">
                                    {{__('main.total_salary')}}
                                </th>
{{--                                <th class="border-bottom-0 text-center">--}}
{{--                                    {{__('main.weekend_vacation')}}--}}
{{--                                </th>--}}
{{--                                <th class="border-bottom-0 text-center">--}}
{{--                                    {{__('main.yearly_vacation')}}--}}
{{--                                </th>--}}
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
                                <th style="width: 5%!important;" class="border-bottom-0 text-center">
                                    {{__('main.control')}}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $key => $offer)
                                <tr>
                                    <td>
                                        <input class="check" name="offers[]" form="myForm"
                                               value="{{$offer->id}}"
                                               type="checkbox">
                                    </td>
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
                                    <td>{{$offer->basic_salary}}</td>
{{--                                    <td>{{$offer->housing_allowance}}</td>--}}
{{--                                    <td>{{$offer->transport_allowance}}</td>--}}
{{--                                    <td>{{$offer->another_allowance}}</td>--}}
                                    <td>{{$offer->total_salary}}</td>
{{--                                    <td>{{$offer->weekend_vacation}}</td>--}}
{{--                                    <td>{{$offer->yearly_vacation}}</td>--}}
                                    <td>{{$offer->contract_period}}</td>
                                    <td>
                                        @if($offer->expired_at > date('Y-m-d H:i:s'))
                                            <span class="badge badge-md badge-success">
                                                {{$offer->expired_at}}
                                            </span>
                                        @else
                                            <span class="badge badge-md badge-danger">
                                                {{$offer->expired_at}}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($offer->employee_response == "waiting")
                                            <span class="badge badge-md badge-warning">
                                                {{__('main.'.$offer->employee_response.'')}}
                                            </span>
                                        @elseif($offer->employee_response == "approved")
                                            <span class="badge badge-md badge-success">
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
                                    <td>
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                id="dropdownMenuButton"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-wrench"></i>
                                            {{__('main.control')}}
                                        </button>
                                        <ul class="dropdown-menu border-0 shadow p-3">
                                            @can('عرض عرض وظيفي')
                                                <li>
                                                    <a href="{{ route('supervisor.offers.show', $offer->id) }}"
                                                       class="dropdown-item py-2 rounded">
                                                        <i class="fa fa-eye"></i>
                                                        {{__('main.show')}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('send.offer.sms',$offer->id)}}"
                                                       class="dropdown-item py-2 rounded">
                                                        <i class="fa fa-paper-plane-o"></i>
                                                        {{__('main.send')}}
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('تعديل عرض وظيفي')
                                                <li>
                                                    <a href="{{ route('supervisor.offers.edit', $offer->id) }}"
                                                       class="dropdown-item py-2 rounded">
                                                        <i class="fa fa-edit"></i>
                                                        {{__('main.edit')}}
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('حذف عرض وظيفي')
                                                <li>
                                                    <a class="dropdown-item py-2 rounded delete_offer"
                                                       offer_id="{{ $offer->id }}"
                                                       offer="{{ $offer->employee_name }}"
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
{{--                                <th></th>--}}
{{--                                <th></th>--}}
{{--                                <th></th>--}}
{{--                                <th></th>--}}
{{--                                <th></th>--}}
{{--                                <th></th>--}}
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
                            {{__('main.delete_offer')}}
                        </h5>
                        <button type="button" class="btn btn-default btn-md btn-close" data-bs-dismiss="modal">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                    <div class="modal-body text-right">
                        <form action="{{ route('supervisor.offers.destroy', 'test') }}" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <p>{{__('main.sure_delete')}}</p>
                                <input type="hidden" name="offer_id" id="offer_id" value="">
                                <input class="form-control form-control-lg" name="offer" id="offer"
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
        $('#check_all').click(function () {
            if (this.checked) {
                $('input.check').prop('checked', true);
            } else {
                $('input.check').prop('checked', false);
            }
        });
        $('.delete_offer').on('click', function () {
            var offer_id = $(this).attr('offer_id');
            var offer = $(this).attr('offer');
            $('.modal-body #offer_id').val(offer_id);
            $('.modal-body #offer').val(offer);
        });
        $('.remove_selected').on('click', function (e) {
            e.preventDefault();
            let offers = [];
            $("input:checkbox[name*='offers']:checked").each(function () {
                offers.push($(this).val());
            });
            if (offers.length == 0) {
                alert('{{__('main.select_records_to_delete')}}');
            } else {
                $('#myForm').submit();
            }
        });
        $('#myTable tfoot tr th:nth-child(2)').html('<input class="form-control form-control-lg" type="text" placeholder="{{__('main.search')}}" />');
        $('#myTable tfoot tr th:nth-child(3)').html('<input class="form-control form-control-lg" type="text" placeholder="{{__('main.search')}}" />');
        $('#myTable tfoot tr th:nth-child(4)').html('<select id="nationality_id" class="form-control form-control-lg">@foreach($nationalities as $nationality)<option value="@if(App::getLocale() == "ar"){{$nationality->nationality_ar}}@else {{$nationality->nationality_en}} @endif">@if(App::getLocale() == "ar") {{$nationality->nationality_ar}} @else {{$nationality->nationality_en}} @endif</option>@endforeach</select>');
        $('#myTable tfoot tr th:nth-child(5)').html('<select id="job_title_id" class="form-control form-control-lg">@foreach($job_titles as $job_title)<option value="@if(App::getLocale() == "ar"){{$job_title->job_title_ar}}@else {{$job_title->job_title_en}} @endif">@if(App::getLocale() == "ar") {{$job_title->job_title_ar}} @else {{$job_title->job_title_en}} @endif</option>@endforeach</select>');
        $('#myTable tfoot tr th:nth-child(6)').html('<input class="form-control form-control-lg" type="text" placeholder="{{__('main.search')}}" />');
        {{--$('#myTable tfoot tr th:nth-child(7)').html('<input class="form-control form-control-lg" type="text" placeholder="{{__('main.search')}}" />');--}}
        {{--$('#myTable tfoot tr th:nth-child(8)').html('<input class="form-control form-control-lg" type="text" placeholder="{{__('main.search')}}" />');--}}
        {{--$('#myTable tfoot tr th:nth-child(9)').html('<input class="form-control form-control-lg" type="text" placeholder="{{__('main.search')}}" />');--}}
        $('#myTable tfoot tr th:nth-child(7)').html('<input class="form-control form-control-lg" type="text" placeholder="{{__('main.search')}}" />');
        {{--$('#myTable tfoot tr th:nth-child(11)').html('<input class="form-control form-control-lg" type="text" placeholder="{{__('main.search')}}" />');--}}
        {{--$('#myTable tfoot tr th:nth-child(12)').html('<input class="form-control form-control-lg" type="text" placeholder="{{__('main.search')}}" />');--}}
        $('#myTable tfoot tr th:nth-child(8)').html('<input class="form-control form-control-lg" type="text" placeholder="{{__('main.search')}}" />');
        $('#myTable tfoot tr th:nth-child(10)').html('<select name="employee_response" class="form-control form-control-lg"><option value=""> {{__("main.choose")}} </option><option value="{{__("main.waiting")}}">{{__("main.waiting")}}</option><option value="{{__("main.approved")}}">{{__("main.approved")}}</option><option value="{{__("main.declined")}}">{{__("main.declined")}}</option></select>');

        $('#myTable').DataTable({
            "columnDefs": [
                {"orderable": false, "targets": [0, 10]}
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
