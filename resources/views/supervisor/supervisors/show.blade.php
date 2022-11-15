@extends('supervisor.layouts.master')
<style>
    i.la {
        font-size: 15px !important;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-3 bg-transparent border-bottom-0">
                    <h6 class="card-title mb-0"><strong>
                            {{__('main.show_supervisor')}}
                        </strong></h6>
                </div>
                <div class="card-body">
                    <table id="myTable" class="table display dataTable table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center"> {{__('main.supervisor_name')}} {{__('main.arabic')}}</th>
                            <th class="text-center"> {{__('main.supervisor_name')}} {{__('main.english')}}</th>
                            <th class="text-center">
                                {{__('main.email')}}
                            </th>
                            <th class="text-center">
                                {{__('main.phone_number')}}
                            </th>

                            <th class="text-center">
                                {{__('main.dept_name')}}
                            </th>
                            <th class="text-center">
                                {{__('main.job_title')}}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-top-0 text-center">
                            <td>{{ $supervisor->supervisor_name_ar }}</td>
                            <td>{{ $supervisor->supervisor_name_en }}</td>
                            <td>{{ $supervisor->email }}</td>
                            <td>{{ $supervisor->phone_number }}</td>
                            <td>
                                @if(!empty($supervisor->dept_id))
                                    @if(App::getLocale() == "ar")
                                        <a href="{{route('supervisor.depts.show',$supervisor->dept->id)}}">
                                            {{$supervisor->dept->dept_name_ar}}
                                        </a>
                                    @else
                                        <a href="{{route('supervisor.depts.show',$supervisor->dept->id)}}">
                                            {{$supervisor->dept->dept_name_en}}
                                        </a>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if(!empty($supervisor->job_title_id))
                                    @if(App::getLocale() == "ar")
                                        <a href="{{route('supervisor.job_titles.show',$supervisor->job_title->id)}}">
                                            {{$supervisor->job_title->job_title_ar}}
                                        </a>
                                    @else
                                        <a href="{{route('supervisor.job_titles.show',$supervisor->job_title->id)}}">
                                            {{$supervisor->job_title->job_title_en}}
                                        </a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="clearfix"></div>
                    <table id="myTable" class="table display dataTable table-bordered"
                           style="margin-top: 20px!important;">
                        <thead>
                        <tr>
                            <th class="text-center">
                                {{__('main.projects')}}
                            </th>

                            <th class="text-center">
                                {{__('main.profile_picture')}}
                            </th>

                            <th class="text-center">
                                {{__('main.privilege')}}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-top-0 text-center">
                            <td>
                                @foreach($supervisor->projects as $key => $project)
                                    @if(App::getLocale() == "ar")
                                        <p>
                                            - <a href="{{route('supervisor.projects.show',$project->id)}}">
                                                {{$project->project_name_ar}}
                                            </a>
                                        </p>
                                    @else
                                        <p>
                                            - <a href="{{route('supervisor.projects.show',$project->id)}}">
                                                {{$project->project_name_en}}
                                            </a>
                                        </p>
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @if(empty($supervisor->profile_pic))
                                    <img data-bs-toggle="modal" href="javascript:;"
                                         data-bs-target="#exampleModal10"
                                         src="{{asset('assets/img/guest.png')}}"
                                         style="width: 70px;cursor: pointer; height: 70px;border-radius: 100%; padding: 3px; border: 1px solid #aaa;">
                                @else
                                    <img data-bs-toggle="modal" href="javascript:;"
                                         data-bs-target="#exampleModal10"
                                         src="{{asset($supervisor->profile_pic)}}"
                                         style="width: 70px;cursor: pointer; height: 70px;border-radius: 100%; padding: 3px; border: 1px solid #aaa;">
                                @endif
                            </td>
                            <td>
                                {{$supervisor->role_name}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal10" tabindex="-1" aria-labelledby="exampleModalLabel10"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title w-100" id="exampleModalLabel10">
                        {{__('main.profile_picture')}}
                    </h5>
                    <button type="button" class="btn btn-default btn-md btn-close" data-bs-dismiss="modal">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <img id="image_larger" alt="image" style="width: 100%; "/>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('img').on('click', function () {
            var image_larger = $('#image_larger');
            var path = $(this).attr('src');
            $(image_larger).prop('src', path);
        });
    });
</script>

