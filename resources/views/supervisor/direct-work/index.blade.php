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
                        <strong>
                            {{__('main.show_all_directWork')}}
                        </strong>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row mt-1 mb-1 text-center justify-content-center align-content-center">
                        <form class="col-6" method="GET" action="{{route('print.selected.direct-work')}}">
                            <button type="submit" class="btn btn-md btn-light-warning m-1 print_selected">
                                <i class="fa fa-print"></i>
                                {{__('main.print')}}
                            </button>
                        </form>
                        <form class="col-6" method="POST" action="{{route('export.direct-work.excel')}}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-md btn-light-success m-1">
                                <i class="fa fa-file-excel-o"></i>
                                {{__('main.export')}} EXCEL
                            </button>
                        </form>
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
                                    {{__('main.date')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.project_name')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.supervisor')}}
                                </th>
                                <th class="border-bottom-0 text-center">
                                    {{__('main.status')}}
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
                                    <td>{{ $application->offer->employee_name??'' }}</td>
                                    <td>{{ $application->offer->phone_number ??'' }}</td>
                                    <td>{{ $application->date }}</td>
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
                                        @if(!empty($application->project_id))
                                            @if(App::getLocale() == "ar")
                                               @php $manager= $application->project->supervisors()->latest('id')->first() @endphp
                                                {{ isset($manager) ? $manager->supervisor_name_ar : ''}}
                                            @else
                                                {{ isset($manager) ? $manager->supervisor_name_en : ''}}
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if(is_null($application->direct_work_status))
                                            <a style="cursor: pointer" data-id="{{$application->id}}" data-status="1"
                                               class="text-success direct_work_status "
                                               data-url="{{ route('approve.direct-work', $application->id) }}"><i
                                                    class="fa fa-check"></i></a>
                                            <a style="cursor: pointer" data-id="{{$application->id}}" data-status="0"
                                               class="text-danger direct_work_status"
                                               data-url="{{ route('disapprove.direct-work', $application->id) }}"><i
                                                    class="fa fa-close"></i></a>
                                        @else
                                            @if($application->direct_work_status == 1)
                                                {{__('main.directwork')}}
                                            @elseif($application->direct_work_status == 0)
                                                {{__('main.notWork')}}
                                            @endif
                                        @endif

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

        $('#myTable tfoot tr th:nth-child(3)').html('<input class="form-control form-control-lg" type="text" placeholder="{{__('main.search')}}" />');
        $('#myTable tfoot tr th:nth-child(4)').html('<input class="form-control form-control-lg" type="date" placeholder="{{__('main.search')}}" />');
        $('#myTable').DataTable({
            "columnDefs": [
                {"orderable": false, "targets": [0, 5]}
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
                });
            }
        });

        $('.direct_work_status').click(function () {
            let id = $(this).data('id');
            let status = $(this).data('status');
            let url = $(this).data("url");

            $.ajax({
                url: url,
                type: "GET",
                dataType: "JSON",
                data: {
                    "_token": "{{ csrf_token() }}",
                    status: status,
                    id: id
                },
                success: function (response) {
                    location.reload()
                }
            });

        })

    });
</script>
