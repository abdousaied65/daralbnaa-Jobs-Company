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
                            {{__('main.show_employee')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    <table id="myTable" class="table display dataTable table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center"> {{__('main.employee_name')}} {{__('main.arabic')}}</th>
                            <th class="text-center"> {{__('main.employee_name')}} {{__('main.english')}}</th>
                            <th class="text-center">
                                {{__('main.email')}}
                            </th>
                            <th class="text-center">
                                {{__('main.phone_number')}}
                            </th>
                            <th class="text-center">
                                {{__('main.job_number')}}
                            </th>

                            <th class="text-center">
                                {{__('main.dept_name')}}
                            </th>
                            <th class="text-center">
                                {{__('main.job_title')}}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-top-0 text-center">
                            <td>{{ $employee->name_ar }}</td>
                            <td>{{ $employee->name_en }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone_number }}</td>
                            <td>{{ $employee->job_number }}</td>
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
                        </tbody>
                    </table>
                    <div class="clearfix"></div>
                    <table id="myTable" class="table display dataTable table-bordered"
                           style="margin-top: 20px!important;">
                        <thead>
                        <tr>
                            <th class="text-center">
                                {{__('main.project_name')}}
                            </th>
                            <th class="text-center">
                                {{__('main.nationality')}}
                            </th>
                            <th class="text-center">
                                {{__('main.identity_residency_number')}}
                            </th>
                            <th class="text-center">
                                {{__('main.passport_number')}}
                            </th>
                            <th class="text-center">
                                {{__('main.contract_period')}}
                            </th>
                            <th class="text-center">
                                {{__('main.total_salary')}}
                            </th>
                            <th class="text-center">
                                {{__('main.weekend_vacation')}}
                            </th>
                            <th class="text-center">
                                {{__('main.yearly_vacation')}}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-top-0 text-center">
                            <td>
                                @if(!empty($employee->project_id))
                                    @if(App::getLocale() == "ar")
                                        <p>
                                            - <a href="{{route('supervisor.projects.show',$employee->project->id)}}">
                                                {{$employee->project->project_name_ar}}
                                            </a>
                                        </p>
                                    @else
                                        <p>
                                            - <a href="{{route('supervisor.projects.show',$employee->project->id)}}">
                                                {{$employee->project->project_name_en}}
                                            </a>
                                        </p>
                                    @endif
                                @endif
                            </td>
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
                                {{$employee->identity_number}}
                            </td>
                            <td>
                                {{$employee->passport_number}}
                            </td>
                            <td>
                                {{$employee->contract_period}}
                            </td>
                            <td>
                                {{$employee->total_salary}}
                            </td>
                            <td>
                                {{$employee->weekend_vacation}}
                            </td>
                            <td>
                                {{$employee->yearly_vacation}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <hr/>
                    <div class="row mt-1 mb-3 text-center">
                        <div class="col-lg-4 pull-right ">
                            <label for=""> {{__('main.identity_file')}} </label>
                            <label for="" class="d-block mt-3"> {{__('main.file_preview')}} </label>
                            @if(!empty($employee->identity_file))
                                <a target="_blank" class="btn btn-md btn-link" href="{{asset($employee->identity_file)}}">
                                    تحميل
                                </a>
                            @endif
                        </div>
                        <div class="col-lg-4 pull-right ">
                            <label for=""> {{__('main.cv_file')}} </label>
                            <label for="" class="d-block mt-3"> {{__('main.file_preview')}} </label>
                            @if(!empty($employee->cv_file))
                                <a target="_blank" class="btn btn-md btn-link" href="{{asset($employee->cv_file)}}">
                                    تحميل
                                </a>
                            @endif
                        </div>
                        <div class="col-lg-4 pull-right ">
                            <label for=""> {{__('main.certs_files')}} </label>
                            <label for="" class="d-block mt-3"> {{__('main.file_preview')}} </label>
                            @if(!$employee->certs_files->isEmpty())
                                @foreach($employee->certs_files as $cert_file)
                                    <a target="_blank" class="btn btn-md btn-link"
                                       href="{{asset($cert_file->cert_file)}}">
                                        تحميل
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-12 mt-3 mb-5">
            <div class="card">
                <div class="card-header py-3 bg-transparent border-bottom-0">
                    <h6 class="card-title mb-0"><strong>
                            {{__('main.show_employee_contracts')}}
                        </strong></h6>
                </div>
                @if(!$employee->contracts->isEmpty())
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table display dataTable table-bordered">
                                <thead>
                                <tr>
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
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($employee->contracts as $key => $contract)
                                    <tr>
                                        <td>
                                            <a target="_blank" href="{{route('supervisor.applications.show',$contract->application_id)}}">
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
                                لا يوجد عروض وظيفية تخص هذا الموظف
                            @else
                                No Offers for This Employee
                            @endif
                        </p>
                    </div>
                @endif
            </div>
        </div>


    </div>
@endsection

<script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {

    });
</script>

