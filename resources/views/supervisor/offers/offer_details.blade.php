@extends('supervisor.layouts.master2')
<link rel="stylesheet" href="{{asset('admin-assets/css/bootstrap.min.css')}}">
<style>
    i.la {
        font-size: 15px !important;
    }

    span.badge {
        padding: 10px !important;
    }
</style>
@section('content')
    <!-- main body area -->
    <div class="main auth-div p-2 py-3 p-xl-5">

        <!-- Body: Body -->
        <div class="body d-flex p-0 p-xl-5">
            <div class="container-fluid">
                <div class="row g-0">
                    <div
                        class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                        <div class="w-100 p-4 p-md-5 card border-0">
                            <!-- Form -->
                            <form action="{{ route('post.offer.details',$offer->id) }}" method="POST" class="row g-1 p-0 p-md-4">
                                @csrf
                                @method('PATCH')
                                <div class="col-12 text-center mb-5">
                                    <img src="{{asset('assets/img/logo.png')}}" style="width: 100px; height: 100px;"
                                         class="img-fluid" alt="">
                                    <h2>{{__('main.offer_details')}}</h2>
                                    <div class="mx-auto mt-4 mg-b-20">
                                        <h5 class="mg-b-12 tx-16"> {{__('main.welcome')}} </h5>
                                        <p class="tx-13 text-muted">
                                            @if(App::getLocale() == "ar")
                                                أكد رقم الجوال الخاص بك للدخول الى العرض الوظيفى
                                            @else
                                                Confirm Your Phone Number to Access Your Job Offer
                                            @endif
                                        </p>
                                    </div>
                                    @if (session('success'))
                                        <div class="alert alert-success text-center" style="margin-top: 30px;">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="alert alert-danger text-center" style="margin-top: 30px;">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    <div class="form-group mx-auto mt-4 mg-b-20 col-lg-4 col-md-6 col-sm-12">
                                        <label for="phone_number" class="d-block">
                                            {{__('main.phone_number')}}
                                        </label>
                                        <input required name="phone_number" id="phone_number" value="{{old('phone_number')}}"
                                               class="form-control form-control-lg @error('phone_number') is-invalid @enderror"
                                               placeholder="{{__('main.phone_number')}}"
                                               type="number" dir="ltr" min="1"
                                               maxlength="12" oninput="this.value=this.value.slice(0,this.maxLength)"
                                        />
                                        @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mx-auto text-center mt-4 mg-b-20 col-lg-4 col-md-6 col-sm-12form-group mt-2 text-center">
                                        <button class="btn btn-lg btn-outline-info btn-block">
                                            {{__('main.enter_dashboard')}}
                                        </button>
                                    </div>

                                </div>
                            </form>
                            <!-- End Form -->
                        </div>
                    </div>
                </div> <!-- End Row -->

            </div>
        </div>

        <div class="animate_lines">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>

    </div>
@endsection

<script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {

    });
</script>

