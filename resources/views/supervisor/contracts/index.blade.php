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
                        <strong> {{__('main.show_all_contracts')}} </strong>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row mt-1 mb-1 text-center justify-content-center align-content-center">
                        <form class="col-6" method="GET" action="{{route('print.selected.contracts')}}">
                            <button type="submit" class="btn btn-md btn-light-warning m-1 print_selected">
                                <i class="fa fa-print"></i>
                                {{__('main.print')}}
                            </button>
                        </form>
                        <form class="col-6" method="POST" action="{{route('export.contracts.excel')}}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-md btn-light-success m-1">
                                <i class="fa fa-file-excel-o"></i>
                                {{__('main.export')}} EXCEL
                            </button>
                        </form>

                        <form class="col-6" method="POST" id="myForm"
                              action="{{route('remove.selected.contracts')}}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-md btn-light-danger m-1 remove_selected">
                                <i class="fa fa-trash"></i>
                                {{__('main.delete')}}
                            </button>
                        </form>
                        <div class="col-6">

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
                                    {{__('main.phone_number')}}
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
                                <th style="width: 5%!important;" class="border-bottom-0 text-center">
                                    {{__('main.control')}}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $key => $contract)
                                <tr>
                                    <td>
                                        <input class="check" name="contracts[]" form="myForm"
                                               value="{{$contract->id}}"
                                               type="checkbox">
                                    </td>
                                    <td>
                                        <a data-bs-toggle="modal" href="javascript:;" class="get_application"
                                           data-bs-target="#exampleModal30"
                                           application_id="{{$contract->application->id}}">
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

                                    <td>{{$contract->phone_number}}</td>

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

                                    <td>{{$contract->total_salary}}</td>
                                    <td><img src="{{asset($contract->employee_signature)}}"
                                             style="width:60px; height: 60px;border: 1px solid #000; padding:3px; border-radius: 100%;"
                                             alt=""></td>
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
                                    <td>
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                id="dropdownMenuButton"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-wrench"></i>
                                            {{__('main.control')}}
                                        </button>
                                        <ul class="dropdown-menu border-0 shadow p-3">
                                            @can('عرض عقد عمل')
                                                <li>
                                                    <a href="{{ route('supervisor.contracts.show', $contract->id) }}"
                                                       class="dropdown-item py-2 rounded">
                                                        <i class="fa fa-eye"></i>
                                                        {{__('main.show')}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a target="_blank"
                                                       href="{{ route('contract.print', $contract->id) }}"
                                                       class="dropdown-item py-2 rounded text-primary">
                                                        <i class="fa fa-print"></i>
                                                        {{__('main.print')}}
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{ route('send.contract.sms',$contract->id)}}"
                                                       class="dropdown-item py-2 rounded">
                                                        <i class="fa fa-paper-plane-o"></i>
                                                        {{__('main.send')}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('contract.approved',$contract->id)}}"
                                                       class="dropdown-item py-2 rounded text-success">
                                                        <i class="fa fa-check"></i>
                                                        {{__('main.approve_contract')}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('contract.declined',$contract->id)}}"
                                                       class="dropdown-item py-2 rounded text-danger">
                                                        <i class="fa fa-close"></i>
                                                        {{__('main.decline_contract')}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('contract.expired',$contract->id)}}"
                                                       class="dropdown-item py-2 rounded text-warning">
                                                        <i class="fa fa-hourglass-end"></i>
                                                        {{__('main.expire_contract')}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('contract.pending',$contract->id)}}"
                                                       class="dropdown-item py-2 rounded text-info">
                                                        <i class="fa fa-clock-o"></i>
                                                        {{__('main.pend_contract')}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item py-2 rounded renew text-dark"
                                                       contract_id="{{ $contract->id }}"
                                                       data-bs-toggle="modal" href="javascript:;"
                                                       data-bs-target="#exampleModal40">
                                                        <i class="fa fa-recycle"></i>
                                                        {{__('main.renew')}}
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('تعديل عقد عمل')
                                                <li>
                                                    <a href="{{ route('supervisor.contracts.edit', $contract->id) }}"
                                                       class="dropdown-item py-2 rounded">
                                                        <i class="fa fa-edit"></i>
                                                        {{__('main.edit')}}
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('حذف عقد عمل')
                                                <li>
                                                    <a class="dropdown-item py-2 rounded delete_contract"
                                                       contract_id="{{ $contract->id }}"
                                                       contract="{{ $contract->employee_name }}"
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
                            {{__('main.delete_contract')}}
                        </h5>
                        <button type="button" class="btn btn-default btn-md btn-close" data-bs-dismiss="modal">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                    <div class="modal-body text-right">
                        <form action="{{ route('supervisor.contracts.destroy', 'test') }}" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <p>{{__('main.sure_delete')}}</p>
                                <input type="hidden" name="contract_id" id="contract_id" value="">
                                <input class="form-control form-control-lg" name="contract" id="contract"
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
                            {{__('main.renew_contract')}}
                        </h5>
                        <button type="button" class="btn btn-default btn-md btn-close" data-bs-dismiss="modal">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                    <div class="modal-body text-right">
                        <form action="{{route('contract.renew')}}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="contract_id" id="contract_id_2" />
                            <div class="row mt-1 mb-3">
                                <div class="form-group col-lg-4 col-sm-6">
                                    <label class="d-block" for="reason">
                                        {{__('main.renewal_period')}}
                                    </label>
                                    <input required type="number" min="1" max="10" class="form-control form-control-lg"
                                           name="period"/>
                                </div>
                                <div class="form-group col-lg-4 col-sm-6">
                                    <label class="d-block" for="reason">
                                        {{__('main.start_date')}}
                                    </label>
                                    <input required value="{{date('Y-m-d')}}" type="date"
                                           class="form-control form-control-lg" name="start_date"/>
                                </div>
                                <div class="form-group col-lg-4 col-sm-6">
                                    <label class="d-block" for="reason">
                                        {{__('main.notes')}}
                                    </label>
                                    <input type="text" class="form-control form-control-lg"
                                           name="notes"/>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-md btn-success">
                                <i class="fa fa-recycle"></i>
                                {{__('main.renew')}}
                            </button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="{{route('supervisor.home')}}" data-bs-dismiss="modal"
                           class="btn btn-md btn-outline-secondary">{{__('main.cancel')}}</a>
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


        $('.renew').on('click',function () {
            let contract_id = $(this).attr('contract_id');
            $('#contract_id_2').val(contract_id);
        });

        $('.get_application').on('click', function () {
            $('.application_details').html('');
            var application_id = $(this).attr('application_id');
            $.post('{{route('show.application.details')}}', {
                "_token": "{{ csrf_token() }}", application_id: application_id
            }, function (data) {
                $('.application_details').html(data);
            });
        });
        $('#check_all').click(function () {
            if (this.checked) {
                $('input.check').prop('checked', true);
            } else {
                $('input.check').prop('checked', false);
            }
        });
        $('.delete_contract').on('click', function () {
            var contract_id = $(this).attr('contract_id');
            var contract = $(this).attr('contract');
            $('.modal-body #contract_id').val(contract_id);
            $('.modal-body #contract').val(contract);
        });
        $('.remove_selected').on('click', function (e) {
            e.preventDefault();
            let contracts = [];
            $("input:checkbox[name*='contracts']:checked").each(function () {
                contracts.push($(this).val());
            });
            if (contracts.length == 0) {
                alert('{{__('main.select_records_to_delete')}}');
            } else {
                $('#myForm').submit();
            }
        });
        $('#myTable tfoot tr th:nth-child(3)').html('<input class="form-control form-control-lg" type="text" placeholder="{{__('main.search')}}" />');
        $('#myTable tfoot tr th:nth-child(4)').html('<input class="form-control form-control-lg" type="text" placeholder="{{__('main.search')}}" />');
        $('#myTable tfoot tr th:nth-child(5)').html('<select id="nationality_id" class="form-control form-control-lg">@foreach($nationalities as $nationality)<option value="@if(App::getLocale() == "ar"){{$nationality->nationality_ar}}@else {{$nationality->nationality_en}} @endif">@if(App::getLocale() == "ar") {{$nationality->nationality_ar}} @else {{$nationality->nationality_en}} @endif</option>@endforeach</select>');
        $('#myTable tfoot tr th:nth-child(6)').html('<input class="form-control form-control-lg" type="text" placeholder="{{__('main.search')}}" />');
        $('#myTable tfoot tr th:nth-child(7)').html('<select id="job_title_id" class="form-control form-control-lg">@foreach($job_titles as $job_title)<option value="@if(App::getLocale() == "ar"){{$job_title->job_title_ar}}@else {{$job_title->job_title_en}} @endif">@if(App::getLocale() == "ar") {{$job_title->job_title_ar}} @else {{$job_title->job_title_en}} @endif</option>@endforeach</select>');
        $('#myTable tfoot tr th:nth-child(8)').html('<input class="form-control form-control-lg" type="text" placeholder="{{__('main.search')}}" />');
        $('#myTable tfoot tr th:nth-child(9)').html('<input class="form-control form-control-lg" type="date" placeholder="{{__('main.search')}}" />');
        $('#myTable tfoot tr th:nth-child(10)').html('<input class="form-control form-control-lg" type="date" placeholder="{{__('main.search')}}" />');
        $('#myTable tfoot tr th:nth-child(11)').html('<input class="form-control form-control-lg" type="text" placeholder="{{__('main.search')}}" />');

        $('#myTable').DataTable({
            "columnDefs": [
                {"orderable": false, "targets": [0,1,11,12,13,14,15]}
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
