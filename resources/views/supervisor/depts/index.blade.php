@extends('supervisor.layouts.master')
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
                        <strong> {{__('main.show_all_depts')}} </strong>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row mt-1 mb-1 text-center justify-content-center align-content-center">
                        <form class="col-6" method="GET" action="{{route('print.selected.depts')}}">
                            <button type="submit" class="btn btn-md btn-light-warning m-1 print_selected">
                                <i class="fa fa-print"></i>
                                {{__('main.print')}}
                            </button>
                        </form>
                        <form class="col-6" method="POST" action="{{route('export.depts.excel')}}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-md btn-light-success m-1">
                                <i class="fa fa-file-excel-o"></i>
                                {{__('main.export')}} EXCEL
                            </button>
                        </form>

                        <form class="col-6" method="POST" id="myForm" action="{{route('remove.selected.depts')}}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-md btn-light-danger m-1 remove_selected">
                                <i class="fa fa-trash"></i>
                                {{__('main.delete')}}
                            </button>
                        </form>
                        <div class="col-6">
                            <a href="{{route('supervisor.depts.create')}}" role="button"
                               class="btn btn-md btn-light-info">
                                <i class="fa fa-plus"></i>
                                {{__('main.add')}}
                            </a>
                        </div>
                    </div>
                    <table id="myTable"
                           class="table table-bordered table-condensed text-center justify-content-center w-100 display dataTable">
                        <thead>
                        <tr>
                            <th class="border-bottom-0 text-center">
                                <input type="checkbox" id="check_all"/>
                            </th>
                            <th class="border-bottom-0 text-center">
                                {{__('main.dept_name')}} {{__('main.arabic')}}
                            </th>
                            <th class="border-bottom-0 text-center">
                                {{__('main.dept_name')}} {{__('main.english')}}
                            </th>
                            <th style="width: 5%!important;" class="border-bottom-0 text-center">
                                {{__('main.control')}}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $key => $dept)
                            <tr>
                                <td>
                                    <input class="check" name="depts[]" form="myForm"
                                           value="{{$dept->id}}"
                                           type="checkbox">
                                </td>
                                <td>{{ $dept->dept_name_ar }}</td>
                                <td>{{ $dept->dept_name_en }}</td>
                                <td>
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-wrench"></i>
                                        {{__('main.control')}}
                                    </button>
                                    <ul class="dropdown-menu border-0 shadow p-3">
                                        @can('عرض ادارة')
                                            <li>
                                                <a href="{{ route('supervisor.depts.show', $dept->id) }}"
                                                   class="dropdown-item py-2 rounded">
                                                    <i class="fa fa-eye"></i>
                                                    {{__('main.show')}}
                                                </a>
                                            </li>
                                        @endcan
                                        @can('تعديل ادارة')
                                            <li>
                                                <a href="{{ route('supervisor.depts.edit', $dept->id) }}"
                                                   class="dropdown-item py-2 rounded">
                                                    <i class="fa fa-edit"></i>
                                                    {{__('main.edit')}}
                                                </a>
                                            </li>
                                        @endcan
                                        @can('حذف ادارة')
                                            <li>
                                                <a class="dropdown-item py-2 rounded delete_dept"
                                                   dept_id="{{ $dept->id }}"
                                                   dept="{{ $dept->dept_name_ar }} - {{ $dept->dept_name_en }}"
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
                        </tr>
                        </tfoot>
                    </table>
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
                            {{__('main.delete_dept')}}
                        </h5>
                        <button type="button" class="btn btn-default btn-md btn-close" data-bs-dismiss="modal">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                    <div class="modal-body text-right">
                        <form action="{{ route('supervisor.depts.destroy', 'test') }}" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <p>{{__('main.sure_delete')}}</p>
                                <input type="hidden" name="dept_id" id="dept_id" value="">
                                <input class="form-control form-control-lg" name="dept" id="dept" type="text" readonly>
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


    </div>
@endsection
<script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {

        $('tfoot').each(function () {
            $(this).insertAfter($(this).siblings('thead'));
        });


        $('#check_all').click(function () {
            if (this.checked) {
                $('input.check').prop('checked', true);
            } else {
                $('input.check').prop('checked', false);
            }
        });
        $('.delete_dept').on('click', function () {
            var dept_id = $(this).attr('dept_id');
            var dept = $(this).attr('dept');
            $('.modal-body #dept_id').val(dept_id);
            $('.modal-body #dept').val(dept);
        });
        $('.remove_selected').on('click', function (e) {
            e.preventDefault();
            let depts = [];
            $("input:checkbox[name*='depts']:checked").each(function () {
                depts.push($(this).val());
            });
            if (depts.length == 0) {
                alert('{{__('main.select_records_to_delete')}}');
            } else {
                $('#myForm').submit();
            }
        });
        $('#myTable tfoot tr th:nth-child(2)').html('<input class="form-control form-control-lg" type="text" placeholder="{{__('main.search')}}" />');
        $('#myTable tfoot tr th:nth-child(3)').html('<input class="form-control form-control-lg" type="text" placeholder="{{__('main.search')}}" />');

        $('#myTable').DataTable({
            "columnDefs": [
                {"orderable": false, "targets": [0, 3]}
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
