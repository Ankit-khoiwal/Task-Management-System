@extends('admin.layouts.app')


@php
    $totalTasks = $tasks->count();
    $completedTasks = $tasks->filter(fn($task) => $task->status === 'completed')->count();
    $pendingTasks = $tasks->filter(fn($task) => $task->status === 'pending')->count();
    $lowPriorityTasks = $tasks->filter(fn($task) => $task->priority === 'low')->count();
    $highPriorityTasks = $tasks->filter(fn($task) => $task->priority === 'high')->count();
    $percentageCompleted = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
@endphp

@section('main')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-8 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Welcome
                                        {{ ucFirst(auth()->user()->name) }}! 🎉</h5>
                                    <p class="mb-4">
                                        You have completed <span
                                            class="fw-bold">{{ number_format($percentageCompleted, 2) }}%</span>
                                        of your tasks today. Check your progress in your profile.
                                    </p>

                                    @if (userCan('task.view'))
                                        <a href="{{ route('admin.tasks.index') }}"
                                            class="btn btn-sm btn-outline-primary">View
                                            Tasks</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="{{ asset('backend') }}/assets/img/illustrations/man-with-laptop-light.png"
                                        height="140" alt="View Badge User"
                                        data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                        data-app-light-img="illustrations/man-with-laptop-light.png" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 order-1">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('backend') }}/assets/img/icons/unicons/chart-success.png"
                                                alt="chart success" class="rounded" />
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Completed Tasks</span>
                                    <h3 class="card-title mb-2">{{ $completedTasks }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('backend') }}/assets/img/icons/unicons/wallet-info.png"
                                                alt="Credit Card" class="rounded" />
                                        </div>
                                    </div>
                                    <span>Pending Tasks</span>
                                    <h3 class="card-title text-nowrap mb-1">{{ $pendingTasks }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Revenue -->
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                    <div class="card">
                        <div class="row row-bordered g-0">
                            <div class="col-md-8">
                                <h5 class="card-header m-0 me-2 pb-3">Total
                                    Revenue</h5>
                                <div id="totalRevenueChart" class="px-2"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-body">
                                    <div class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                                id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                2024
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                                                <a class="dropdown-item" href="javascript:void(0);">2024</a>
                                                <a class="dropdown-item" href="javascript:void(0);">2023</a>
                                                <a class="dropdown-item" href="javascript:void(0);">2022</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="growthChart"></div>
                                <div class="text-center fw-semibold pt-3 mb-2">88%
                                    Company Growth</div>

                                <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                                    <div class="d-flex">
                                        <div class="me-2">
                                            <span class="badge bg-label-primary p-2"><i
                                                    class="bx bx-dollar text-primary"></i></span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <small>2023</small>
                                            <h6 class="mb-0">$32.5k</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="me-2">
                                            <span class="badge bg-label-info p-2"><i
                                                    class="bx bx-wallet text-info"></i></span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <small>2024</small>
                                            <h6 class="mb-0">$51.2k</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                    <div class="row">
                        <div class="col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('backend') }}/assets/img/icons/unicons/paypal.png"
                                                alt="Credit Card" class="rounded" />
                                        </div>
                                    </div>
                                    <span class="d-block mb-1">High Priority</span>
                                    <h3 class="card-title text-nowrap mb-2">{{ $highPriorityTasks }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('backend') }}/assets/img/icons/unicons/cc-primary.png"
                                                alt="Credit Card" class="rounded" />
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Low Priority</span>
                                    <h3 class="card-title mb-2">{{ $lowPriorityTasks }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                        <div
                                            class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                            <div class="card-title">
                                                <h5 class="text-nowrap mb-2">Total Tasks</h5>
                                                <span class="badge bg-label-warning rounded-pill">Year
                                                    {{ now()->format('Y') }}</span>
                                            </div>
                                            <div class="mt-sm-auto">
                                                <h3 class="mb-0">{{ $totalTasks }}</h3>
                                            </div>
                                        </div>
                                        <div id="profileReportChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-backdrop fade"></div>
    </div>
@endsection


@section('css')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/vendor/fonts/boxicons.css" />

    <link rel="stylesheet" href="{{ asset('backend') }}/assets/vendor/css/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/demo.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('script')

    <script src="{{ asset('backend') }}/assets/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('backend') }}/assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="{{ asset('backend') }}/assets/js/dashboards-analytics.js"></script>


@endsection
