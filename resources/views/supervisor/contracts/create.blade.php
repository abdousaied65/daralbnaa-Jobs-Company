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
                            {{__('main.add_new_contract')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    <form class="row g-3" action="{{route('supervisor.contracts.store','test')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.application')}}</label>
                            <select required name="application_id" id="application_id"
                                    data-title="{{__('main.choose')}}" data-live-search="true"
                                    class="form-control form-control-lg w-100 selectpicker show-tick">
                                @foreach($applications as $application)
                                    <option value="{{$application->id}}">
                                        {{$application->offer->employee_name}} - {{trans('main.'.$application->application_type.'')}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.employee_name')}}</label>
                            <input required type="text" class="form-control form-control-lg" id="employee_name" name="employee_name" />
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.date')}}</label>
                            <input required type="date" class="form-control form-control-lg" value="{{date('Y-m-d')}}" id="date" name="date" />
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.nationality')}}</label>
                            <select required name="nationality_id" id="nationality_id"
                                    data-title="{{__('main.choose')}}" data-live-search="true"
                                    class="form-control form-control-lg w-100 selectpicker show-tick">
                                @foreach($nationalities as $nationality)
                                    <option value="{{$nationality->id}}">
                                        @if(App::getLocale() == "ar")
                                            {{$nationality->nationality_ar}}
                                        @else
                                            {{$nationality->nationality_en}}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="clearfix"></div>


                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.identity_residency_number')}}</label>
                            <input required type="number" class="form-control form-control-lg" dir="ltr" id="identity_number" name="identity_number" />
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
                            <label class="col-form-label">{{__('main.phone_number')}}</label>
                            <input required type="number" class="form-control form-control-lg" dir="ltr" name="phone_number" id="phone_number" />
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.another_phone_number')}}</label>
                            <input type="number" class="form-control form-control-lg" dir="ltr" name="another_phone_number" />
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.email')}}</label>
                            <input type="email" class="form-control form-control-lg" dir="ltr" name="email" />
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.job_title')}}</label>
                            <select required name="job_title_id" id="job_title_id"
                                    data-title="{{__('main.choose')}}" data-live-search="true"
                                    class="form-control form-control-lg w-100 selectpicker show-tick">
                                @foreach($job_titles as $job_title)
                                    <option value="{{$job_title->id}}">
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
                            <label class="col-form-label">{{__('main.contract_period')}}</label>
                            <input required type="number" class="form-control form-control-lg" dir="ltr" name="contract_period" id="contract_period"/>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.start_date')}}</label>
                            <input required type="date" value="{{date('Y-m-d')}}" class="form-control form-control-lg" dir="ltr" id="start_date" name="start_date"/>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.end_date')}}</label>
                            <input required type="date" value="{{date('Y-m-d')}}" class="form-control form-control-lg" dir="ltr" id="end_date" name="end_date"/>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.basic_salary')}}</label>
                            <input required readonly type="number" class="form-control form-control-lg" dir="ltr" id="basic_salary" name="basic_salary"/>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.housing_allowance')}}</label>
                            <input required readonly type="number" class="form-control form-control-lg" dir="ltr" id="housing_allowance" name="housing_allowance"/>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.transport_allowance')}}</label>
                            <input required readonly type="number" class="form-control form-control-lg" dir="ltr" id="transport_allowance" name="transport_allowance"/>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.another_allowance')}}</label>
                            <input required readonly type="number" class="form-control form-control-lg" dir="ltr" id="another_allowance" name="another_allowance"/>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.total_salary')}}</label>
                            <input required readonly type="number" class="form-control form-control-lg" dir="ltr" name="total_salary" id="total_salary"/>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.notes')}}</label>
                            <input type="text" class="form-control form-control-lg" dir="ltr" name="notes"/>
                        </div>

                        <div class="clearfix"></div>

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
        $('#application_id').on('change', function () {
            let application_id = $(this).val();
            $.post('{{route('show.contract.components')}}', {
                "_token": "{{ csrf_token() }}", application_id: application_id
            }, function (data) {
                $('#employee_name').val(data.offer.employee_name);
                $('#nationality_id').val(data.offer.nationality_id).selectpicker('refresh');
                $('#job_title_id').val(data.offer.job_title_id).selectpicker('refresh');
                $('#basic_salary').val(data.application.basic_salary);
                $('#contract_period').val(data.offer.contract_period);
                $('#housing_allowance').val(data.offer.housing_allowance);
                $('#transport_allowance').val(data.offer.transport_allowance);
                $('#another_allowance').val(data.offer.another_allowance);
                $('#total_salary').val(data.offer.total_salary);
                $('#identity_number').val(data.application.identity_number);
                $('#phone_number').val(data.offer.phone_number);
            });
        });
    </script>
@endsection
