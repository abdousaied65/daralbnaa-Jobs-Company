<!-- sidebar -->
<div class="sidebar px-3 py-2 py-md-3">
    <div class="d-flex flex-column h-100">
        <div class="d-flex align-items-center">
            <h4 class="sidebar-title flex-grow-1 text-center justify-content-center">
                <a href="{{route('employee.home')}}">
                    <img src="{{asset('assets/img/logo.png')}}" class="w-50 img-fluid" alt="">
                </a>
            </h4>
        </div>

        <!-- Menu: main ul -->
        <ul class="menu-list flex-grow-1">
            <li><a class="m-link {{ Request::is('*/home') ? 'active' : '' }}" href="{{route('employee.home')}}"><i
                        class="fa fa-dashboard"></i>
                    <span>{{trans('main.employee_dashboard')}}</span>
                </a>
            </li>

            <li><a class="m-link {{ Request::is('*/contracts') ? 'active' : '' }}" href="{{route('employee.contracts.index')}}"><i
                        class="fa fa-copy"></i>
                    <span>{{trans('main.contracts')}}</span>
                </a>
            </li>

            <li>
                <a class="m-link {{ Request::is('*/personal-data') ? 'active' : '' }}"
                   href="{{route('employee.personal.data',Auth::user()->id)}}">
                    <i class="fa fa-copy"></i>
                    <span>{{trans('main.personal_data')}}</span>
                </a>
            </li>

            <li>
                <a class="m-link" href="{{ route('employee.logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-power-off"></i>
                    <span> {{__('main.logout')}} </span>
                </a>
                <form id="logout-form" action="{{ route('employee.logout') }}" method="POST"
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
