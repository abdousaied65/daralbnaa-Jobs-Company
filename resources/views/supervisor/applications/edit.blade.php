@extends('supervisor.layouts.master')
<style>
    input[type="checkbox"] {
        width: 20px;
        height: 20px;
        margin: 5px;
    }
</style>
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
                            {{__('main.edit_application')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    <form class="row g-3" action="{{route('supervisor.applications.update',$application->id)}}"
                          method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" value="{{$application->basic_salary}}" id="basic_salary"
                               name="basic_salary"/>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.offer')}}</label>
                            <select required name="offer_id" id="offer_id"
                                    data-title="{{__('main.choose')}}" data-live-search="true"
                                    class="form-control form-control-lg w-100 selectpicker show-tick">
                                @foreach($offers as $offer)
                                    <option
                                        @if($application->offer_id == $offer->id)
                                        selected
                                        @endif
                                        value="{{$offer->id}}">
                                        @if(App::getLocale() == "ar")
                                            {{$offer->employee_name}} - {{$offer->job_title->job_title_ar}}
                                        @else
                                            {{$offer->employee_name}} - {{$offer->job_title->job_title_en}}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.date')}}</label>
                            <input required type="date" class="form-control form-control-lg" dir="ltr" name="date"
                                   value="{{$application->date}}"/>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.application_type')}}</label>
                            <select required name="application_type" id="application_type"
                                    data-title="{{__('main.choose')}}" data-live-search="true"
                                    class="form-control form-control-lg w-100 selectpicker show-tick">
                                <option @if($application->application_type == "contract_extension") selected
                                        @endif value="contract_extension">{{__('main.contract_extension')}}</option>
                                <option @if($application->application_type == "new_contract") selected
                                        @endif value="new_contract">{{__('main.new_contract')}}</option>
                                <option @if($application->application_type == "contract_renewal") selected
                                        @endif value="contract_renewal">{{__('main.contract_renewal')}}</option>
                                <option @if($application->application_type == "renew_modify") selected
                                        @endif value="renew_modify">{{__('main.renew_modify')}}</option>
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.dept_name')}}</label>
                            <select required name="dept_id" id="dept_id"
                                    data-title="{{__('main.choose')}}" data-live-search="true"
                                    class="form-control form-control-lg w-100 selectpicker show-tick">
                                @foreach($depts as $dept)
                                    <option
                                        @if($application->dept_id == $dept->id)
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
                            <label class="col-form-label">{{__('main.project_name')}}</label>
                            <select id="project_id" name="project_id"
                                    data-title="{{__('main.choose')}}" data-live-search="true"
                                    class="form-control form-control-lg w-100 selectpicker show-tick">
                                @if(!empty($application->project_id))
                                    <option selected value="{{$application->project->id}}">
                                        @if(App::getLocale() == "ar")
                                            {{$application->project->project_name_ar}}
                                        @else
                                            {{$application->project->project_name_en}}
                                        @endif
                                    </option>
                                @endif
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.supervisors')}}</label>
                            <select id="job_titles" required name="job_titles[]"
                                    data-title="{{__('main.choose')}}" data-live-search="true" multiple
                                    class="form-control form-control-lg w-100 selectpicker show-tick">
                                @foreach($job_titles as $job_title)
                                    <option selected value="{{$job_title->job_title_id}}">
                                        @if(App::getLocale() == "ar")
                                            {{$job_title->job_title->job_title_ar}}
                                        @else
                                            {{$job_title->job_title->job_title_en}}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.total_salary')}}</label>
                            <input readonly type="number" id="total_salary" class="form-control form-control-lg"
                                   dir="ltr"
                                   name="total_salary" value="{{$application->offer->total_salary}}"/>
                        </div>


                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.identity_residency_number')}}</label>
                            <input required type="number" class="form-control form-control-lg" dir="ltr"
                                   name="identity_number" value="{{$application->identity_number}}"/>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.identity_expiration_date')}}</label>
                            <input required type="date" class="form-control form-control-lg" dir="ltr"
                                   value="{{$application->identity_expiration_date}}"
                                   name="identity_expiration_date"/>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.housing_allowance')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input readonly dir="ltr" type="number" min="0" id="housing_allowance" name="housing_allowance"
                                value="{{$application->offer->housing_allowance}}" class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-money"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.transport_allowance')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input readonly dir="ltr" type="number" min="0" id="transport_allowance" name="transport_allowance"
                                       value="{{$application->offer->transport_allowance}}" class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-money"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.another_allowance')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input readonly dir="ltr" type="number" min="0" id="another_allowance" name="another_allowance"
                                       value="{{$application->offer->another_allowance}}"   class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-money"></i>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.passport_number')}}</label>
                            <input type="number" value="{{$application->passport_number}}" class="form-control form-control-lg" dir="ltr" name="passport_number" />
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.employee_address')}}</label>
                            <input type="text" value="{{$application->employee_address}}" class="form-control form-control-lg" name="employee_address" />
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.another_phone_number')}}</label>
                            <input type="number" value="{{$application->another_phone_number}}" class="form-control form-control-lg" dir="ltr" name="another_phone_number" />
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.email')}}</label>
                            <input type="email" value="{{$application->email}}" class="form-control form-control-lg" dir="ltr" name="email" />
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.notes')}}</label>
                            <input type="text" value="{{$application->notes}}" class="form-control form-control-lg" dir="ltr" name="notes"/>
                        </div>

                        <div class="col-3 pt-5">
                            <input type="checkbox" @if($application->social_security == "yes") value="yes" checked
                                   @endif
                                   name="social_security" id="social_security"/>
                            <label class="col-form-label" for="social_security">{{__('main.social_security')}}</label>
                        </div>
                        <div class="col-2 pt-5">
                            <input type="checkbox" @if($application->documents_complete == "yes") value="yes" checked
                                   @endif
                                   name="documents_complete" id="documents_complete"/>
                            <label class="col-form-label"
                                   for="documents_complete">{{__('main.documents_complete')}}</label>
                        </div>
                        <div class="col-2 pt-5">
                            <input type="checkbox" @if($application->medical_insurance == "yes") value="yes" checked
                                   @endif
                                   name="medical_insurance" id="medical_insurance"/>
                            <label class="col-form-label"
                                   for="medical_insurance">{{__('main.medical_insurance')}}</label>
                        </div>
                        <div class="col-2 pt-5">
                            <input type="checkbox" @if($application->support_registered == "yes") value="yes" checked
                                   @endif
                                   name="support_registered" id="support_registered"/>
                            <label class="col-form-label"
                                   for="support_registered">{{__('main.support_registered')}}</label>
                        </div>



                        <div class="col-12">
                            <button class="btn btn-md btn-success">
                                <i class="fa fa-edit"></i>
                                {{__('main.edit')}}</button>
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
            $('#project_id').html('');
            $('#job_titles').html('');
            let dept_id = $(this).val();
            $.post('{{route('supervisor.show.projects')}}', {
                "_token": "{{ csrf_token() }}", dept_id: dept_id
            }, function (data) {
                $('#project_id').html(data).selectpicker('refresh');
            });
            $.post('{{route('supervisor.show.job_titles')}}', {
                "_token": "{{ csrf_token() }}", dept_id: dept_id
            }, function (meta) {
                $('#job_titles').html(meta).selectpicker('refresh');
            });
        });
        $('#offer_id').on('change', function () {
            let offer_id = $(this).val();
            $.post('{{route('supervisor.get.offer')}}', {
                "_token": "{{ csrf_token() }}", offer_id: offer_id
            }, function (core) {
                $('#basic_salary').val(core.basic_salary);
                $('#total_salary').val(core.total_salary);
                $('#housing_allowance').val(core.housing_allowance);
                $('#transport_allowance').val(core.transport_allowance);
                $('#another_allowance').val(core.another_allowance);
            });
        });
    </script>
@endsection
