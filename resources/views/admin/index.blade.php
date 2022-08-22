<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-7 ms-auto mt-xl-0 ">
                <div class="row ">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-primary"><span id="status1"
                                        countto="{{ $DataSektor->count() }}">{{ $DataSektor->count() }}</span> <span
                                        class="text-lg ms-n2"></span></h1>
                                <h6 class="mb-0 font-weight-bolder">Sektor</h6>
                                <p class="opacity-8 mb-0 text-sm">Jumlah Data</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-md-0 ">
                        <div class="card">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-primary"> <span id="status2"
                                        countto="{{ $DataSeksi->count() }}">{{ $DataSeksi->count() }}</span> <span
                                        class="text-lg ms-n1"></span></h1>
                                <h6 class="mb-0 font-weight-bolder">Jenis Izin</h6>
                                <p class="opacity-8 mb-0 text-sm">Jumlah Data</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-primary"><span id="status3"
                                        countto="{{ $QueryTotal }}">{{ $QueryTotal }}</span> <span
                                        class="text-lg ms-n2"></span></h1>
                                <h6 class="mb-0 font-weight-bolder">Data Permohonan</h6>
                                <p class="opacity-8 mb-0 text-sm">Jumlah Data</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 card ms-auto">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Chart Data Perizinan</h6>
                        <button type="button"
                            class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto"
                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="See the consumption per room">
                            <i class="fas fa-info"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-3 " height="900">
                    <div class="row pb-5" style="padding-bottom: 900px">
                        <div class="col-12 text-center">
                            <div class="chart">
                                <canvas id="chart-consumption" class="chart-canvas" height="197"></canvas>
                            </div>
                            <h4 class="font-weight-bold mt-n8">
                                <span>{{ $QueryTotal }}</span>
                                <span class="d-block text-body text-sm">Jumlah Data <br> </span>
                            </h4>
                        </div>
                        {{-- <div class="col-7">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-0">
                                                    <span class="badge bg-gradient-primary me-3"> </span>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Pertanahan</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold"> {{ $Terbit->count() }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-0">
                                                    <span class="badge bg-gradient-secondary me-3"> </span>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Permohonan</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold"> {{ $Permohonan->count() }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header pb-0 p-3">
                  <h6 class="mb-0">Line Chart Data Perizinan</h6>
                  <div class="d-flex align-items-center">
                    <span class="badge badge-md badge-dot me-4">
                      <i class="bg-primary"></i>
                      <span class="text-dark text-xs">Organic search</span>
                    </span>
                    <span class="badge badge-md badge-dot me-4">
                      <i class="bg-dark"></i>
                      <span class="text-dark text-xs">Referral</span>
                    </span>
                    <span class="badge badge-md badge-dot me-4">
                      <i class="bg-info"></i>
                      <span class="text-dark text-xs">Social media</span>
                    </span>
                  </div>
                </div>
                <div class="card-body p-3">
                  <div class="chart">
                    <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>

        @push('scripts')
            <script>
                // Chart Doughnut Consumption by room
                var ctx1 = document.getElementById("chart-consumption").getContext("2d");

                var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

                gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
                gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
                gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

                new Chart(ctx1, {
                    type: "doughnut",
                    data: {
                        labels: ['Pertanahan', 'Kesehatan', 'Pendidikan', 'Perdagangan'],
                        datasets: [{
                            label: "Data Perizinan",
                            weight: 20,
                            cutout: 90,
                            tension: 0.9,
                            pointRadius: 2,
                            borderWidth: 2,
                            backgroundColor: ['#FF0080', '#A8B8D8', '#FF1E00', '#34ebde'],
                            data: [{{ $DataPertanahan->count() }}, {{ $DataKesehatan->count() }},
                                {{ $DataPendidikan->count() }},{{ $DataPerdagangan->count() }}
                            ],
                            fill: false
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index',
                        },
                        scales: {
                            y: {
                                grid: {
                                    drawBorder: false,
                                    display: false,
                                    drawOnChartArea: false,
                                    drawTicks: false,
                                },
                                ticks: {
                                    display: false
                                }
                            },
                            x: {
                                grid: {
                                    drawBorder: false,
                                    display: false,
                                    drawOnChartArea: false,
                                    drawTicks: false,
                                },
                                ticks: {
                                    display: false,
                                }
                            },
                        },
                    },

                });
            </script>
            <!-- Kanban scripts -->
            <script>
                var ctx1 = document.getElementById("chart-line").getContext("2d");

                var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

                gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
                gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
                gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

                var gradientStroke2 = ctx1.createLinearGradient(0, 230, 0, 50);

                gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
                gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
                gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

                // Line chart
                new Chart(ctx1, {
                    type: "line",
                    data: {
                        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                        datasets: [{
                                label: "Organic Search",
                                tension: 0.4,
                                borderWidth: 0,
                                pointRadius: 2,
                                pointBackgroundColor: "#cb0c9f",
                                borderColor: "#cb0c9f",
                                borderWidth: 3,
                                backgroundColor: gradientStroke1,
                                data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                                maxBarThickness: 6
                            },
                            {
                                label: "Referral",
                                tension: 0.4,
                                borderWidth: 0,
                                pointRadius: 2,
                                pointBackgroundColor: "#3A416F",
                                borderColor: "#3A416F",
                                borderWidth: 3,
                                backgroundColor: gradientStroke2,
                                data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                                maxBarThickness: 6
                            },
                            {
                                label: "Direct",
                                tension: 0.4,
                                borderWidth: 0,
                                pointRadius: 2,
                                pointBackgroundColor: "#17c1e8",
                                borderColor: "#17c1e8",
                                borderWidth: 3,
                                backgroundColor: gradientStroke2,
                                data: [40, 80, 70, 90, 30, 90, 140, 130, 200],
                                maxBarThickness: 6
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index',
                        },
                        scales: {
                            y: {
                                grid: {
                                    drawBorder: false,
                                    display: true,
                                    drawOnChartArea: true,
                                    drawTicks: false,
                                    borderDash: [5, 5]
                                },
                                ticks: {
                                    display: true,
                                    padding: 10,
                                    color: '#9ca2b7'
                                }
                            },
                            x: {
                                grid: {
                                    drawBorder: false,
                                    display: true,
                                    drawOnChartArea: true,
                                    drawTicks: true,
                                    borderDash: [5, 5]
                                },
                                ticks: {
                                    display: true,
                                    color: '#9ca2b7',
                                    padding: 10
                                }
                            },
                        },
                    },
                });
            </script>
        
        @endpush
</x-app-layout>
