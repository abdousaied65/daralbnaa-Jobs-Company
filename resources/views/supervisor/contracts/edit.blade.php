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
                            {{__('main.edit_contract')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    <form class="row g-3" action="{{route('supervisor.contracts.update',$contract->id)}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.application')}}</label>
                            <select required name="application_id" id="application_id"
                                    data-title="{{__('main.choose')}}" data-live-search="true"
                                    class="form-control form-control-lg w-100 selectpicker show-tick">
                                @foreach($applications as $application)
                                    <option
                                        @if($contract->application_id == $application->id )
                                            selected
                                        @endif
                                        value="{{$application->id}}">
                                        {{$application->offer->employee_name}} - {{trans('main.'.$application->application_type.'')}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.employee_name')}}</label>
                            <input value="{{$contract->employee_name}}" required type="text" class="form-control form-control-lg" id="employee_name" name="employee_name" />
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.date')}}</label>
                            <input required type="date" class="form-control form-control-lg" value="{{$contract->date}}" id="date" name="date" />
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.nationality')}}</label>
                            <select required name="nationality_id" id="nationality_id"
                                    data-title="{{__('main.choose')}}" data-live-search="true"
                                    class="form-control form-control-lg w-100 selectpicker show-tick">
                                @foreach($nationalities as $nationality)
                                    <option
                                        @if($contract->nationality_id == $nationality->id )
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
                        <div class="clearfix"></div>


                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.identity_residency_number')}}</label>
                            <input required type="number" class="form-control form-control-lg" value="{{$contract->identity_number}}" dir="ltr" id="identity_number" name="identity_number" />
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.passport_number')}}</label>
                            <input type="number" class="form-control form-control-lg" dir="ltr" value="{{$contract->passport_number}}" name="passport_number" />
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.employee_address')}}</label>
                            <input required type="text" class="form-control form-control-lg" name="employee_address" value="{{$contract->employee_address}}" />
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.phone_number')}}</label>
                            <input required type="number" class="form-control form-control-lg" dir="ltr" value="{{$contract->phone_number}}" name="phone_number" id="phone_number" />
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.another_phone_number')}}</label>
                            <input required type="number" class="form-control form-control-lg" dir="ltr" value="{{$contract->another_phone_number}}" name="another_phone_number" />
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.email')}}</label>
                            <input required type="email" class="form-control form-control-lg" dir="ltr" value="{{$contract->email}}" name="email" />
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.job_title')}}</label>
                            <select required name="job_title_id" id="job_title_id"
                                    data-title="{{__('main.choose')}}" data-live-search="true"
                                    class="form-control form-control-lg w-100 selectpicker show-tick">
                                @foreach($job_titles as $job_title)
                                    <option
                                        @if($contract->job_title_id == $job_title->id )
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
                            <label class="col-form-label">{{__('main.contract_period')}}</label>
                            <input required type="number" class="form-control form-control-lg" value="{{$contract->contract_period}}" dir="ltr" name="contract_period" id="contract_period"/>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.start_date')}}</label>
                            <input required type="date" value="{{$contract->start_date}}" class="form-control form-control-lg" dir="ltr" id="start_date" name="start_date"/>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.end_date')}}</label>
                            <input required type="date" value="{{$contract->end_date}}" class="form-control form-control-lg" dir="ltr" id="end_date" name="end_date"/>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.basic_salary')}}</label>
                            <input required type="number" class="form-control form-control-lg" dir="ltr" value="{{$contract->basic_salary}}" id="basic_salary" name="basic_salary"/>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.housing_allowance')}}</label>
                            <input required type="number" class="form-control form-control-lg" value="{{$contract->housing_allowance}}" dir="ltr" name="housing_allowance"/>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.transport_allowance')}}</label>
                            <input required type="number" class="form-control form-control-lg" dir="ltr" value="{{$contract->transport_allowance}}" name="transport_allowance"/>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.another_allowance')}}</label>
                            <input required type="number" class="form-control form-control-lg" dir="ltr" value="{{$contract->another_allowance}}" name="another_allowance"/>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.total_salary')}}</label>
                            <input required type="number" class="form-control form-control-lg" value="{{$contract->total_salary}}" dir="ltr" name="total_salary" id="total_salary"/>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.notes')}}</label>
                            <input required type="text" class="form-control form-control-lg" value="{{$contract->notes}}" dir="ltr" name="notes"/>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-12">
                            <button class="btn btn-md btn-success">
                                <i class="fa fa-check"></i>
                                {{__('main.update')}}</button>
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
                $('#total_salary').val(data.offer.total_salary);
                $('#identity_number').val(data.application.identity_number);
                $('#phone_number').val(data.offer.phone_number);
            });
        });
    </script>
@endsection
