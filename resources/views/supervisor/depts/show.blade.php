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
                            {{__('main.show_dept')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    <table id="myTable" class="table display dataTable table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center"> {{__('main.dept_name')}} {{__('main.arabic')}}</th>
                            <th class="text-center"> {{__('main.dept_name')}} {{__('main.english')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-top-0 text-center">
                            <td>{{ $dept->dept_name_ar }}</td>
                            <td>{{ $dept->dept_name_en }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header py-3 bg-transparent border-bottom-0">
                    <h6 class="card-title mb-0"><strong>
                            {{__('main.show_dept_projects')}}
                        </strong></h6>
                </div>
                @if(!$dept->projects->isEmpty())
                    <div class="card-body">
                        <table id="myTable" class="table display dataTable table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center"> {{__('main.project_name')}} {{__('main.arabic')}}</th>
                                <th class="text-center"> {{__('main.project_name')}} {{__('main.english')}}</th>
                                <th class="text-center"> {{__('main.added_date')}}</th>
                                <th class="text-center"> {{__('main.project_end_date')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dept->projects as $project)
                                <tr class="border-top-0 text-center">
                                    <td>
                                        <a href="{{route('supervisor.projects.show',$project->id)}}">
                                            {{ $project->project_name_ar }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('supervisor.projects.show',$project->id)}}">
                                            {{ $project->project_name_en }}
                                        </a>
                                    </td>
                                    <td>{{ $project->added_date }}</td>
                                    <td>{{ $project->project_end_date }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="card-body">
                        <p>
                            @if(App::getLocale() == "ar")
                                لا يوجد مشاريع تخص هذه الادارة
                            @else
                                No Projects in this department
                            @endif
                        </p>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-12 mt-3 mb-5">
            <div class="card">
                <div class="card-header py-3 bg-transparent border-bottom-0">
                    <h6 class="card-title mb-0"><strong>
                            {{__('main.show_dept_admins')}}
                        </strong></h6>
                </div>
                @if(!$dept->supervisors->isEmpty())
                    <div class="card-body">
                        <table id="myTable" class="table display dataTable table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center"> {{__('main.supervisor_name')}} {{__('main.arabic')}}</th>
                                <th class="text-center"> {{__('main.supervisor_name')}} {{__('main.english')}}</th>
                                <th class="text-center"> {{__('main.phone_number')}}</th>
                                <th class="text-center"> {{__('main.email')}}</th>
                                <th class="text-center"> {{__('main.privilege')}}</th>
                                <th class="text-center"> {{__('main.job_title')}} </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dept->supervisors as $supervisor)
                                <tr class="border-top-0 text-center">
                                    <td>
                                        <a href="{{route('supervisor.supervisors.show',$supervisor->id)}}">
                                            {{ $supervisor->supervisor_name_ar }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('supervisor.supervisors.show',$supervisor->id)}}">
                                            {{ $supervisor->supervisor_name_en }}
                                        </a>
                                    </td>
                                    <td>{{ $supervisor->phone_number }}</td>
                                    <td>{{ $supervisor->email }}</td>
                                    <td>
                                        {{$supervisor->role_name}}
                                    </td>
                                    <td>
                                        @if(!empty($supervisor->job_title_id))
                                            @if(App::getLocale() == "ar")
                                                <a href="{{route('supervisor.job_titles.show',$supervisor->job_title->id)}}">
                                                    {{$supervisor->job_title->job_title_ar}}
                                                </a>
                                            @else
                                                <a href="{{route('supervisor.job_titles.show',$supervisor->job_title->id)}}">
                                                    {{$supervisor->job_title->job_title_en}}
                                                </a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="card-body">
                        <p>
                            @if(App::getLocale() == "ar")
                                لا يوجد مدراء تخص هذه الادارة
                            @else
                                No Admins in this department
                            @endif
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-12 mt-3 mb-5">
            <div class="card">
                <div class="card-header py-3 bg-transparent border-bottom-0">
                    <h6 class="card-title mb-0"><strong>
                            {{__('main.show_dept_employees')}}
                        </strong></h6>
                </div>
                @if(!$dept->employees->isEmpty())
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table display dataTable table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center"> {{__('main.employee_name')}} {{__('main.arabic')}}</th>
                                    <th class="text-center"> {{__('main.employee_name')}} {{__('main.english')}}</th>
                                    <th class="text-center"> {{__('main.phone_number')}}</th>
                                    <th class="text-center"> {{__('main.email')}}</th>
                                    <th class="text-center"> {{__('main.nationality')}}</th>
                                    <th class="text-center"> {{__('main.project_name')}}</th>
                                    <th class="text-center"> {{__('main.job_title')}} </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dept->employees as $employee)
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
                                            @if(!empty($employee->nationality_id))
                                                @if(App::getLocale() == "ar")
                                                    <a href="{{route('supervisor.nationalities.show',$employee->nationality->id)}}">
                                                        {{$employee->nationality->nationality_ar}}
                                                    </a>
                                                @else
                                                    <a href="{{route('supervisor.nationalities.show',$employee->nationality->id)}}">
                                                        {{$employee->nationality->nationality_en}}
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
