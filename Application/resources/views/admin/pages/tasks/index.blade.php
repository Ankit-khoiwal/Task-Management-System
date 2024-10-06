@extends('admin.layouts.app')

@section('main')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            @if (session('success'))
                <div class="bs-toast toast toast-placement-ex m-2" role="alert" aria-live="assertive" aria-atomic="true"
                    data-delay="2000">
                    <div class="toast-header">
                        <i class="bx bx-bell me-2"></i>
                        <div class="me-auto fw-semibold">Success</div>
                        <small>0 mins ago</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body"> {{ session('success') }} </div>
                </div>
            @endif

            <button class="d-none" id="showToastPlacement">button</button>

            <div class="card ">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header nav-link m-0 " role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home"
                        aria-selected="true">
                        <i class="fas fa-tasks"></i> Tasks
                        <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">{{ $taskCount }}</span>
                    </h5>
                    @if (userCan('task.create'))
                        <a href="{{ route('admin.tasks.create') }}" class="btn btn-primary">Create</a>
                    @endif
                </div>
                <div class="table-responsive text-nowrap overflow-hidden">
                    <div class="row">
                        @forelse ($tasks as $key => $task)
                            @if ($key % 2 == 0)
                                <div class="row mb-4">
                            @endif

                            <div class="col-md-6">
                                <div class="card shadow mb-3 ms-4">
                                    <div class="row g-0">
                                        @if ($key % 2 == 0)
                                            <div class="col-md-4">
                                                @if (!empty($task->document) && in_array(pathinfo($task->document, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                    <img class="card-img card-img-left" src="{{ asset($task->document) }}"
                                                        alt="Card image" />
                                                @else
                                                    <img class="card-img card-img-left"
                                                        src="{{ asset('backend') }}/assets/img/elements/task3.jpg"
                                                        alt="Card image" />
                                                @endif
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body position-relative" style="min-height: 250px;">
                                                    <div class="position-absolute top-0 end-0 mt-2 me-2">
                                                        @if (userCan('task.update'))
                                                            <a href="{{ route('admin.tasks.edit', $task->id) }}"
                                                                class="btn btn-sm btn-primary" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        @endif
                                                        @if (userCan('task.delete'))
                                                            <form action="{{ route('admin.tasks.destroy', $task->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Are you sure you want to delete this task?');"
                                                                class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger"
                                                                    title="Delete">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>

                                                    <h5 class="card-title">{{ $task->title }}</h5>
                                                    <p class="card-text text-wrap">{{ $task->description }}</p>

                                                    <div class="d-inline-flex">
                                                        <p class="card-text text-wrap me-4">
                                                            Status :
                                                            <span
                                                                class="badge {{ $task->status == 'pending' ? 'bg-warning' : 'bg-success' }}">
                                                                {{ ucfirst($task->status) }}
                                                            </span>
                                                        </p>

                                                        <p class="card-text text-wrap">Priority :
                                                            <span
                                                                class="badge {{ $task->priority == 'low' ? 'bg-success' : ($task->priority == 'medium' ? 'bg-warning' : 'bg-danger') }}">
                                                                {{ ucfirst($task->priority) }}
                                                            </span>
                                                        </p>
                                                    </div>

                                                    <p class="card-text mt-2">Deadline :
                                                        <small class="text-muted">{{ $task->deadline }}</small>
                                                    </p>

                                                    @if ($task->document)
                                                        <div class="flex">
                                                            <a href="{{ asset($task->document) }}"
                                                                class="btn btn-sm btn-primary me-2" download>
                                                                <i class="fas fa-download me-1"></i> Download Document
                                                            </a>
                                                            <a href="{{ asset($task->document) }}" target="_blank"
                                                                class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-eye me-1"></i> View Document
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-md-8">
                                                <div class="card-body position-relative" style="min-height: 250px;">
                                                    <div class="position-absolute top-0 end-0 mt-2 me-2">
                                                        @if (userCan('task.update'))
                                                            <a href="{{ route('admin.tasks.edit', $task->id) }}"
                                                                class="btn btn-sm btn-primary" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        @endif
                                                        @if (userCan('task.delete'))
                                                            <form action="{{ route('admin.tasks.destroy', $task->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Are you sure you want to delete this task?');"
                                                                class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger"
                                                                    title="Delete">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>

                                                    <h5 class="card-title">{{ $task->title }}</h5>
                                                    <p class="card-text text-wrap">{{ $task->description }}</p>
                                                    <div class="d-inline-flex">
                                                        <p class="card-text me-4 text-wrap"> Status :
                                                            <span
                                                                class="badge {{ $task->status == 'pending' ? 'bg-warning' : 'bg-success' }}">
                                                                {{ ucfirst($task->status) }}
                                                            </span>
                                                        </p>

                                                        <p class="card-text text-wrap">Priority :
                                                            <span
                                                                class="badge {{ $task->priority == 'low' ? 'bg-success' : ($task->priority == 'medium' ? 'bg-warning' : 'bg-danger') }}">
                                                                {{ ucfirst($task->priority) }}
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <p class="card-text mt-2">Deadline :
                                                        <small class="text-muted">{{ $task->deadline }}</small>
                                                    </p>

                                                    @if ($task->document)
                                                        <div class="flex">
                                                            <a href="{{ asset($task->document) }}"
                                                                class="btn btn-sm btn-primary me-2" download>
                                                                <i class="fas fa-download me-1"></i> Download Document
                                                            </a>
                                                            <a href="{{ asset($task->document) }}" target="_blank"
                                                                class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-eye me-1"></i> View Document
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                @if (!empty($task->document) && in_array(pathinfo($task->document, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                    <img class="card-img card-img-right"
                                                        src="{{ asset($task->document) }}" alt="Card image" />
                                                @else
                                                    <img class="card-img card-img-right"
                                                        src="{{ asset('backend') }}/assets/img/elements/task2.jpg"
                                                        alt="Card image" />
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if ($key % 2 == 1 || $loop->last)
                    </div>
                    @endif
                @empty
                    <div class="alert alert-warning text-center" role="alert">
                        <i class="fas fa-exclamation-circle"></i> <strong>No Tasks Found</strong>
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="demo-inline-spacing">
                <nav aria-label="Page navigation">
                    @if ($taskCount > 10)
                        <ul class="pagination justify-content-center">
                            @if ($tasks->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="tf-icon bx bx-chevrons-left"></i></span>
                                </li>
                            @else
                                <li class="page-item prev">
                                    <a class="page-link" href="{{ $tasks->previousPageUrl() }}"><i
                                            class="tf-icon bx bx-chevrons-left"></i></a>
                                </li>
                            @endif

                            @foreach ($tasks->getUrlRange(1, $tasks->lastPage()) as $page => $url)
                                <li class="page-item {{ $tasks->currentPage() == $page ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            @if ($tasks->hasMorePages())
                                <li class="page-item next">
                                    <a class="page-link" href="{{ $tasks->nextPageUrl() }}"><i
                                            class="tf-icon bx bx-chevrons-right"></i></a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="tf-icon bx bx-chevrons-right"></i></span>
                                </li>
                            @endif
                        </ul>
                    @endif
                </nav>
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
    <script src="{{ asset('backend') }}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('backend') }}/assets/js/ui-toasts.js"></script>
    <script src="{{ asset('backend') }}/assets/vendor/js/bootstrap.js"></script>

    <script>
        $(document).ready(function() {
            var successMessage = @json(session('success'));

            if (successMessage) {
                $('#showToastPlacement').click();
            }
        });
    </script>
@endsection
