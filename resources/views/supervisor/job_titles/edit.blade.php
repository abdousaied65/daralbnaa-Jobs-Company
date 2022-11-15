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
                            {{__('main.edit_job_title')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    {!! Form::model($job_title, ['method' => 'PATCH','class' => 'row g-3','enctype' => 'multipart/form-data','route' => ['supervisor.job_titles.update', $job_title->id]]) !!}
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label class="col-form-label">{{__('main.job_title')}} {{__('main.arabic')}}</label>
                        <fieldset class="form-icon-group left-icon position-relative">
                            <input required type="text" dir="rtl" value="{{$job_title->job_title_ar}}" name="job_title_ar"
                                   class="form-control form-control-lg">
                            <div class="form-icon position-absolute">
                                <i class="fa fa-pencil"></i>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label class="col-form-label">{{__('main.job_title')}} {{__('main.english')}}</label>
                        <fieldset class="form-icon-group left-icon position-relative">
                            <input required type="text" dir="ltr" value="{{$job_title->job_title_en}}" name="job_title_en"
                                   class="form-control form-control-lg">
                            <div class="form-icon position-absolute">
                                <i class="fa fa-pencil"></i>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label class="col-form-label">{{__('main.rank')}}</label>
                        <fieldset class="form-icon-group left-icon position-relative">
                            <input required dir="ltr" type="number" value="{{$job_title->rank}}" min="1" name="rank" class="form-control form-control-lg">
                            <div class="form-icon position-absolute">
                                <i class="fa fa-pencil"></i>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label class="col-form-label">{{__('main.dept_name')}}</label>
                        <select required name="dept_id" id="dept_id"
                                data-title="{{__('main.choose')}}" data-live-search="true"
                                class="form-control form-control-lg w-100 selectpicker show-tick">
                            @foreach($depts as $dept)
                                <option
                                    @if($job_title->dept_id == $dept->id)
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
                    <div class="clearfix"></div>
                    <div class="col-12 mt-3">
                        <button class="btn btn-md btn-primary">{{__('main.update')}}</button>
                        <a href="{{route('supervisor.home')}}" class="btn btn-md btn-outline-secondary">{{__('main.cancel')}}</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- main-content closed -->

    <script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
@endsection
