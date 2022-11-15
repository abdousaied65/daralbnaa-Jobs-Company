@extends('supervisor.layouts.master')
<style>
    span.float-right > i.fa {
        font-size: 40px !important;
    }
</style>
@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-3">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="row clearfix row-deck">
                        <div class="col-xl-3 col-lg-6 col-md-3 col-sm-6">
                            <div class="card mb-3 border-0 lift">
                                <div class="card-body">
                                    <span class="text-uppercase">{{__('main.offers')}}</span>
                                    <h4 class="mb-0 mt-2">{{$offers->count()}}</h4>
                                    <small class="text-muted">{{__('main.total_offers')}}</small>
                                </div>
                                <div id="apexspark1"></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-3 col-sm-6">
                            <div class="card mb-3 border-0 lift">
                                <div class="card-body">
                                    <span class="text-uppercase">{{__('main.applications')}}</span>
                                    <h4 class="mb-0 mt-2">{{$applications->count()}}</h4>
                                    <small class="text-muted">{{__('main.total_applications')}}</small>
                                </div>
                                <div id="apexspark2"></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12 col-md-3 col-sm-12">
                            <div class="card mb-3 border-0 lift">
                                <div class="card-body">
                                    <span class="text-uppercase">{{__('main.contracts')}}</span>
                                    <h4 class="mb-0 mt-2">{{$contracts->count()}}</h4>
                                    <small class="text-muted">{{__('main.total_contracts')}}</small>
                                </div>
                                <div id="apexspark3"></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12 col-md-3 col-sm-12">
                            <div class="card mb-3 border-0 lift">
                                <div class="card-body">
                                    <span class="text-uppercase">{{__('main.employees')}}</span>
                                    <h4 class="mb-0 mt-2">{{$employees->count()}}</h4>
                                    <small class="text-muted">{{__('main.total_employees')}}</small>
                                </div>
                                <div id="apexspark4"></div>
                            </div>
                        </div>
                    </div> <!-- .row end -->
                    <div class="card mb-3 border-0 lift">
                        <div
                            class="card-header py-3 d-flex flex-wrap  justify-content-between align-items-center bg-transparent border-bottom-0">
                            <div>
                                <h6 class="card-title m-0">{{__('main.applications_during_this_year')}}</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-header border">
                                @if(App::getLocale() == "ar")
                                    عدد قرارات التوظيف فى كل شهر على مدار العام الحالى
                                    {{date('Y')}}
                                @else
                                    The number of job applications for each month during the current year
                                    {{date('Y')}}
                                @endif
                            </div>
                            <div id="apex-AudienceOverview"></div>
                        </div>
                    </div> <!-- .card end -->
                </div>
            </div> <!-- .row end -->
        </div>
    </div>
@endsection
