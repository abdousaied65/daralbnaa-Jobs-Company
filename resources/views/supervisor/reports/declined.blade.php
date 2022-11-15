@extends('supervisor.layouts.master')
<link rel="stylesheet" href="{{asset('admin-assets/css/bootstrap.min.css')}}">
<style>
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }

    .btn-md {
        height: 40px !important;
        min-width: 100px !important;
        padding: 10px !important;
        text-align: center !important;
    }

    input[type="checkbox"] {
        width: 20px;
        height: 20px;
    }

    span.badge {
        padding: 10px !important;
    }
</style>
@section('content')
    @if (session('success'))
        <div class="alert alert-success  fade show">
            {{ session('success') }}
        </div>
    @endif
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-12 mb-5">
            <div class="card">
                <div class="card-header py-3 bg-transparent border-bottom-0">
                    <h6 class="card-title mb-0">
                        <strong> {{__('main.contracts_declined_report')}}  ( {{$contracts->count()}} )</strong>
                    </h6>
                </div>
                <div class="card-body">
                    @if(!$contracts->isEmpty())
                        <div class="table-responsive">
                            <table id="myTable"
                                   class="table table-bordered table-condensed text-center justify-content-center w-100 display dataTable">
                                <thead>
                                <tr>
                                    <th class="border-bottom-0 text-center">
                                        #
                                    </th>
                                    <th class="border-bottom-0 text-center">
                                        {{__('main.employee_name')}}
                                    </th>
                                    <th class="border-bottom-0 text-center">
                                        {{__('main.date')}}
                                    </th>
                                    <th class="border-bottom-0 text-center">
                                        {{__('main.identity_residency_number')}}
                                    </th>
                                    <th class="border-bottom-0 text-center">
                                        {{__('main.passport_number')}}
                                    </th>
                                    <th class="border-bottom-0 text-center">
                                        {{__('main.phone_number')}}
                                    </th>
                                    <th class="border-bottom-0 text-center">
                                        {{__('main.job_title')}}
                                    </th>
                                    <th class="border-bottom-0 text-center">
                                        {{__('main.contract_period')}}
                                    </th>
                                    <th class="border-bottom-0 text-center">
                                        {{__('main.basic_salary')}}
                                    </th>
                                    <th class="border-bottom-0 text-center">
                                        {{__('main.total_salary')}}
                                    </th>
                                    <th class="border-bottom-0 text-center">
                                        {{__('main.created_at')}}
                                    </th>
                                    <th style="width: 5%!important;" class="border-bottom-0 text-center">
                                        {{__('main.control')}}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=0; ?>
                                @foreach ($contracts as $key => $contract)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{ $contract->employee_name }}</td>
                                        <td>{{ $contract->date }}</td>
                                        <td>{{$contract->identity_number}}</td>
                                        <td>{{$contract->passport_number}}</td>
                                        <td>{{$contract->phone_number}}</td>
                                        <td>
                                            @if(!empty($contract->job_title_id))
                                                @if(App::getLocale() == "ar")
                                                    {{$contract->job_title->job_title_ar}}
                                                @else
                                                    {{$contract->job_title->job_title_en}}
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{$contract->contract_period}}</td>
                                        <td>{{$contract->basic_salary}}</td>
                                        <td>{{$contract->total_salary}}</td>
                                        <td>{{$contract->created_at}}</td>
                                        <td>
                                            <a class="btn btn-md btn-success" href="{{route('supervisor.contracts.show',$contract->id)}}">
                                                <i class="fa fa-eye"></i>
                                                {{__('main.show')}}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <span @if(App::getLocale()=="ar")
                                  class="text-center" @else @endif>{{ $contracts->withQueryString()->links() }}</span>
                        </div>

                    @else
                        <p>
                            {{__('main.no')}}
                        </p>
                        @endif

                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {

    });
</script>
