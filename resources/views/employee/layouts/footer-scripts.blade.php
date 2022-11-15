<script src="{{asset('admin-assets/bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('admin-assets/bundles/apexcharts.bundle.js')}}"></script>
<script src="{{asset('admin-assets/js/template.js')}}"></script>
<script src="{{asset('admin-assets/js/page/index.js')}}"></script>
@if(App::getLocale() == "ar")
    <script src="{{asset('admin-assets/js-rtl/dataTables.bundle.js')}}"></script>
@else
    <script src="{{asset('admin-assets/js/dataTables.bundle.js')}}"></script>
@endif

<script src="{{asset('admin-assets/js/select2.min.js')}}"></script>
<script src="{{asset('admin-assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin-assets/js/bootstrap-select.js')}}"></script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    $('.js-example-basic-single').select2();
</script>
