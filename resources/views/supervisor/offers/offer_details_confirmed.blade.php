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
        <div class="body p-0 p-xl-5">
            <div class="container-fluid">
                <div class="row g-0">
                    <div
                        class="col-lg-12 justify-content-center align-items-center border-0 rounded-lg auth-h100">
                        <div class="w-100 card border-0">
                            <!-- Form -->
                            <form action="{{ route('approve.offer') }}" class="text-center" method="post">
                                {{ method_field('POST') }}
                                {{ csrf_field() }}
                                <input type="hidden" name="offer_id" value="{{$offer->id}}"/>
                                <div class="col-12 text-center">
                                    <img src="{{asset('assets/img/logo.png')}}" style="width: 100px; height: 100px;"
                                         class="img-fluid" alt="">
                                    <h2>{{__('main.offer_details')}}</h2>
                                    <div class="row mt-5 mb-4">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label class="col-form-label">{{__('main.employee_name')}}</label>
                                            <fieldset class="form-icon-group left-icon position-relative">
                                                <input readonly dir="rtl" type="text"
                                                       value="{{$offer->employee_name}}"
                                                       class="form-control form-control-lg">
                                                <div class="form-icon position-absolute">
                                                    <i class="fa fa-pencil"></i>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label class="col-form-label">{{__('main.phone_number')}}</label>
                                            <input readonly type="number" class="form-control form-control-lg" dir="ltr"
                                                   value="{{$offer->phone_number}}"/>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label class="col-form-label">{{__('main.nationality')}}</label>
                                            <input readonly type="text" class="form-control form-control-lg"
                                                   @if(App::getLocale() == "ar")
                                                   value="{{$offer->nationality->nationality_ar}}"
                                                   @else
                                                   value="{{$offer->nationality->nationality_en}}"
                                                @endif/>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label class="col-form-label">{{__('main.job_title')}}</label>
                                            <input readonly type="text" class="form-control form-control-lg"
                                                   @if(App::getLocale() == "ar")
                                                   value="{{$offer->job_title->job_title_ar}}"
                                                   @else
                                                   value="{{$offer->job_title->job_title_en}}"
                                                @endif/>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label
                                                class="col-form-label">{{__('main.contract_period')}} </label>
                                            <fieldset class="form-icon-group left-icon position-relative">
                                                <input readonly dir="ltr" type="number" min="1"
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
                                                <input readonly dir="ltr" type="number" min="1"
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
                                                <input readonly dir="ltr" type="number" min="1"
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
                                                <input readonly dir="ltr" type="number" min="1"
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
                                                <input readonly dir="ltr" type="number" min="1"
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
                                                <input readonly dir="ltr" type="number" min="1"
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
                                                <input readonly dir="ltr" type="number" min="1"
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
                                                <input readonly dir="ltr" type="number" min="1"
                                                       value="{{$offer->yearly_vacation}}"
                                                       class="form-control form-control-lg">
                                                <div class="form-icon position-absolute">
                                                    <i class="fa fa-bed"></i>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <button type="submit" class="btn btn-lg btn-success approve_offer" id="approve-offer">
                                    <i class="fa fa-check"></i>
                                    {{__('main.approve_offer')}}</button>
                                <a data-bs-toggle="modal" href="javascript:;"
                                   data-bs-target="#exampleModal20" offer_id="{{$offer->id}}"
                                   @if(App::getLocale() == "ar")
                                   offer="{{$offer->job_title->job_title_ar}}"
                                   @else
                                   offer="{{$offer->job_title->job_title_en}}"
                                   @endif
                                   class="btn btn-lg btn-danger decline_offer">
                                    <i class="fa fa-close"></i>
                                    {{__('main.decline_offer')}}</a>
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
    <div class="modal fade" id="exampleModal20" tabindex="-1" aria-labelledby="exampleModalLabel20"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title w-100" id="exampleModalLabel20">
                        {{__('main.decline_offer')}}
                    </h5>
                    <button type="button" class="btn btn-default btn-md btn-close" data-bs-dismiss="modal">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <form action="{{ route('decline.offer') }}" method="post">
                        {{ method_field('POST') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <p>{{__('main.sure_decline')}}</p>
                                <input type="hidden" name="offer_id" id="offer_id" value="">
                                <input class="form-control form-control-lg" name="offer" id="offer"
                                       type="text"
                                       readonly>
                            </div>
                            <div class="form-group">
                                <label class="d-block" for="reason">
                                    {{__('main.decline_reason')}}
                                </label>
                                <textarea required name="decline_reason" class="form-control" id="reason"
                                          style="resize: none;width:100%!important; height: 200px!important;"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">{{__('main.cancel')}}</button>
                            <button type="submit" class="btn btn-danger">{{__('main.decline')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.decline_offer').on('click', function () {
            var offer_id = $(this).attr('offer_id');
            var offer = $(this).attr('offer');
            $('.modal-body #offer_id').val(offer_id);
            $('.modal-body #offer').val(offer);
        });
    });
</script>
