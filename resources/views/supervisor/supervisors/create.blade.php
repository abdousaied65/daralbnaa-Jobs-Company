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
                            {{__('main.add_new_supervisor')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    <form class="row g-3" action="{{route('supervisor.supervisors.store','test')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="col-form-label">{{__('main.supervisor_name')}} - {{__('main.arabic')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="rtl" type="text" name="supervisor_name_ar"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-pencil"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="col-form-label">{{__('main.supervisor_name')}}
                                - {{__('main.english')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="ltr" type="text" name="supervisor_name_en"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-pencil"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="col-form-label">{{__('main.email')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="ltr" type="email" name="email"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-pencil"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="col-form-label">{{__('main.privilege')}}</label>
                            <select required name="role_name"
                                    class="form-control form-control-lg w-100 js-example-basic-single">
                                <option value="">{{__('main.choose')}}</option>
                                @foreach($roles as $role)
                                    <option value="{{$role}}">
                                        {{$role}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
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

                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="col-form-label">{{__('main.projects')}}</label>
                            <select id="projects" name="projects[]"
                                    data-title="{{__('main.choose')}}" data-live-search="true"
                                    multiple class="form-control form-control-lg w-100 selectpicker show-tick">
                            </select>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="col-form-label">{{__('main.password')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="ltr" type="password" name="password"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-lock"></i>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="col-form-label">{{__('main.confirm_password')}}</label>
                            <fieldset class="form-icon-group left-icon position-relative">
                                <input required dir="ltr" type="password" name="confirm-password"
                                       class="form-control form-control-lg">
                                <div class="form-icon position-absolute">
                                    <i class="fa fa-lock"></i>
                                </div>
                            </fieldset>
                        </div>


                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="col-form-label">{{__('main.phone_number')}}</label>
                            <input type="number" required class="form-control form-control-lg" dir="ltr" name="phone_number"/>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="col-form-label">{{__('main.profile_picture')}}</label>
                            <input accept="image/*" type="file"
                                   oninput="pic.src=window.URL.createObjectURL(this.files[0])" id="file"
                                   name="profile_pic" class="form-control form-control-lg">
                            <label for="" class="d-block mt-2"> {{__('main.picture_preview')}} </label>
                            <img id="pic" src=""
                                 style="width: 100px; height:100px;"/>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
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
