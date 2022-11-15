<link rel="stylesheet" href="{{asset('admin-assets/css/al.style.min.css')}}">
<link rel="stylesheet" href="{{asset('admin-assets/css/layout.a.min.css')}}">
<link href="{{asset('admin-assets/css/dataTables.min.css')}}" rel="stylesheet"/>
<link href="{{asset('admin-assets/css/select2.min.css')}}" rel="stylesheet" />
<link href="{{asset('admin-assets/css/bootstrap-select.css')}}" rel="stylesheet" />

<style>
    @if(App::getLocale() == "ar")
        @font-face {
            font-family: 'Almarai';
            src: url("{{asset('fonts/Almarai.ttf')}}");
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Almarai' !important;
        }
        body, html {
            font-family: 'Almarai';
        }
        #layout-a .sidebar.sidebar-mini .menu-list .sub-menu {
            right: 61px!important;
        }
    @else
        @font-face {
            font-family: 'IBMPlexSans';
            src: url("{{asset('fonts/IBMPlexSans.ttf')}}");
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'IBMPlexSans' !important;
        }
        body, html {
            font-family: 'IBMPlexSans';
        }
        #layout-a .sidebar.sidebar-mini .menu-list .sub-menu {
            left: 61px!important;
        }
    @endif
    .bootstrap-select{
        width: 100%!important;
        border: 1px solid #444!important; color: #444!important;
    }
    .filter-option .filter-option-inner .filter-option-inner-inner{
        color: #444!important;
    }

    .btn.dropdown-toggle.bs-placeholder,.btn.dropdown-toggle{
        height: 50px !important;
    }

    .bs-searchbox input[type="text"]{
        height: 45px!important;
    }
</style>
