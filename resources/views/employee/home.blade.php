@extends('employee.layouts.master')
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
    <div class="body d-flex py-lg-4 py-3">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-12 mx-auto my-auto d-flex align-content-center justify-content-center text-center">
                    <img src="{{asset('assets/img/logo.png')}}" style="width: 70%;height: 450px;">
                </div>
            </div> <!-- .row end -->
        </div>
    </div>
@endsection


