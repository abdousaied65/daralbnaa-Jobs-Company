if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}


$(function() {
    "use strict";

    // top sparklines
    var randomizeArray = function (arg) {
        var array = arg.slice();
        var currentIndex = array.length,
        temporaryValue, randomIndex;

        while (0 !== currentIndex) {
            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex -= 1;

            temporaryValue = array[currentIndex];
            array[currentIndex] = array[randomIndex];
            array[randomIndex] = temporaryValue;
        }
        return array;
    }

    // data for the sparklines that appear below header area
    var sparklineData = [47, 45, 54, 38, 56, 24, 65, 31];

    // topb big chart
    var spark1 = {
        chart: {
            type: 'area',
            height: 50,
            sparkline: {
                enabled: true
            },
        },
        stroke: {
            width: 1
        },
        series: [{
            data: randomizeArray(sparklineData)
        }],
        fill: {
            type: "gradient",
            gradient: {
                gradientToColors: ['var(--chart-color1)'],
                shadeIntensity: 2,
                opacityFrom: 0.7,
                opacityTo: 0.2,
                stops: [0, 100]
            },
        },
        colors: ['var(--chart-color1)'],
    }
    var spark1 = new ApexCharts(document.querySelector("#apexspark1"), spark1);
    spark1.render();

    var spark2 = {
        chart: {
            type: 'area',
            height: 50,
            sparkline: {
            enabled: true
            },
        },
        stroke: {
            width: 1
        },
        series: [{
            data: randomizeArray(sparklineData)
        }],
        fill: {
            type: "gradient",
            gradient: {
                gradientToColors: ['var(--chart-color2)'],
                shadeIntensity: 2,
                opacityFrom: 0.7,
                opacityTo: 0.2,
                stops: [0, 100]
            },
        },
        colors: ['var(--chart-color2)'],
    }
    var spark2 = new ApexCharts(document.querySelector("#apexspark2"), spark2);
    spark2.render();

    var spark3 = {
        chart: {
            type: 'area',
            height: 50,
            sparkline: {
            enabled: true
            },
        },
        stroke: {
            width: 1
        },
        fill: {
            type: "gradient",
            gradient: {
                gradientToColors: ['var(--chart-color3)'],
                shadeIntensity: 2,
                opacityFrom: 0.7,
                opacityTo: 0.2,
                stops: [0, 100]
            },
        },
        colors: ['var(--chart-color3)'],
        series: [{
            data: randomizeArray(sparklineData)
        }],
    }
    var spark3 = new ApexCharts(document.querySelector("#apexspark3"), spark3);
    spark3.render();

    var spark4 = {
        chart: {
            type: 'area',
            height: 50,
            sparkline: {
            enabled: true
            },
        },
        stroke: {
            width: 1
        },
        fill: {
            type: "gradient",
            gradient: {
                gradientToColors: ['var(--chart-color5)'],
                shadeIntensity: 2,
                opacityFrom: 0.7,
                opacityTo: 0.2,
                stops: [0, 100]
            },
        },
        colors: ['var(--chart-color5)'],
        series: [{
            data: randomizeArray(sparklineData)
        }],
    }
    var spark4 = new ApexCharts(document.querySelector("#apexspark4"), spark4);
    spark4.render();

    // Social Media Traffic
    function generateSocialMediaData(baseval, count, yrange) {
        var i = 0;
        var series = [];
        while (i < count) {
            var x = Math.floor(Math.random() * (750 - 1 + 1)) + 1;;
            var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
            var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15;

            series.push([x, y, z]);
            baseval += 86400000;
            i++;
        }
        return series;
    }
    var options = {
        chart: {
            height: 360,
            type: 'bubble',
            toolbar: {
                show: false,
            },
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left',
        },
        colors: ['var(--chart-color1)', 'var(--chart-color2)', 'var(--chart-color3)'],
        dataLabels: {
            enabled: false
        },
        series: [{
                name: 'Facebook',
                data: generateSocialMediaData(new Date('11 Nov 2020 GMT').getTime(), 22, {
                    min: 5,
                    max: 30
                })
            },{
                name: 'Twitter',
                data: generateSocialMediaData(new Date('11 Nov 2020 GMT').getTime(), 31, {
                    min: 5,
                    max: 30
                })
            },{
                name: 'Dribbble',
                data: generateSocialMediaData(new Date('11 Nov 2020 GMT').getTime(), 18, {
                    min: 5,
                    max: 30
                })
            }
        ],
        fill: {
            opacity: 0.8
        },
        xaxis: {
            tickAmount: 12,
            type: 'category',
        },
        yaxis: {
            max: 30
        }
    }
    var chart = new ApexCharts(document.querySelector("#apex-SocialMediaTraffic"),options);
    chart.render();

    // Sessions by Device
    var options = {
        chart: {
            height: 250,
            type: 'donut',
        },
        dataLabels: {
            enabled: false,
        },
        legend: {
            position: 'top',
            horizontalAlign: 'center',
            show: false,
        },
        colors: ['var(--chart-color1)', 'var(--chart-color2)', 'var(--chart-color3)'],
        series: [55, 35, 10],
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    }
    var chart = new ApexCharts(document.querySelector("#apex-SessionsbyDevice"),options);
    chart.render();
});
