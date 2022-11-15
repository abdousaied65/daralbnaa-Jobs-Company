<!-- sidebar -->
<div class="sidebar px-3 py-2 py-md-3">
    <div class="d-flex flex-column h-100">
        <div class="d-flex align-items-center">
            <h4 class="sidebar-title flex-grow-1 text-center justify-content-center">
                <a href="{{route('supervisor.home')}}">
                    <img src="{{asset('assets/img/logo.png')}}" class="w-50 img-fluid" alt="">
                </a>
            </h4>
        </div>

        <!-- Menu: main ul -->
        <ul class="menu-list flex-grow-1">
            <li><a class="m-link {{ Request::is('*/home') ? 'active' : '' }}" href="{{route('supervisor.home')}}"><i
                        class="fa fa-dashboard"></i>
                    <span>{{trans('main.admin_dashboard')}}</span>
                </a>
            </li>
            @can('اضافة ادارة','عرض ادارة')
                <li class="collapsed">
                    <a class="m-link  {{ Request::is('*/depts','*/depts/*') ? 'active' : '' }}"
                       data-bs-toggle="collapse" data-bs-target="#menu-depts" href="#"><i
                            class="fa fa-code-fork"></i> <span>
                        {{__('main.depts')}}
                    </span> </a>
                    <ul class="sub-menu collapse {{ Request::is('*/depts','*/depts/*') ? 'show' : '' }}"
                        id="menu-depts">
                        @can('اضافة ادارة')
                            <li><a class="ms-link {{ Request::is('*/depts/create') ? 'active' : '' }}"
                                   href="{{route('supervisor.depts.create')}}">{{__('main.add_new')}}</a></li>
                        @endcan
                        @can('عرض ادارة')
                            <li><a class="ms-link {{ Request::is('*/depts') ? 'active' : '' }}"
                                   href="{{route('supervisor.depts.index')}}">{{__('main.show_all')}}</a></li>
                        @endcan

                    </ul>
                </li>
            @endcan

            @can('اضافة مسمى وظيفى','عرض مسمى وظيفى')
                <li class="collapsed">
                    <a class="m-link  {{ Request::is('*/job_titles','*/job_titles/*') ? 'active' : '' }}"
                       data-bs-toggle="collapse" data-bs-target="#menu-job-titles" href="#"><i
                            class="fa fa-graduation-cap"></i> <span>
                        {{__('main.job_titles')}}
                    </span> </a>
                    <ul class="sub-menu collapse {{ Request::is('*/job_titles','*/job_titles/*') ? 'show' : '' }}"
                        id="menu-job-titles">
                        @can('اضافة مسمى وظيفى')
                            <li><a class="ms-link {{ Request::is('*/job_titles/create') ? 'active' : '' }}"
                                   href="{{route('supervisor.job_titles.create')}}">{{__('main.add_new')}}</a></li>
                        @endcan
                        @can('عرض مسمى وظيفى')
                            <li><a class="ms-link {{ Request::is('*/job_titles') ? 'active' : '' }}"
                                   href="{{route('supervisor.job_titles.index')}}">{{__('main.show_all')}}</a></li>
                        @endcan

                    </ul>
                </li>
            @endcan

            @can('اضافة مشروع','عرض مشروع')
                <li class="collapsed">
                    <a class="m-link {{ Request::is('*/projects','*/projects/*') ? 'active' : '' }}"
                       data-bs-toggle="collapse" data-bs-target="#menu-projects" href="#"><i
                            class="fa fa-diamond"></i> <span>
                        {{__('main.projects')}}
                    </span> </a>
                    <ul class="sub-menu collapse {{ Request::is('*/projects','*/projects/*') ? 'show' : '' }}"
                        id="menu-projects">
                        @can('اضافة مشروع')
                            <li><a class="ms-link {{ Request::is('*/projects/create') ? 'active' : '' }}"
                                   href="{{route('supervisor.projects.create')}}">{{__('main.add_new')}}</a></li>
                        @endcan
                        @can('عرض مشروع')
                            <li><a class="ms-link {{ Request::is('*/projects') ? 'active' : '' }}"
                                   href="{{route('supervisor.projects.index')}}">{{__('main.show_all')}}</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('اضافة مشرف','عرض مشرف')
                <li class="collapsed">
                    <a class="m-link {{ Request::is('*/supervisors','*/supervisors/*') ? 'active' : '' }}"
                       data-bs-toggle="collapse" data-bs-target="#menu-supervisors" href="#"><i
                            class="fa fa-users"></i> <span>
                        {{__('main.supervisors')}}
                    </span> </a>
                    <ul class="sub-menu collapse {{ Request::is('*/supervisors','*/supervisors/*') ? 'show' : '' }}"
                        id="menu-supervisors">
                        @can('اضافة مشرف')
                            <li><a class="ms-link {{ Request::is('*/supervisors/create') ? 'active' : '' }}"
                                   href="{{route('supervisor.supervisors.create')}}">{{__('main.add_new')}}</a></li>
                        @endcan
                        @can('عرض مشرف')
                            <li><a class="ms-link {{ Request::is('*/supervisors') ? 'active' : '' }}"
                                   href="{{route('supervisor.supervisors.index')}}">{{__('main.show_all')}}</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('اضافة صلاحية','عرض صلاحية')
                <li class="collapsed">
                    <a class="m-link {{ Request::is('*/roles','*/roles/*') ? 'active' : '' }}"
                       data-bs-toggle="collapse" data-bs-target="#menu-roles" href="#"><i
                            class="fa fa-lock"></i> <span>
                        {{__('main.roles')}}
                    </span> </a>
                    <ul class="sub-menu collapse {{ Request::is('*/roles','*/roles/*') ? 'show' : '' }}"
                        id="menu-roles">
                        @can('اضافة صلاحية')
                            <li><a class="ms-link {{ Request::is('*/roles/create') ? 'active' : '' }}"
                                   href="{{route('supervisor.roles.create')}}">{{__('main.add_new')}}</a></li>
                        @endcan
                        @can('عرض صلاحية')
                            <li><a class="ms-link {{ Request::is('*/roles') ? 'active' : '' }}"
                                   href="{{route('supervisor.roles.index')}}">{{__('main.show_all')}}</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('اضافة جنسية','عرض جنسية')
                <li class="collapsed">
                    <a class="m-link {{ Request::is('*/nationalities','*/nationalities/*') ? 'active' : '' }}"
                       data-bs-toggle="collapse" data-bs-target="#menu-nationalities" href="#"><i
                            class="fa fa-id-badge"></i> <span>
                        {{__('main.nationalities')}}
                    </span> </a>
                    <ul class="sub-menu collapse {{ Request::is('*/nationalities','*/nationalities/*') ? 'show' : '' }}"
                        id="menu-nationalities">
                        @can('اضافة جنسية')
                            <li><a class="ms-link {{ Request::is('*/nationalities/create') ? 'active' : '' }}"
                                   href="{{route('supervisor.nationalities.create')}}">{{__('main.add_new')}}</a></li>
                        @endcan
                        @can('عرض جنسية')
                            <li><a class="ms-link {{ Request::is('*/nationalities') ? 'active' : '' }}"
                                   href="{{route('supervisor.nationalities.index')}}">{{__('main.show_all')}}</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('اضافة موظف','عرض موظف')
                <li class="collapsed">
                    <a class="m-link {{ Request::is('*/employees','*/employees/*') ? 'active' : '' }}"
                       data-bs-toggle="collapse" data-bs-target="#menu-employees" href="#"><i
                            class="fa fa-users"></i> <span>
                        {{__('main.employees')}}
                    </span> </a>
                    <ul class="sub-menu collapse {{ Request::is('*/employees','*/employees/*') ? 'show' : '' }}"
                        id="menu-employees">
{{--                        @can('اضافة موظف')--}}
{{--                            <li><a class="ms-link {{ Request::is('*/employees/create') ? 'active' : '' }}"--}}
{{--                                   href="{{route('supervisor.employees.create')}}">{{__('main.add_new')}}</a></li>--}}
{{--                        @endcan--}}
                        @can('عرض موظف')
                            <li><a class="ms-link {{ Request::is('*/employees') ? 'active' : '' }}"
                                   href="{{route('supervisor.employees.index')}}">{{__('main.show_all')}}</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('اضافة عرض وظيفي','عرض عرض وظيفي')
                <li class="collapsed">
                    <a class="m-link {{ Request::is('*/offers','*/offers/*') ? 'active' : '' }}"
                       data-bs-toggle="collapse" data-bs-target="#menu-offers" href="#"><i
                            class="fa fa-gift"></i> <span>
                        {{__('main.offers')}}
                    </span> </a>
                    <ul class="sub-menu collapse {{ Request::is('*/offers','*/offers/*') ? 'show' : '' }}"
                        id="menu-offers">
                        @can('اضافة عرض وظيفي')
                            <li><a class="ms-link {{ Request::is('*/offers/create') ? 'active' : '' }}"
                                   href="{{route('supervisor.offers.create')}}">{{__('main.add_new')}}</a></li>
                        @endcan
                        @can('عرض عرض وظيفي')
                            <li><a class="ms-link {{ Request::is('*/offers') ? 'active' : '' }}"
                                   href="{{route('supervisor.offers.index')}}">{{__('main.show_all')}}</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('اضافة قرار توظيف','عرض قرار توظيف')
                <li class="collapsed">
                    <a class="m-link {{ Request::is('*/applications','*/applications/*') ? 'active' : '' }}"
                       data-bs-toggle="collapse" data-bs-target="#menu-applications" href="#"><i
                            class="fa fa-tasks"></i> <span>
                        {{__('main.applications')}}
                    </span> </a>
                    <ul class="sub-menu collapse {{ Request::is('*/applications','*/applications/*') ? 'show' : '' }}"
                        id="menu-applications">
                        @can('اضافة قرار توظيف')
                            <li><a class="ms-link {{ Request::is('*/applications/create') ? 'active' : '' }}"
                                   href="{{route('supervisor.applications.create')}}">{{__('main.add_new')}}</a></li>
                        @endcan
                        @can('عرض قرار توظيف')
                            <li><a class="ms-link {{ Request::is('*/applications') ? 'active' : '' }}"
                                   href="{{route('supervisor.applications.index')}}">{{__('main.show_all')}}</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan

{{--            @can('اضافة قرار توظيف','عرض قرار توظيف')--}}
                <li class="collapsed">
                    <a class="m-link {{ Request::is('*/direct-work','*/direct-work/*') ? 'active' : '' }}"
                       data-bs-toggle="collapse" data-bs-target="#menu-direct-work" href="#"><i
                            class="fa fa-calendar-check-o"></i> <span>
                        {{__('main.directWork')}}
                    </span> </a>
                    <ul class="sub-menu collapse {{ Request::is('*/direct-work','*/direct-work/*') ? 'show' : '' }}"
                        id="menu-direct-work">
{{--                        @can('اضافة قرار توظيف')--}}
                            <li><a class="ms-link {{ Request::is('*/direct-work') ? 'active' : '' }}"
                                   href="{{route('supervisor.direct-work.index')}}">{{__('main.show_all')}}</a></li>
{{--                        @endcan--}}
                    </ul>
                </li>
{{--            @endcan--}}



            @can('اضافة عقد عمل','عرض عقد عمل')
                <li class="collapsed">
                    <a class="m-link {{ Request::is('*/contracts','*/contracts/*') ? 'active' : '' }}"
                       data-bs-toggle="collapse" data-bs-target="#menu-contracts" href="#"><i
                            class="fa fa-copy"></i> <span>
                        {{__('main.contracts')}}
                    </span> </a>
                    <ul class="sub-menu collapse {{ Request::is('*/contracts','*/contracts/*') ? 'show' : '' }}"
                        id="menu-contracts">
{{--                        @can('اضافة عقد عمل')--}}
{{--                            <li><a class="ms-link {{ Request::is('*/contracts/create') ? 'active' : '' }}"--}}
{{--                                   href="{{route('supervisor.contracts.create')}}">{{__('main.add_new')}}</a></li>--}}
{{--                        @endcan--}}
                        @can('عرض عقد عمل')
                            <li><a class="ms-link {{ Request::is('*/contracts') ? 'active' : '' }}"
                                   href="{{route('supervisor.contracts.index')}}">{{__('main.show_all')}}</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('اضافة طلب نقل','عرض طلب نقل')
                <li class="collapsed">
                    <a class="m-link {{ Request::is('*/employees-transfers','*/employees-transfers/*') ? 'active' : '' }}"
                       data-bs-toggle="collapse" data-bs-target="#menu-employees-transfers" href="#"><i
                            class="fa fa-arrows"></i> <span>
                        {{__('main.employees_transfers')}}
                    </span> </a>
                    <ul class="sub-menu collapse {{ Request::is('*/employees-transfers','*/employees-transfers/*') ? 'show' : '' }}"
                        id="menu-employees-transfers">
                        @can('اضافة طلب نقل')
                            <li><a class="ms-link {{ Request::is('*/employees-transfers/create') ? 'active' : '' }}"
                                   href="{{route('supervisor.employees_transfers.create')}}">{{__('main.add_new')}}</a>
                            </li>
                        @endcan
                        @can('عرض طلب نقل')
                            <li><a class="ms-link {{ Request::is('*/employees-transfers') ? 'active' : '' }}"
                                   href="{{route('supervisor.employees_transfers.index')}}">{{__('main.show_all')}}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('تقارير العقود')
                <li class="collapsed">
                    <a class="m-link {{ Request::is('*/contracts-*') ? 'active' : '' }}"
                       data-bs-toggle="collapse" data-bs-target="#menu-contracts-reports" href="#"><i
                            class="fa fa-copy"></i> <span>
                        {{__('main.contracts_reports')}}
                    </span> </a>
                    <ul class="sub-menu collapse {{ Request::is('*/contracts-*') ? 'show' : '' }}"
                        id="menu-contracts-reports">
                        <li><a class="ms-link {{ Request::is('*/contracts-waiting') ? 'active' : '' }}"
                               href="{{route('contracts.waiting')}}">{{__('main.contracts_waiting_report')}}</a>
                        </li>
                        <li><a class="ms-link {{ Request::is('*/contracts-pending') ? 'active' : '' }}"
                               href="{{route('contracts.pending')}}">{{__('main.contracts_pending_report')}}</a>
                        </li>
                        <li><a class="ms-link {{ Request::is('*/contracts-approved') ? 'active' : '' }}"
                               href="{{route('contracts.approved')}}">{{__('main.contracts_approved_report')}}</a>
                        </li>
                        <li><a class="ms-link {{ Request::is('*/contracts-declined') ? 'active' : '' }}"
                               href="{{route('contracts.declined')}}">{{__('main.contracts_declined_report')}}</a>
                        </li>
                        <li><a class="ms-link {{ Request::is('*/contracts-expired') ? 'active' : '' }}"
                               href="{{route('contracts.expired')}}">{{__('main.contracts_expired_report')}}</a>
                        </li>
                        <li><a class="ms-link {{ Request::is('*/contracts-custom') ? 'active' : '' }}"
                               href="{{route('contracts.custom')}}">{{__('main.contracts_custom_report')}}</a>
                        </li>
                    </ul>
                </li>
            @endcan

            <li>
                <a class="m-link" href="{{ route('supervisor.logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-power-off"></i>
                    <span> {{__('main.logout')}} </span>
                </a>
                <form id="logout-form" action="{{ route('supervisor.logout') }}" method="POST"
                      style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>

        <!-- Menu: menu collepce btn -->
        <button type="button" class="btn btn-link sidebar-mini-btn text-light">
            <span><i class="fa fa-bars"></i></span>
        </button>
    </div>
</div>
