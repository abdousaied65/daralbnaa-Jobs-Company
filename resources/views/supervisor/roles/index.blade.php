@extends('supervisor.layouts.master')
<!-- Internal Data table css -->
<style>
    i.la {
        font-size: 15px !important;
    }
    tfoot {
        display: table-row-group;
    }

</style>
@section('content')
    @if (session('success'))
        <div class="alert alert-sm alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row row-sm">
        <div class="col-12 mb-5">
            <div class="card">
                <div class="card-header py-3 bg-transparent border-bottom-0">
                    <h6 class="card-title mb-0">
                        <strong> {{__('main.show_all_privileges')}} </strong>
                    </h6>
                </div>
                <div class="card-body">
                    <table id="myTable"
                           class="table table-bordered table-condensed text-center justify-content-center w-100 display dataTable">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">{{__('main.privilege_name')}}</th>
                            <th class="text-center">{{__('main.control')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach ($roles as $role)
                            <tr class="text-center">
                                <td>{{ ++$i }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @can('تعديل صلاحية')
                                        <a class="btn btn-primary btn-md"
                                           href="{{ route('supervisor.roles.edit', $role->id) }}"><i
                                                class="fa fa-edit"></i> {{__('main.edit')}} </a>
                                    @endcan
                                    @can('حذف صلاحية')
                                        @if ($role->name != 'مدير النظام')
                                            <a class="modal-effect btn btn-md btn-danger delete_role"
                                               role_id="{{ $role->id }}"
                                               role_name="{{ $role->name }}" data-bs-toggle="modal" data-bs-target="#exampleModal20" href="#"
                                               title="Delete"><i
                                                    class="fa fa-trash"></i> {{__('main.delete')}} </a>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="text-center">
                            <span @if(App::getLocale()=="ar")
                                  class="text-center" @else @endif>{{ $roles->withQueryString()->links() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal20" tabindex="-1" aria-labelledby="exampleModalLabel20"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title w-100" id="exampleModalLabel20">
                            {{__('main.delete_dept')}}
                        </h5>
                        <button type="button" class="btn btn-default btn-md btn-close" data-bs-dismiss="modal">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                    <div class="modal-body text-right">
                        <form action="{{ route('supervisor.roles.destroy', 'test') }}" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <p>{{__('main.sure_delete')}}</p><br>
                                <input type="hidden" name="role_id" id="role_id" value="">
                                <input class="form-control" name="rolename" id="rolename" type="text" readonly>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">{{__('main.cancel')}}</button>
                                <button type="submit" class="btn btn-danger">{{__('main.delete')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {


        $('tfoot').each(function () {
            $(this).insertAfter($(this).siblings('thead'));
        });

        $('.delete_role').on('click', function () {
            var role_id = $(this).attr('role_id');
            var role_name = $(this).attr('role_name');
            $('.modal-body #role_id').val(role_id);
            $('.modal-body #rolename').val(role_name);
        });
        $('#myTable tfoot tr th:nth-child(2)').html('<select id="role_name" class="form-control form-control-lg">@foreach($roles as $role)<option value="{{$role->id}}">{{$role->name}}</option>@endforeach</select>');

        $('#myTable').DataTable({
            "columnDefs": [
                {"orderable": false, "targets": [2]}
            ],
            "paging": false,
            initComplete: function () {
                this.api().columns().every(function () {
                    var that = this;
                    $('input[type="text"],input[type="date"]', this.footer()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                    $('select', this.footer()).on('change', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
            }
        });
    });
</script>
