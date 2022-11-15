@extends('employee.layouts.master2')

@section('content')
    <!-- main body area -->
    <div class="main auth-div p-2 py-3 p-xl-5">
        <!-- Body: Body -->
        <div class="body d-flex p-0 p-xl-5">
            <div class="container-fluid">
                <div class="row g-0">
                    <div class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                        <div class="w-100 p-4 p-md-5 card border-0" style="max-width: 40rem;">
                            <!-- Form -->
                            <form action="{{ route('employee.reset.password.post') }}" class="row g-1 p-0 p-md-4" method="post">
                                @csrf
                                <div class="col-12 text-center mb-2">
                                    <img src="{{asset('assets/img/logo.png')}}" class="w240 mb-4" alt="" />
                                    <h1>
                                        {{__('main.reset_password')}}
                                    </h1>
                                </div>
                                @if (session('status'))
                                    <div class="alert alert-success text-center" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <input type="hidden" name="phone_number" value="{{$phone}}">

                                <div class="col-12">
                                    <div class="mb-2">
                                        <label for="otp" class="form-label">{{__('main.otp')}}</label>
                                        <input id="otp" type="number" dir="ltr" class="form-control form-control-lg text-left @error('otp') is-invalid @enderror" name="otp"
                                               required autofocus>
                                        @error('otp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-2">
                                        <label for="password"  class="form-label">{{__('main.password')}}</label>
                                        <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-2">
                                        <label for="password-confirm"  class="form-label">{{__('main.confirm_password')}}</label>
                                        <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="col-12 text-center mt-4">
                                    <button type="submit" class="btn btn-lg btn-block btn-dark lift text-uppercase">
                                        {{__('main.reset_password')}}
                                    </button>
                                </div>
                                <div class="col-12 text-center mt-4">
                                <span class="text-muted"><a href="{{route('employee.login')}}">
                                        {{__('main.back_to_sign_in')}}
                                    </a></span>
                                </div>
                            </form>
                            <!-- End Form -->
                        </div>
                    </div>
                </div> <!-- End Row -->

            </div>
        </div>

    </div>
@endsection
