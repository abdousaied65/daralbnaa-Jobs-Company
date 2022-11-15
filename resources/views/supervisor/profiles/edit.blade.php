@extends('supervisor.layouts.master')
<!-- Internal Data table css -->
<style>

    [role='combobox'] {
        left: -90px !important;
        width: 220px;
    }
</style>

@section('content')
    @if (session('success'))
        <div class="alert alert-success  fade show">
            {{ session('success') }}
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Errors :</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- row -->
    <div id="form-control-repeater">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="card-title text-white text-center">
                            {{__('main.edit_profile_info')}}
                        </h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form action="{{route('supervisor.profile.update',Auth::user()->id)}}" method="POST"
                                  enctype="multipart/form-data">

                                @csrf
                                @method('PATCH')
                                <div class="row mb-3">
                                    <div class="form-group col-md-4 pull-right ">
                                        <label for=""> {{__('main.name')}} </label>
                                        @if(App::getLocale() == "ar")
                                            <input type="text" class="form-control form-control-lg" required
                                                   value="{{ Auth::user()->supervisor_name_ar }}"
                                                   name="supervisor_name_ar">
                                        @else
                                            <input type="text" class="form-control form-control-lg" required
                                                   value="{{ Auth::user()->supervisor_name_en }}"
                                                   name="supervisor_name_en">
                                        @endif

                                    </div>
                                    <div class="form-group col-md-4 pull-right ">
                                        <label for=""> {{__('main.email')}} </label>
                                        <input type="text" class="form-control text-left form-control-lg" dir="ltr"
                                               required
                                               value="{{ Auth::user()->email }}" name="email">
                                    </div>
                                    <div class="form-group col-md-4 pull-right ">
                                        <label for=""> {{__('main.password')}} </label>
                                        <input type="password" class="form-control form-control-lg"
                                               style="text-align: left;" dir="ltr"
                                               name="password">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row mb-3">
                                    <div class="form-group col-md-4 pull-right ">
                                        <label for=""> {{__('main.confirm_password')}} </label>
                                        <input type="password" class="form-control form-control-lg"
                                               style="text-align: left;" dir="ltr"
                                               name="confirm-password">
                                    </div>
                                    <div class="col-md-4 pull-right " id="lnWrapper">
                                        <label> {{__('main.phone_number')}} <span class="text-danger">*</span></label>
                                        <input value="{{$user->phone_number}}" required
                                               class="form-control form-control-lg mg-b-20"
                                               style="text-align: left;direction:ltr;"
                                               data-parsley-class-handler="#lnWrapper"
                                               name="phone_number" type="number" min="1">
                                    </div>
                                    <div class="col-lg-4 pull-right ">
                                        <label for=""> {{__('main.profile_picture')}} </label>
                                        <input accept="image/*" type="file"
                                               oninput="pic.src=window.URL.createObjectURL(this.files[0])" id="file"
                                               name="profile_pic" class="form-control form-control-lg">
                                        <label for="" class="d-block mt-3"> {{__('main.picture_preview')}} </label>
                                        <img id="pic" src="{{asset($user->profile_pic)}}"
                                             style="width: 100px; height:100px;"/>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                        </div>
                        <div class="card-footer">
                            <div class="col-lg-12 text-center">
                                <button type="reset" name="reset" class="btn btn-info btn-md">
                                    <i class="fa fa-refresh"></i>
                                    {{__('main.reset_form')}}
                                </button>
                                <button type="submit" name="submit" class="btn btn-success btn-md">
                                    <i class="fa fa-check"></i>
                                    {{__('main.update')}}
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin-assets/js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#reset-btn').on('click', function () {
                var $image = $('#pic');
                $image.removeAttr('src').replaceWith($image.clone());
            });
        });
    </script>
@endsection

