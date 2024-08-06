@props(['applications'])

<div class="w-full h-full p-4 bg-white rounded-lg shadow dark:bg-gray-800 md:p-6">
    <div class="flex justify-between mb-3">
        <div class="flex items-center justify-center">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Applications</h5>
            <svg data-popover-target="chart-info" data-popover-placement="bottom"
                class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z" />
            </svg>
            <div data-popover id="chart-info" role="tooltip"
                class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                <div class="p-3 space-y-2">
                    <h3 class="font-semibold text-gray-900 dark:text-white">Application</h3>
                    <p>Request to participate in the event.</p>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Approved Application</h3>
                    <p>Application accepted for participation in the event.</p>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Rejected Application</h3>
                    <p>Application declined for participation in the event.</p>
                </div>
                <div data-popper-arrow></div>
            </div>
        </div>
    </div>

    <!-- Donut Chart -->
    <div class="py-6" id="donut-chart"></div>

    <div class="grid items-center justify-between grid-cols-1 border-t border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between pt-5">
            <a href="#"
                class="inline-flex items-center px-3 py-2 text-sm font-semibold text-blue-600 uppercase rounded-lg hover:text-blue-700 dark:hover:text-blue-500 hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                Application analysis
                <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
            </a>
        </div>
    </div>
</div>

<script type="module">
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded and parsed');

        const getChartOptions = () => {
            return {
                series: [
                    {{ $applications->where('applicant_id', Auth::id())->where('status', 'approve')->count() }},
                    {{ $applications->where('applicant_id', Auth::id())->where('status', 'rejected')->count() }},
                    {{ $applications->where('applicant_id', Auth::id())->where('status', 'pending')->count() }}
                ],
                colors: ["#1C64F2", "#16BDCA", "#FDBA8C"],
                chart: {
                    height: 320,
                    width: "100%",
                    type: "donut",
                },
                stroke: {
                    colors: ["transparent"],
                    lineCap: "",
                },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontFamily: "Inter, sans-serif",
                                    offsetY: 20,
                                },
                                total: {
                                    showAlways: true,
                                    show: true,
                                    label: "Applications",
                                    fontFamily: "Inter, sans-serif",
                                    formatter: function(w) {
                                        const sum = w.globals.seriesTotals.reduce((a, b, c) => {
                                            return a + b + c
                                        }, 0)
                                        return sum
                                    },
                                },
                                value: {
                                    show: true,
                                    fontFamily: "Inter, sans-serif",
                                    offsetY: -20,
                                    formatter: function(value) {
                                        return value
                                    },
                                },
                            },
                            size: "80%",
                        },
                    },
                },
                grid: {
                    padding: {
                        top: -2,
                    },
                },
                labels: ["Approved", "Rejected", "Pending"],
                dataLabels: {
                    enabled: false,
                },
                legend: {
                    position: "bottom",
                    fontFamily: "Inter, sans-serif",
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return value
                        },
                    },
                },
                xaxis: {
                    labels: {
                        formatter: function(value) {
                            return value
                        },
                    },
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                },
            }
        }

        if (document.getElementById("donut-chart")) {
            console.log('Donut chart element found');
            const chart = new ApexCharts(document.getElementById("donut-chart"), getChartOptions());
            chart.render().then(() => {
                console.log('Chart rendered successfully');
            }).catch(error => {
                console.error('Error rendering chart:', error);
            });
        } else {
            console.error('Donut chart element not found');
        }
    });
</script>
