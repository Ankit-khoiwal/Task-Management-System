@extends('admin.layouts.app')

@section('main')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Task</h5>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.tasks.update', $task->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-title">Title</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-title2" class="input-group-text"><i class="bx bx-text"></i>
                                    </span>
                                    <input type="text" class="form-control" id="basic-icon-default-title" name="title"
                                        value="{{ $task->title }}" placeholder="Enter title" />
                                </div>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-priority">Priority</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-priority2" class="input-group-text"><i
                                            class="bx bx-flag"></i></span>
                                    <select id="basic-icon-default-priority" name="priority" class="form-control">
                                        <option value="">Select Priority</option>
                                        <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                                        <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium
                                        </option>
                                        <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High
                                        </option>
                                    </select>
                                </div>
                                @error('priority')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-status">Status</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-check-circle"></i></span>
                                    <select id="basic-icon-default-status" name="status" class="form-control">
                                        <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>
                                            Completed</option>
                                    </select>
                                </div>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-deadline">Deadline</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-deadline2" class="input-group-text"><i
                                            class="bx bx-calendar"></i></span>
                                    <input type="date" id="basic-icon-default-deadline" name="deadline"
                                        class="form-control" value="{{ $task->deadline }}" />
                                </div>
                                @error('deadline')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-description">Description</label>
                                <div class="input-group ">
                                    <span id="basic-icon-default-description2" class="input-group-text"><i
                                            class="bx bx-message-square-detail"></i>
                                    </span>
                                    <textarea id="basic-icon-default-description" name="description" class="form-control" placeholder="Enter description">{{ $task->description }}</textarea>
                                </div>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="document-upload">Upload Document</label>
                                <div id="document-preview" class="document-preview"
                                    onclick="document.getElementById('file-input').click();">
                                    <img id="preview-image"
                                        src="{{ $task->document ? asset($task->document) : 'https://via.placeholder.com/1200x200' }}"
                                        alt="Document Preview" />
                                    <iframe id="file-preview" style="display: none;" width="100%" height="200px"
                                        src=""></iframe>
                                    <input type="file" name="document" id="file-input" style="display:none;"
                                        accept=".pdf, .doc, .docx, .ppt, .pptx, image/*" onchange="previewFile(event)" />
                                </div>
                                <div class="form-text">Supported formats: PDF, DOC, DOCX, PPT, PPTX, and images.</div>
                                @error('document')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>
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

    <style>
        .document-preview {
            cursor: pointer;
            border: 2px dashed #ccc;
            border-radius: 8px;
            text-align: center;
            padding: 20px;
        }

        .document-preview img {
            max-width: 100%;
            height: auto;
            display: block;
        }
    </style>
@endsection


@section('script')
    <script src="{{ asset('backend') }}/assets/vendor/libs/jquery/jquery.js"></script>

    <script src="{{ asset('backend') }}/assets/vendor/js/bootstrap.js"></script>

    <script>
        function previewFile(event) {
            const file = event.target.files[0];
            const previewImage = document.getElementById('preview-image');
            const filePreview = document.getElementById('file-preview');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const fileType = file.type.split('/')[0];
                    const fileURL = e.target.result;

                    if (fileType === 'image') {
                        previewImage.src = fileURL;
                        previewImage.style.display = 'block';
                        filePreview.style.display = 'none';
                    } else if (file.type === 'application/pdf') {
                        filePreview.src = fileURL;
                        filePreview.style.display = 'block';
                        previewImage.style.display = 'none';
                    } else if (file.type ===
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ||
                        file.type === 'application/msword') {
                        const encodedURL = encodeURIComponent(fileURL);
                        filePreview.src = `https://docs.google.com/viewer?url=${encodedURL}&embedded=true`;
                        filePreview.style.display = 'block';
                        previewImage.style.display = 'none';
                    } else if (file.type ===
                        'application/vnd.openxmlformats-officedocument.presentationml.presentation' ||
                        file.type === 'application/vnd.ms-powerpoint') {
                        const encodedURL = encodeURIComponent(fileURL);
                        filePreview.src = `https://docs.google.com/viewer?url=${encodedURL}&embedded=true`;
                        filePreview.style.display = 'block';
                        previewImage.style.display = 'none';
                    } else {
                        previewImage.src = 'https://via.placeholder.com/1200x200';
                        previewImage.style.display = 'block';
                        filePreview.style.display = 'none';
                    }
                };

                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
