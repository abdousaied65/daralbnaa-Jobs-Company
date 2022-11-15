@extends('employee.layouts.master')
<link rel="stylesheet" href="{{asset('admin-assets/css/bootstrap.min.css')}}">
<style>

</style>
@section('content')
    <div class="row">
        <div class="col-12 mt-1 mb-5">
            <div class="card">
                <div class="card-header py-3 bg-transparent border-bottom-0">
                    <h6 class="card-title mb-0"><strong>
                            {{__('main.personal_data')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-3">
                        <table id="myTable" class="table display dataTable table-bordered">
                            <tbody>
                            <tr>
                                <td class="text-center">
                                    {{__('main.employee_name')}}
                                </td>
                                <td>
                                    @if(App::getLocale() == "ar")
                                        {{$employee->name_ar}}
                                    @else
                                        {{$employee->name_en}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.email')}}
                                </td>
                                <td>{{ $employee->email }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.phone_number')}}
                                </td>
                                <td>{{ $employee->phone_number }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.identity_residency_number')}}
                                </td>
                                <td>{{ $employee->identity_number }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.passport_number')}}
                                </td>
                                <td>{{ $employee->passport_number }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.job_number')}}
                                </td>
                                <td>{{ $employee->job_number }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.contract_period')}}
                                </td>
                                <td>{{ $employee->contract_period }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.dept_name')}}
                                </td>
                                <td>
                                    @if(!empty($employee->dept_id))
                                        @if(App::getLocale() == "ar")
                                            {{ $employee->dept->dept_name_ar }}
                                        @else
                                            {{ $employee->dept->dept_name_en }}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.project_name')}}
                                </td>
                                <td>
                                    @if(!empty($employee->project_id))
                                        @if(App::getLocale() == "ar")
                                            {{ $employee->project->project_name_ar }}
                                        @else
                                            {{ $employee->project->project_name_en }}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.job_title')}}
                                </td>
                                <td>
                                    @if(!empty($employee->job_title_id))
                                        @if(App::getLocale() == "ar")
                                            {{ $employee->job_title->job_title_ar }}
                                        @else
                                            {{ $employee->job_title->job_title_en }}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.nationality')}}
                                </td>
                                <td>
                                    @if(!empty($employee->nationality_id))
                                        @if(App::getLocale() == "ar")
                                            {{ $employee->nationality->nationality_ar }}
                                        @else
                                            {{ $employee->nationality->nationality_en }}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.total_salary')}}
                                </td>
                                <td>{{$employee->total_salary}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.weekend_vacation')}}
                                </td>
                                <td>{{$employee->weekend_vacation}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.yearly_vacation')}}
                                </td>
                                <td>{{$employee->yearly_vacation}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{__('main.created_at')}}
                                </td>
                                <td>{{$employee->created_at}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
@endsection

