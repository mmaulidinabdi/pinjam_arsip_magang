@extends('userLayout.userLayout')

@section('peminjamLayout')
<div class="grid md:grid-cols-4 gap-4 grid-flow-row-dense">

    <div class=" md:col-span-3  p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h2 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">Selamat Datang {{ Auth::user()->nama_lengkap }}</h2>
        </div>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Lengkapi data anda terlebih dahulu sebelum melakukan melakukan peminjaman!</p>
        <div class="">
            <a href="{{Route('user.profile')}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Lengkapi Data Diri
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>

        </div>
    </div>

    <!-- 2 -->
    <div class=" p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">*Jumlah Arsip*</h5>
        </div>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Jumlah Arsip yang sudah didata berada di Dinas Arsip dan Perpustakaan Banjarmasin</p>

    </div>

</div>

<!-- Kategori -->

<div class=" my-4 grid sm:grid-cols-3  md:grid-row-3 gap-4">
    <!-- Kategtori section -->
    <!-- 3 -->
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">*Jenis 1*</h5>
        </div>
        <span class="text-2xl font-semibold">*Total*</span>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Arsip yang tersimpan di Dinas Arsip dan Perpusatakaan Banjarmasin</p>

    </div>
    <!-- 4 -->
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">*Jenis 1*</h5>
        </div>
        <span class="text-2xl font-semibold">*Total*</span>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Arsip yang tersimpan di Dinas Arsip dan Perpusatakaan Banjarmasin</p>

    </div>


    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">*Jenis 1*</h5>
        </div>
        <span class="text-2xl font-semibold">*Total*</span>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Arsip yang tersimpan di Dinas Arsip dan Perpusatakaan Banjarmasin</p>

    </div>
</div>


<!-- chart -->
<!-- Chart Container -->
<div class="my-4 grid md:grid-cols-3 gap-4 grid-flow-row-dense">

    <!-- Bar Chart -->
    <div class="md:col-span-2">
        <canvas class="h-48 sm:h-64 md:h-80 lg:h-96 w-full" id="myChart"></canvas>
    </div>

    <!-- Donut Chart -->
    <div>
        <canvas class="h-48 sm:h-64 md:h-80 lg:h-96 w-full" id="donutChart"></canvas>
    </div>
</div>

<!-- Table -->
<div class="flex flex-col sm:flex-row mt-4 gap-2">
    <div class="flex-1 bg-red-500 text-center p-4 text-white">01</div>
    <div class="flex-1 bg-green-500 text-center p-4 text-white">02</div>
    <div class="flex-2 bg-blue-500 text-center p-4 text-white">03</div>
</div>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    let barChart, donutChart; // Deklarasi variabel untuk menyimpan instans chart

    const initCharts = () => {
        // Cek dan hapus instans chart bar sebelumnya jika ada
        if (barChart) {
            barChart.destroy();
        }

        // Inisialisasi ulang bar chart
        const ctx = document.getElementById('myChart').getContext('2d');
        barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Cek dan hapus instans donut chart sebelumnya jika ada
        if (donutChart) {
            donutChart.destroy();
        }

        // Inisialisasi ulang donut chart
        const donut = document.getElementById('donutChart').getContext('2d');
        donutChart = new Chart(donut, {
            type: 'doughnut',
            data: {
                labels: ['Red', 'Blue', 'Yellow'],
                datasets: [{
                    data: [300, 50, 100],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    };

    // Inisialisasi chart saat halaman pertama kali dimuat
    initCharts();

    // Inisialisasi ulang chart saat jendela diubah ukurannya
    window.addEventListener('resize', () => {
        initCharts();
    });
</script>



<!-- <div class=" my-4 grid sm:grid-cols-3  md:grid-row-3 gap-4">
    <div
        class="col-span-12 rounded-sm border border-stroke bg-white p-7.5 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4">
        <div class="mb-4 justify-between gap-4 sm:flex">
            <div>
                <h4 class="text-xl font-bold text-black dark:text-white">
                    Profit this week
                </h4>
            </div>
            <div>
                <div class="relative z-20 inline-block">
                    <select name="#" id="#"
                        class="relative z-20 inline-flex appearance-none bg-transparent py-1 pl-3 pr-8 text-sm font-medium outline-none">
                        <option value="">This Week</option>
                        <option value="">Last Week</option>
                    </select>
                    <span class="absolute right-3 top-1/2 z-10 -translate-y-1/2">
                        <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.47072 1.08816C0.47072 1.02932 0.500141 0.955772 0.54427 0.911642C0.647241 0.808672 0.809051 0.808672 0.912022 0.896932L4.85431 4.60386C4.92785 4.67741 5.06025 4.67741 5.14851 4.60386L9.09079 0.896932C9.19376 0.793962 9.35557 0.808672 9.45854 0.911642C9.56151 1.01461 9.5468 1.17642 9.44383 1.27939L5.50155 4.98632C5.22206 5.23639 4.78076 5.23639 4.51598 4.98632L0.558981 1.27939C0.50014 1.22055 0.47072 1.16171 0.47072 1.08816Z"
                                fill="#637381" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M1.22659 0.546578L5.00141 4.09604L8.76422 0.557869C9.08459 0.244537 9.54201 0.329403 9.79139 0.578788C10.112 0.899434 10.0277 1.36122 9.77668 1.61224L9.76644 1.62248L5.81552 5.33722C5.36257 5.74249 4.6445 5.7544 4.19352 5.32924C4.19327 5.32901 4.19377 5.32948 4.19352 5.32924L0.225953 1.61241C0.102762 1.48922 -4.20186e-08 1.31674 -3.20269e-08 1.08816C-2.40601e-08 0.905899 0.0780105 0.712197 0.211421 0.578787C0.494701 0.295506 0.935574 0.297138 1.21836 0.539529L1.22659 0.546578ZM4.51598 4.98632C4.78076 5.23639 5.22206 5.23639 5.50155 4.98632L9.44383 1.27939C9.5468 1.17642 9.56151 1.01461 9.45854 0.911642C9.35557 0.808672 9.19376 0.793962 9.09079 0.896932L5.14851 4.60386C5.06025 4.67741 4.92785 4.67741 4.85431 4.60386L0.912022 0.896932C0.809051 0.808672 0.647241 0.808672 0.54427 0.911642C0.500141 0.955772 0.47072 1.02932 0.47072 1.08816C0.47072 1.16171 0.50014 1.22055 0.558981 1.27939L4.51598 4.98632Z"
                                fill="#637381" />
                        </svg>
                    </span>
                </div>
            </div>
        </div>

        <div>
            <div id="chartTwo" class="-mb-9 -ml-5"></div>
        </div>
    </div>
</div> -->




<!-- <script type="module" src=""></script>
    import ApexCharts from "apexcharts";
    const chartTwoOptions = {
        series: [{
                name: "Sales",
                data: [44, 55, 41, 67, 22, 43, 65],
            },
            {
                name: "Revenue",
                data: [13, 23, 20, 8, 13, 27, 15],
            },
        ],
        colors: ["#3056D3", "#80CAEE"],
        chart: {
            type: "bar",
            height: 335,
            stacked: true,
            toolbar: {
                show: false,
            },
            zoom: {
                enabled: false,
            },
        },

        responsive: [{
            breakpoint: 1536,
            options: {
                plotOptions: {
                    bar: {
                        borderRadius: 0,
                        columnWidth: "25%",
                    },
                },
            },
        }, ],
        plotOptions: {
            bar: {
                horizontal: false,
                borderRadius: 0,
                columnWidth: "25%",
                borderRadiusApplication: "end",
                borderRadiusWhenStacked: "last",
            },
        },
        dataLabels: {
            enabled: false,
        },

        xaxis: {
            categories: ["M", "T", "W", "T", "F", "S", "S"],
        },
        legend: {
            position: "top",
            horizontalAlign: "left",
            fontFamily: "Satoshi",
            fontWeight: 500,
            fontSize: "14px",

            markers: {
                radius: 99,
            },
        },
        fill: {
            opacity: 1,
        },
    };

    const chartSelector = document.querySelectorAll("#chartTwo");

    if (chartSelector.length) {
        const chartTwo = new ApexCharts(
            document.querySelector("#chartTwo"),
            chartTwoOptions
        );
        chartTwo.render();
    }
    
</script> -->

@endsection