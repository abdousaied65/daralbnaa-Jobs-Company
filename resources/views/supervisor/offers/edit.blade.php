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
                            {{__('main.edit_offer')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    <form class="row g-3" action="{{route('supervisor.offers.update',$offer->id)}}"
                          method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.employee_name')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="rtl" type="text" name="employee_name"
                                       value="{{$offer->employee_name}}"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-pencil"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.phone_number')}}</label>
                            <input required type="number" class="form-control form-control-lg" dir="ltr"
                                   value="{{$offer->phone_number}}"
                                   name="phone_number"/>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.job_title')}}</label>
                            <select required name="job_title_id" id="job_title_id"
                                    data-title="{{__('main.choose')}}" data-live-search="true"
                                    class="form-control form-control-lg w-100 selectpicker show-tick">
                                @foreach($job_titles as $job_title)
                                    <option
                                        @if($offer->job_title_id == $job_title->id)
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
                                        @if($offer->nationality_id == $nationality->id)
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
                            <label class="col-form-label">{{__('main.contract_period')}} </label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="ltr" type="number" min="0" name="contract_period"
                                       value="{{$offer->contract_period}}"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-id-card"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.basic_salary')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="ltr" type="number" min="0" id="basic_salary" name="basic_salary"
                                       value="{{$offer->basic_salary}}"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-money"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.housing_allowance')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="ltr" type="number" min="0" id="housing_allowance" name="housing_allowance"
                                       value="{{$offer->housing_allowance}}"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-money"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.transport_allowance')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="ltr" type="number" min="0" id="transport_allowance" name="transport_allowance"
                                       value="{{$offer->transport_allowance}}"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-money"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.another_allowance')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="ltr" type="number" min="0" id="another_allowance" name="another_allowance"
                                       value="{{$offer->another_allowance}}"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-money"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.total_salary')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="ltr" type="number" min="0" id="total_salary" name="total_salary"
                                       value="{{$offer->total_salary}}"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-money"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.weekend_vacation')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="ltr" type="number" min="0" name="weekend_vacation"
                                       value="{{$offer->weekend_vacation}}"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-bed"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label class="col-form-label">{{__('main.yearly_vacation')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="ltr" type="number" min="0" name="yearly_vacation"
                                       value="{{$offer->yearly_vacation}}"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-bed"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-12">
                            <button class="btn btn-md btn-primary">
                                {{__('main.confirm')}}</button>
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
        $('#basic_salary,#transport_allowance,#housing_allowance,#another_allowance').on('keyup change blur', function () {
            let basic_salary = $('#basic_salary').val();
            let transport_allowance = $('#transport_allowance').val();
            let housing_allowance = $('#housing_allowance').val();
            let another_allowance = $('#another_allowance').val();
            let total_salary = parseFloat(basic_salary)  + parseFloat(transport_allowance) + parseFloat(housing_allowance) + parseFloat(another_allowance);
            $('#total_salary').val(total_salary);
        });
    </script>

@endsection
