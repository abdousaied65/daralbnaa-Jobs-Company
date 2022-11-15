@extends('employee.layouts.master2')
@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <div class="col-lg-6 col-sm-12 pull-right align-content-center justify-content-center text-center">
                <img src="{{asset('assets/img/logo.png')}}" style="width: 70%;height: 450px;">
            </div>
            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="tx-20 text-dark text-center justify-content-center">
                                    {{__('main.system_name')}}
                                </h3>
                                <div class="main-card-signin bg-white">
                                    <div class="p-4 wd-100p">
                                        <div class="main-signin-header">
                                            <div class="mx-auto text-center mb-2">
                                                <img
                                                    style="width:100px; height: 100px;padding: 5px ;border:1px solid #ddd;"
                                                    class="rounded-circle mt-2 mb-2"
                                                    src="{{asset('assets/img/logo.png')}}">
                                            </div>
                                            <div class="mx-auto text-center mt-4 mg-b-20">
                                                <h5 class="mg-b-12 tx-16"> {{__('main.welcome')}} </h5>
                                                <p class="tx-13 text-muted">
                                                    @if(App::getLocale() == "ar")
                                                        ادخل كلمة المرور الخاصة بك للدخول الى حسابك
                                                    @else
                                                        Type Your Password to Access Your Employee Dashboard
                                                    @endif
                                                </p>
                                            </div>
                                            <form method="post" action="{{route('employee.password.confirm')}}">
                                                @csrf
                                                @method('POST')
                                                <div class="form-group">
                                                    <input required name="password"
                                                           class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                           placeholder="{{__('main.password')}}"
                                                           type="password">
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-2 text-center">
                                                    <button class="btn btn-lg btn-outline-primary btn-block">
                                                        {{__('main.enter_dashboard')}}
                                                    </button>
                                                </div>
                                                <div class="form-group mt-4">
                                                    @if (Route::has('employee.password.request'))
                                                        <a class="btn btn-md btn-block"
                                                           href="{{ route('employee.password.request') }}">
                                                            {{__('main.forgot_password')}}
                                                        </a>
                                                    @endif
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->
        </div>
    </div>
@endsection
@section('js')
@endsection
