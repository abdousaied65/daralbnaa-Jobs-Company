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
                            {{__('main.edit_nationality')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    {!! Form::model($nationality, ['method' => 'PATCH','class' => 'row g-3','enctype' => 'multipart/form-data','route' => ['supervisor.nationalities.update', $nationality->id]]) !!}
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label class="col-form-label">{{__('main.nationality')}} {{__('main.arabic')}}</label>
                        <fieldset class="form-icon-group left-icon position-relative">
                            <input required type="text" dir="rtl" value="{{$nationality->nationality_ar}}" name="nationality_ar"
                                   class="form-control form-control-lg">
                            <div class="form-icon position-absolute">
                                <i class="fa fa-pencil"></i>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label class="col-form-label">{{__('main.nationality')}} {{__('main.english')}}</label>
                        <fieldset class="form-icon-group left-icon position-relative">
                            <input required type="text" dir="ltr" value="{{$nationality->nationality_en}}" name="nationality_en"
                                   class="form-control form-control-lg">
                            <div class="form-icon position-absolute">
                                <i class="fa fa-pencil"></i>
                            </div>
                        </fieldset>
                    </div>
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
