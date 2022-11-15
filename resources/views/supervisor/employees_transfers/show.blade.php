@extends('supervisor.layouts.master')
<link rel="stylesheet" href="{{asset('admin-assets/css/bootstrap.min.css')}}">
<style>
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
                            {{__('main.show_employee_transfer')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-hover">
                        <table id="myTable" class="table display dataTable table-bordered">
                            <thead>
                            <tr>

                                <th class="border-bottom-0 text-center">
                                    {{__('main.employee_name')}}
                                </th>

                                <th class="border-bottom-0 text-center">
                                    {{__('main.old_dept')}}
                                </th>

                                <th class="border-bottom-0 text-center">
                                    {{__('main.old_project')}}
                                </th>

                                <th class="border-bottom-0 text-center">
                                    {{__('main.new_dept')}}
                                </th>

                                <th class="border-bottom-0 text-center">
                                    {{__('main.new_project')}}
                                </th>

                                <th class="border-bottom-0 text-center">
                                    {{__('main.date')}}
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
                                    @if(App::getLocale() == "ar")
                                        {{ $employee_transfer->employee->name_ar }}
                                    @else
                                        {{ $employee_transfer->employee->name_en }}
                                    @endif
                                </td>
                                <td>
                                    @if(App::getLocale() == "ar")
                                        {{ $employee_transfer->old_dept->dept_name_ar }}
                                    @else
                                        {{ $employee_transfer->old_dept->dept_name_en }}
                                    @endif
                                </td>
                                <td>
                                    @if(App::getLocale() == "ar")
                                        {{ $employee_transfer->old_project->project_name_ar }}
                                    @else
                                        {{ $employee_transfer->old_project->project_name_en }}
                                    @endif
                                </td>
                                <td>
                                    @if(App::getLocale() == "ar")
                                        {{ $employee_transfer->new_dept->dept_name_ar }}
                                    @else
                                        {{ $employee_transfer->new_dept->dept_name_en }}
                                    @endif
                                </td>
                                <td>
                                    @if(App::getLocale() == "ar")
                                        {{ $employee_transfer->new_project->project_name_ar }}
                                    @else
                                        {{ $employee_transfer->new_project->project_name_en }}
                                    @endif
                                </td>
                                <td>{{$employee_transfer->date}}</td>
                                <td>{{$employee_transfer->notes}}</td>
                                <td>
                                    @if($employee_transfer->status == "waiting" || $employee_transfer->status == "pending")
                                        <span class="badge badge-md badge-warning">
                                                {{__('main.'.$employee_transfer->status.'')}}
                                            </span>
                                    @elseif($employee_transfer->status == "approved")
                                        <span class="badge badge-md badge-success">
                                                {{__('main.'.$employee_transfer->status.'')}}
                                            </span>
                                    @elseif($employee_transfer->status == "expired" || $employee_transfer->status == "declined" )
                                        <span class="badge badge-md badge-danger">
                                                {{__('main.'.$employee_transfer->status.'')}}
                                            </span>
                                    @endif
                                </td>
                                <td>{{$employee_transfer->created_at}}</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
