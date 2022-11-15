@extends('supervisor.layouts.master')
<style>
    input[type="checkbox"]{
        width: 20px; height: 20px;
        margin:5px;
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
                            {{__('main.add_new_application')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    <form class="row g-3" action="{{route('supervisor.applications.store','test')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" id="basic_salary" name="basic_salary"/>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.offer')}}</label>
                            <select required name="offer_id" id="offer_id"
                                    data-title="{{__('main.choose')}}" data-live-search="true"
                                    class="form-control form-control-lg w-100 selectpicker show-tick">
                                @foreach($offers as $offer)
                                    <option value="{{$offer->id}}">
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
                            <input required type="date" class="form-control form-control-lg" dir="ltr" name="date" value="{{date('Y-m-d')}}"/>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.application_type')}}</label>
                            <select required name="application_type" id="application_type"
                                    data-title="{{__('main.choose')}}" data-live-search="true"
                                    class="form-control form-control-lg w-100 selectpicker show-tick">
                                <option value="contract_extension">{{__('main.contract_extension')}}</option>
                                <option value="new_contract">{{__('main.new_contract')}}</option>
                                <option value="contract_renewal">{{__('main.contract_renewal')}}</option>
                                <option value="renew_modify">{{__('main.renew_modify')}}</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.dept_name')}}</label>
                            <select required name="dept_id" id="dept_id"
                                    data-title="{{__('main.choose')}}" data-live-search="true"
                                    class="form-control form-control-lg w-100 selectpicker show-tick">
                                @foreach($depts as $dept)
                                    <option value="{{$dept->id}}">
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
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.supervisors')}}</label>
                            <select id="job_titles" required name="job_titles[]"
                                    data-title="{{__('main.choose')}}" data-live-search="true" multiple
                                    class="form-control form-control-lg w-100 selectpicker show-tick">
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.total_salary')}}</label>
                            <input readonly type="number" id="total_salary" class="form-control form-control-lg" dir="ltr" name="total_salary"/>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.identity_residency_number')}}</label>
                            <input required type="number" class="form-control form-control-lg" dir="ltr" name="identity_number"/>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.identity_expiration_date')}}</label>
                            <input required type="date" class="form-control form-control-lg" dir="ltr" name="identity_expiration_date"/>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.housing_allowance')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input readonly dir="ltr" type="number" min="0" id="housing_allowance" name="housing_allowance"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-money"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.transport_allowance')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input readonly dir="ltr" type="number" min="0" id="transport_allowance" name="transport_allowance"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-money"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.another_allowance')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input readonly dir="ltr" type="number" min="0" id="another_allowance" name="another_allowance"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-money"></i>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.passport_number')}}</label>
                            <input type="number" class="form-control form-control-lg" dir="ltr" name="passport_number" />
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.employee_address')}}</label>
                            <input type="text" class="form-control form-control-lg" name="employee_address" />
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.another_phone_number')}}</label>
                            <input type="number" class="form-control form-control-lg" dir="ltr" name="another_phone_number" />
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.email')}}</label>
                            <input type="email" class="form-control form-control-lg" dir="ltr" name="email" />
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.notes')}}</label>
                            <input type="text" class="form-control form-control-lg" dir="ltr" name="notes"/>
                        </div>

                        <div class="col-3 pt-5">
                            <input type="checkbox" value="yes" name="social_security" id="social_security"/>
                            <label for="social_security" class="col-form-label">{{__('main.social_security')}}</label>
                        </div>
                        <div class="col-2 pt-5">
                            <input type="checkbox" value="yes" name="documents_complete" id="documents_complete"/>
                            <label for="documents_complete" class="col-form-label">{{__('main.documents_complete')}}</label>
                        </div>
                        <div class="col-2 pt-5">
                            <input type="checkbox" value="yes" name="medical_insurance" id="medical_insurance"/>
                            <label for="medical_insurance" class="col-form-label">{{__('main.medical_insurance')}}</label>
                        </div>
                        <div class="col-2 pt-5">
                            <input type="checkbox" value="yes" name="support_registered" id="support_registered"/>
                            <label for="support_registered" class="col-form-label">{{__('main.support_registered')}}</label>
                        </div>


                        <div class="col-12">
                            <button class="btn btn-md btn-primary">
                                <i class="fa fa-plus"></i>
                                {{__('main.add')}}</button>
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
        $('#offer_id').on('change',function () {
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
