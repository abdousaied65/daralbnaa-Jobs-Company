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
<?php
$year_applications = array();
for ($m = 1; $m <= 12; $m++) {
    $month = date('Y') . '-' . $m;
    $first = date('Y-m-01', strtotime($month));
    $last = date('Y-m-t', strtotime($month));
    $month_applications =
        App\Models\Application::whereBetween('date', [$first, date('Y-m-d', strtotime($last . ' +1 day'))])
            ->count();
    array_push($year_applications, $month_applications);
}
?>
<script>
    var options = {
        chart: {
            height: 350,
            type: 'line',
            toolbar: {
                show: true,
            },
        },
        colors: ['var(--chart-color1)'],
        series: [{
            name: '{{__('main.applications')}}',
            type: 'column',
            data: [{{$year_applications[0]}},{{$year_applications[1]}},{{$year_applications[2]}},{{$year_applications[3]}},
                {{$year_applications[4]}},{{$year_applications[5]}},{{$year_applications[6]}},{{$year_applications[7]}},
                {{$year_applications[8]}},{{$year_applications[9]}},{{$year_applications[10]}},{{$year_applications[11]}},]
        }],

        labels: ["{{__('main.jan')}}", "{{__('main.feb')}}", "{{__('main.mar')}}",
            "{{__('main.apr')}}", "{{__('main.may')}}", "{{__('main.jun')}}", "{{__('main.jul')}}",
            "{{__('main.aug')}}", "{{__('main.sep')}}", "{{__('main.oct')}}", "{{__('main.nov')}}", "{{__('main.dec')}}"],
        xaxis: {
            type: 'month'
        },
        yaxis: [{
            title: {
                text: '{{__('main.applications')}}',
            },
        }]
    }
    var chart = new ApexCharts(document.querySelector("#apex-AudienceOverview"), options);
    chart.render();
</script>
