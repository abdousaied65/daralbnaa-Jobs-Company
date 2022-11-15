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
                            {{__('main.add_new_dept')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    <form class="row g-3" action="{{route('supervisor.depts.store','test')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label class="col-form-label">{{__('main.dept_name')}} - {{__('main.arabic')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="rtl" type="text" name="dept_name_ar" class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-pencil"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label class="col-form-label">{{__('main.dept_name')}} - {{__('main.english')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="ltr" type="text" name="dept_name_en" class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-pencil"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-md btn-primary">{{__('main.add')}}</button>
                            <a href="{{route('supervisor.home')}}" class="btn btn-md btn-outline-secondary">{{__('main.cancel')}}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
@endsection
