@extends('supervisor.layouts.master')
@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>{{__('main.errors')}}</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-3 bg-transparent border-bottom-0">
                    <h6 class="card-title mb-0"><strong>
                            {{__('main.edit_employee_transfer')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    {!! Form::model($employee_transfer, ['method' => 'PATCH','class' => 'row g-3','enctype' => 'multipart/form-data','route' => ['supervisor.employees_transfers.update', $employee_transfer->id]]) !!}
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <label class="col-form-label">{{__('main.employee_name')}}</label>
                        <fieldset class="form-icon-group left-icon position-relative">
                            <select required name="employee_id" id="employee_id"
                                    class="form-control form-control-lg w-100 js-example-basic-single">
                                <option value="">{{__('main.choose')}}</option>
                                @foreach($employees as $employee)
                                    <option
                                        @if($employee_transfer -> employee_id == $employee->id)
                                            selected
                                        @endif
                                        value="{{$employee->id}}">
                                        @if(App::getLocale() == "ar")
                                            {{$employee->name_ar}}
                                        @else
                                            {{$employee->name_en}}
                                        @endif
                                    </option>
                                @endforeach()
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <label class="col-form-label">{{__('main.old_dept')}}</label>
                        <fieldset class="form-icon-group left-icon position-relative">
                            <select required name="old_dept_id" id="old_dept_id"
                                    class="form-control form-control-lg w-100 js-example-basic-single">
                                <option value="">{{__('main.choose')}}</option>
                                @foreach($depts as $dept)
                                    <option
                                        @if($employee_transfer -> old_dept_id == $dept->id)
                                        selected
                                        @endif
                                        value="{{$dept->id}}">
                                        @if(App::getLocale() == "ar")
                                            {{$dept->dept_name_ar}}
                                        @else
                                            {{$dept->dept_name_en}}
                                        @endif
                                    </option>
                                @endforeach()
                            </select>
                        </fieldset>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <label class="col-form-label">{{__('main.old_project')}}</label>
                        <fieldset class="form-icon-group left-icon position-relative">
                            <select required name="old_project_id" id="old_project_id"
                                    class="form-control form-control-lg w-100 js-example-basic-single">
                                <option value="">{{__('main.choose')}}</option>
                                @foreach($projects as $project)
                                    <option
                                        @if($employee_transfer -> old_project_id == $project->id)
                                        selected
                                        @endif
                                        value="{{$project->id}}">
                                        @if(App::getLocale() == "ar")
                                            {{$project->project_name_ar}}
                                        @else
                                            {{$project->project_name_en}}
                                        @endif
                                    </option>
                                @endforeach()
                            </select>
                        </fieldset>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <label class="col-form-label">{{__('main.new_dept')}}</label>
                        <fieldset class="form-icon-group left-icon position-relative">
                            <select required name="new_dept_id" id="new_dept_id"
                                    class="form-control form-control-lg w-100 js-example-basic-single">
                                <option value="">{{__('main.choose')}}</option>
                                @foreach($depts as $dept)
                                    <option
                                        @if($employee_transfer -> new_dept_id == $dept->id)
                                        selected
                                        @endif
                                        value="{{$dept->id}}">
                                        @if(App::getLocale() == "ar")
                                            {{$dept->dept_name_ar}}
                                        @else
                                            {{$dept->dept_name_en}}
                                        @endif
                                    </option>
                                @endforeach()
                            </select>
                        </fieldset>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <label class="col-form-label">{{__('main.new_project')}}</label>
                        <fieldset class="form-icon-group left-icon position-relative">
                            <select required name="new_project_id" id="new_project_id"
                                    class="form-control form-control-lg w-100 js-example-basic-single">
                                <option value="">{{__('main.choose')}}</option>
                                @foreach($projects as $project)
                                    <option
                                        @if($employee_transfer -> new_project_id == $project->id)
                                        selected
                                        @endif
                                        value="{{$project->id}}">
                                        @if(App::getLocale() == "ar")
                                            {{$project->project_name_ar}}
                                        @else
                                            {{$project->project_name_en}}
                                        @endif
                                    </option>
                                @endforeach()
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <label class="col-form-label">{{__('main.date')}}</label>
                        <fieldset class="form-icon-group left-icon position-relative">
                            <input required type="date" id="date" value="{{$employee_transfer->date}}"
                                   class="form-control form-control-lg" name="date"/>
                        </fieldset>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <label class="col-form-label">{{__('main.notes')}}</label>
                        <fieldset class="form-icon-group left-icon position-relative">
                            <input type="text" id="notes" class="form-control form-control-lg" value="{{$employee_transfer->notes}}" name="notes"/>
                        </fieldset>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <label class="col-form-label">{{__('main.status')}}</label>
                        <fieldset class="form-icon-group left-icon position-relative">
                            <select required name="status" id="status"
                                    class="form-control form-control-lg w-100 js-example-basic-single">
                                <option value="">{{__('main.choose')}}</option>
                                <option @if($employee_transfer->status == "approved") selected @endif value="approved">{{__('main.approved')}}</option>
                                <option @if($employee_transfer->status == "declined") selected @endif value="declined">{{__('main.declined')}}</option>
                                <option @if($employee_transfer->status == "waiting") selected @endif value="waiting">{{__('main.waiting')}}</option>
                                <option @if($employee_transfer->status == "pending") selected @endif value="pending">{{__('main.pending')}}</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-12 mt-3">
                        <button class="btn btn-md btn-primary">{{__('main.update')}}</button>
                        <a href="{{route('supervisor.home')}}"
                           class="btn btn-md btn-outline-secondary">{{__('main.cancel')}}</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- main-content closed -->

    <script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
@endsection
