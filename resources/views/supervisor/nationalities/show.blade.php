@extends('supervisor.layouts.master')
<style>
    i.la {
        font-size: 15px !important;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-3 bg-transparent border-bottom-0">
                    <h6 class="card-title mb-0"><strong>
                            {{__('main.show_nationality')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    <table id="myTable" class="table display dataTable table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center"> {{__('main.nationality')}} {{__('main.arabic')}}</th>
                            <th class="text-center"> {{__('main.nationality')}} {{__('main.english')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-top-0 text-center">
                            <td>{{ $nationality->nationality_ar }}</td>
                            <td>{{ $nationality->nationality_en }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 mt-3 mb-5">
            <div class="card">
                <div class="card-header py-3 bg-transparent border-bottom-0">
                    <h6 class="card-title mb-0"><strong>
                            {{__('main.show_nationality_employees')}}
                        </strong></h6>
                </div>
                @if(!$nationality->employees->isEmpty())
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table display dataTable table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center"> {{__('main.employee_name')}} {{__('main.arabic')}}</th>
                                    <th class="text-center"> {{__('main.employee_name')}} {{__('main.english')}}</th>
                                    <th class="text-center"> {{__('main.phone_number')}}</th>
                                    <th class="text-center"> {{__('main.email')}}</th>
                                    <th class="text-center"> {{__('main.job_title')}}</th>
                                    <th class="text-center"> {{__('main.project_name')}}</th>
                                    <th class="text-center"> {{__('main.dept_name')}} </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($nationality->employees as $employee)
                                    <tr class="border-top-0 text-center">
                                        <td>
                                            <a href="{{route('supervisor.employees.show',$employee->id)}}">
                                                {{ $employee->name_ar }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('supervisor.employees.show',$employee->id)}}">
                                                {{ $employee->name_en }}
                                            </a>
                                        </td>
                                        <td>{{ $employee->phone_number }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>
                                            @if(!empty($employee->job_title_id))
                                                @if(App::getLocale() == "ar")
                                                    <a href="{{route('supervisor.job_titles.show',$employee->job_title->id)}}">
                                                        {{$employee->job_title->job_title_ar}}
                                                    </a>
                                                @else
                                                    <a href="{{route('supervisor.job_titles.show',$employee->job_title->id)}}">
                                                        {{$employee->job_title->job_title_en}}
                                                    </a>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($employee->project_id))
                                                @if(App::getLocale() == "ar")
                                                    <a href="{{route('supervisor.projects.show',$employee->project->id)}}">
                                                        {{$employee->project->project_name_ar}}
                                                    </a>
                                                @else
                                                    <a href="{{route('supervisor.projects.show',$employee->project->id)}}">
                                                        {{$employee->project->project_name_en}}
                                                    </a>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($employee->dept_id))
                                                @if(App::getLocale() == "ar")
                                                    <a href="{{route('supervisor.depts.show',$employee->dept->id)}}">
                                                        {{$employee->dept->dept_name_ar}}
                                                    </a>
                                                @else
                                                    <a href="{{route('supervisor.depts.show',$employee->dept->id)}}">
                                                        {{$employee->dept->dept_name_en}}
                                                    </a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="card-body">
                        <p>
                            @if(App::getLocale() == "ar")
                                لا يوجد موظفين تخص هذه الادارة
                            @else
                                No Employees in this department
                            @endif
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
