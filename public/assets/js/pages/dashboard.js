function sumChartSeriesData(data) {
    return data.reduce((prev, curr) => prev + Number(curr), 0)
}

function doUpdateDataChart(chart, chartConfig, displayConfig, data) {
    const totalData = sumChartSeriesData(data);
    $(`#${displayConfig.subTitle.id}`).text(totalData);
    chart.updateSeries([{
        name: displayConfig.title.value,
        data,
        color: chartConfig.color.primary
    }]);
}

/**
 *
 * @param chartConfig object {tooltipSeries, data, color: {primary, secondary}}
 * @param displayConfig object {idCanvas, idTitle, idSubTitle}
 * @returns {*}
 */
function apexAreaChartCountPivot(chartConfig, displayConfig) {
    const options = {
        noData: {
            text: 'Memuat data...'
        },
        chart: {
            height: "100%",
            maxWidth: "100%",
            type: "area",
            fontFamily: "Inter, sans-serif",
            dropShadow: {
                enabled: false,
            },
            toolbar: {
                show: false,
            },
        },
        tooltip: {
            enabled: true,
            x: {
                show: false,
            },
        },
        fill: {
            type: "gradient",
            gradient: {
                opacityFrom: 0.55,
                opacityTo: 0,
                shade: chartConfig.color.secondary,
                gradientToColors: [chartConfig.color.secondary],
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            width: 6,
        },
        grid: {
            show: false,
            strokeDashArray: 4,
            padding: {
                left: 2,
                right: 2,
                top: 0
            },
        },
        series: [
            {
                name: displayConfig.title.value,
                data: chartConfig.data,
                color: chartConfig.color.primary,
            },
        ],
        xaxis: {
            categories: [
                'Januari ' + new Date().getFullYear(),
                'Februari ' + new Date().getFullYear(),
                'Maret ' + new Date().getFullYear(),
                'April ' + new Date().getFullYear(),
                'Mei ' + new Date().getFullYear(),
                'Juni ' + new Date().getFullYear(),
                'Juli ' + new Date().getFullYear(),
                'Agustus ' + new Date().getFullYear(),
                'September ' + new Date().getFullYear(),
                'Oktober ' + new Date().getFullYear(),
                'November ' + new Date().getFullYear(),
                'Desember ' + new Date().getFullYear()
            ],
            labels: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
        },
        yaxis: {
            show: false,
        },
    }

    const total = chartConfig.data.reduce((prev, acc) => prev + acc, 0);
    document.getElementById(displayConfig.subTitle.id).innerText = total.toString();
    document.getElementById(displayConfig.title.id).innerText = displayConfig.title.value;

    const canvas = document.getElementById(chartConfig.id);
    if (canvas && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(canvas, options);
        chart.render();
        return {chart, canvas};
    }

    return {canvas, chart: null};
}

function chartPengawasanRutin() {
    const displayConfig = {
        title: {
            id: "titlePengawasanRutin",
            value: "Pengawasan Rutin"
        },
        subTitle: {
            id: "subTitlePengawasanRutin"
        }
    }

    const chartConfig = {
        id: "canvasPengawasanRutin",
        data: [5, 10, 2, 3, 1, 10, 1, 2, 4, 10, 11, 4],
        color: {
            primary: "#09afed",
            secondary: "#09afed"
        }
    }

    const {chart} = apexAreaChartCountPivot(chartConfig, displayConfig);

    _sipkan_http.get('/activity-reports/stats/count/rutin')
        .then(response => {
            const data = Object.values(response.data.data);
            doUpdateDataChart(chart, chartConfig, displayConfig, data);
        });

}

function chartPengawasanInsidental() {
    const displayConfig = {
        title: {
            id: "titlePengawasanInsidental",
            value: "Pengawasan Insidental"
        },
        subTitle: {
            id: "subTitlePengawasanInsidental"
        }
    }

    const chartConfig = {
        id: "canvasPengawasanInsidental",
        data: [5, 1, 2, 3, 1, 1, 1, 2, 4, 10, 11, 4],
        color: {
            primary: "#ebaa07",
            secondary: "#ebaa07"
        }
    }

    const {chart} = apexAreaChartCountPivot(chartConfig, displayConfig);

    _sipkan_http.get('/activity-reports/stats/count/insidental')
        .then(response => {
            const data = Object.values(response.data.data);
            doUpdateDataChart(chart, chartConfig, displayConfig, data);
        });
}

function chartPengawasanPatroli() {
    const displayConfig = {
        title: {
            id: "titlePengawasanPatroli",
            value: "Pengawasan Patroli"
        },
        subTitle: {
            id: "subTitlePengawasanPatroli"
        }
    }

    const chartConfig = {
        id: "canvasPengawasanPatroli",
        data: [],
        color: {
            primary: "#02e568",
            secondary: "#02e568"
        }
    }

    const {chart} = apexAreaChartCountPivot(chartConfig, displayConfig);

    _sipkan_http.get('/activity-reports/stats/count/patroli')
        .then(response => {
            const data = Object.values(response.data.data);
            doUpdateDataChart(chart, chartConfig, displayConfig, data);
        });
}

$(document).ready(function() {
    chartPengawasanRutin();
    chartPengawasanInsidental();
    chartPengawasanPatroli();
});
