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
                            {{__('main.add_new_project')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    <form class="row g-3" action="{{route('supervisor.projects.store','test')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label class="col-form-label">{{__('main.project_name')}} - {{__('main.arabic')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="rtl" type="text" name="project_name_ar"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-pencil"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label class="col-form-label">{{__('main.project_name')}} - {{__('main.english')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="ltr" type="text" name="project_name_en"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-pencil"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="col-form-label">{{__('main.dept_name')}}</label>
                            <select required name="dept_id" class="form-control form-control-lg w-100 js-example-basic-single">
                                <option value="">{{__('main.choose')}}</option>
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

                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="col-form-label">{{__('main.added_date')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="ltr" type="date" name="added_date" value="{{date('Y-m-d')}}"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="col-form-label">{{__('main.project_end_date')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="ltr" type="date" name="project_end_date" value="{{date('Y-m-d',strtotime('+1 year'))}}"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-md btn-primary">{{__('main.add')}}</button>
                            <a href="{{route('supervisor.home')}}"
                               class="btn btn-md btn-outline-secondary">{{__('main.cancel')}}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
@endsection
