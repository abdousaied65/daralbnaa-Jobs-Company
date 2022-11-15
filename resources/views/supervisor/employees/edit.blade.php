@extends('supervisor.layouts.master')
@section('content')
    <!-- main-content closed -->
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

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-3 bg-transparent border-bottom-0">
                    <h6 class="card-title mb-0"><strong>
                            {{__('main.edit_employee')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    <form class="row g-3" action="{{route('supervisor.employees.update',$employee->id)}}"
                          method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" value="موظف" name="role_name"/>
                        <input type="hidden" name="Status" value="active">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.employee_name')}} - {{__('main.arabic')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="rtl" type="text" name="name_ar" value="{{$employee->name_ar}}"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-pencil"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.employee_name')}}
                                - {{__('main.english')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="ltr" type="text" name="name_en" value="{{$employee->name_en}}"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-pencil"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.email')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input dir="ltr" type="email" name="email" value="{{$employee->email}}"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-pencil"></i>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.phone_number')}}</label>
                            <input required type="number" class="form-control form-control-lg"
                                   value="{{$employee->phone_number}}" dir="ltr" name="phone_number"/>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.dept_name')}}</label>
                            <select required name="dept_id" id="dept_id"
                                    data-title="{{__('main.choose')}}" data-live-search="true"
                                    class="form-control form-control-lg w-100 selectpicker show-tick">
                                @foreach($depts as $dept)
                                    <option
                                        @if($employee->dept_id == $dept->id)
                                        selected
                                        @endif
                                        value="{{$dept->id}}">
                                        @if(App::getLocale() == "ar")
                                            {{$dept->dept_name_ar}}
                                        @else
                                            {{$dept->dept_name_en}}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.projects')}}</label>
                            <select id="projects" required name="project_id"
                                    data-title="{{__('main.choose')}}" data-live-search="true"
                                    class="form-control form-control-lg w-100 selectpicker show-tick">
                                <option selected value="{{$employee->project->id}}">
                                    @if(App::getLocale() == "ar")
                                        {{$employee->project->project_name_ar}}
                                    @else
                                        {{$employee->project->project_name_en}}
                                    @endif
                                </option>
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.password')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input dir="ltr" type="password" name="password"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-lock"></i>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.confirm_password')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input dir="ltr" type="password" name="confirm-password"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-lock"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.job_title')}}</label>
                            <select required name="job_title_id" id="job_title_id"
                                    data-title="{{__('main.choose')}}" data-live-search="true"
                                    class="form-control form-control-lg w-100 selectpicker show-tick">
                                @foreach($job_titles as $job_title)
                                    <option
                                        @if($employee->job_title_id == $job_title->id)
                                        selected
                                        @endif
                                        value="{{$job_title->id}}">
                                        @if(App::getLocale() == "ar")
                                            {{$job_title->job_title_ar}}
                                        @else
                                            {{$job_title->job_title_en}}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.nationality')}}</label>
                            <select required name="nationality_id" id="nationality_id"
                                    data-title="{{__('main.choose')}}" data-live-search="true"
                                    class="form-control form-control-lg w-100 selectpicker show-tick">
                                @foreach($nationalities as $nationality)
                                    <option
                                        @if($employee->nationality_id == $nationality->id)
                                        selected
                                        @endif
                                        value="{{$nationality->id}}">
                                        @if(App::getLocale() == "ar")
                                            {{$nationality->nationality_ar}}
                                        @else
                                            {{$nationality->nationality_en}}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.identity_residency_number')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="ltr" type="text" name="identity_number"
                                       value="{{$employee->identity_number}}"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-id-card"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.passport_number')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input dir="ltr" type="text" name="passport_number"
                                       value="{{$employee->passport_number}}"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-id-card"></i>
                                </div>
                            </fieldset>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.contract_period')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="ltr" type="number" min="1" name="contract_period"
                                       value="{{$employee->contract_period}}"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-id-card"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.total_salary')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input readonly dir="ltr" type="number" min="1" name="total_salary"
                                       value="{{$employee->total_salary}}"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-money"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.weekend_vacation')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="ltr" type="number" min="1" name="weekend_vacation"
                                       value="{{$employee->weekend_vacation}}"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-bed"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.yearly_vacation')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="ltr" type="number" min="1" name="yearly_vacation"
                                       value="{{$employee->yearly_vacation}}"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-bed"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.job_number')}}</label>
                            <input required type="number" class="form-control form-control-lg"
                                   value="{{$employee->job_number}}" dir="ltr" name="job_number"/>
                        </div>

                        <div class="col-lg-3 pull-right ">
                            <label for=""> {{__('main.identity_file')}} </label>
                            <input accept=".pdf,.png,.jpg,.jpeg,.doc,.docx" type="file"
                                   name="identity_file" class="form-control form-control-lg">
                            <label for="" class="d-block mt-3"> {{__('main.file_preview')}} </label>
                            @if(!empty($employee->identity_file))
                                <a target="_blank" class="btn btn-md btn-link" href="{{asset($employee->identity_file)}}">
                                    تحميل
                                </a>
                            @endif
                        </div>
                        <div class="col-lg-3 pull-right ">
                            <label for=""> {{__('main.cv_file')}} </label>
                            <input accept=".pdf,.png,.jpg,.jpeg,.doc,.docx" type="file"
                                   name="cv_file" class="form-control form-control-lg">
                            <label for="" class="d-block mt-3"> {{__('main.file_preview')}} </label>
                            @if(!empty($employee->cv_file))
                                <a target="_blank" class="btn btn-md btn-link" href="{{asset($employee->cv_file)}}">
                                    تحميل
                                </a>
                            @endif
                        </div>
                        <div class="col-lg-3 pull-right ">
                            <label for=""> {{__('main.certs_files')}} </label>
                            <input multiple accept=".pdf,.png,.jpg,.jpeg,.doc,.docx" type="file"
                                   name="certs_files[]" class="form-control form-control-lg">
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

                        <div class="clearfix"></div>

                        <div class="col-12">
                            <button class="btn btn-md btn-primary">{{__('main.update')}}</button>
                            <a href="{{route('supervisor.home')}}"
                               class="btn btn-md btn-outline-secondary">{{__('main.cancel')}}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
    <script>
        $('#dept_id').on('change', function () {
            $('#projects').html('');
            let dept_id = $(this).val();
            $.post('{{route('supervisor.show.projects')}}', {
                "_token": "{{ csrf_token() }}", dept_id: dept_id
            }, function (data) {
                $('#projects').html(data).selectpicker('refresh');
            });
        });
    </script>
@endsection
