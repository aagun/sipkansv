/**
 *
 * @param chartConfig object {tooltipSeries, data, color: {primary, secondary}}
 * @param displayConfig object {idCanvas, idTitle, idSubTitle}
 * @returns {*}
 */
function apexAreaChart(chartConfig, displayConfig) {
    const options = {
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
                'Januari', 'Februari', 'Maret', 'April',
                'Mei', 'Juni', 'Juli', 'Agustus',
                'September', 'Oktober', 'November', 'Desember'
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
        return chart;
    }

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

    return apexAreaChart(chartConfig, displayConfig);

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

    return apexAreaChart(chartConfig, displayConfig);
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
        data: [15, 1, 20, 3, 1, 5, 1, 2, 4, 10, 11, 4],
        color: {
            primary: "#02e568",
            secondary: "#02e568"
        }
    }

    return apexAreaChart(chartConfig, displayConfig);
}

chartPengawasanRutin();
chartPengawasanInsidental();
chartPengawasanPatroli();
