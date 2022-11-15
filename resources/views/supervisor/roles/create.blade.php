@extends('supervisor.layouts.master')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 25px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 5px;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 0px;
        bottom: 0px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

</style>
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
                            {{__('main.add_new_privilege')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    <form class="row g-3" action="{{route('supervisor.roles.store','test')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" value="supervisor-web" name="guard_name"/>

                        <div class="row">
                            <div class="col-xs-6 col-md-6 col-md-6">
                                <div class="form-group">
                                    <p> {{__('main.privilege_name')}} </p>
                                    {!! Form::text('name', null, array('class' => 'form-control form-control-lg','required')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-condensed table-hover text-center">
                                <thead>
                                <tr>
                                    <th class="text-center"> # </th>
                                    <th class="text-center"> {{__('main.privilege_name')}} </th>
                                    <th class="text-center">{{__('main.show_export')}}</th>
                                    <th class="text-center">{{__('main.add')}}</th>
                                    <th class="text-center">{{__('main.edit')}}</th>
                                    <th class="text-center">{{__('main.delete')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        {{__('main.supervisors')}}
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="1">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="2">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="3">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="4">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        {{__('main.employees')}}
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="5">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="6">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="7">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="8">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>
                                        {{__('main.roles')}}
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="9">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="10">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="11">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="12">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>
                                        {{__('main.depts')}}
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="13">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="14">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="15">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="16">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>
                                        {{__('main.projects')}}
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="17">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="18">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="19">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="20">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>
                                        {{__('main.job_titles')}}
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="21">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="22">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="23">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="24">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>
                                        {{__('main.nationalities')}}
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="25">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="26">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="27">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="28">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>
                                        {{__('main.offers')}}
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="29">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="30">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="31">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="32">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>

                                <tr>
                                    <td>9</td>
                                    <td>
                                        {{__('main.applications')}}
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="33">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="34">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="35">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="36">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>

                                <tr>
                                    <td>10</td>
                                    <td>
                                        {{__('main.contracts')}}
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="37">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="38">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="39">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="40">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>
                                        {{__('main.employees_transfers')}}
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="41">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="42">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="43">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="permission[]" value="44">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-md-12 text-center">
                                <button type="button" id="check_all" class="btn btn-danger">{{__('main.select_all')}} </button>
                                <button type="submit" class="btn btn-info">{{__('main.confirm')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- main-content closed -->
    <script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
    <script>
        $('#check_all').click(function () {
            $('input[type=checkbox]').prop('checked', true);
        });
    </script>
@endsection
