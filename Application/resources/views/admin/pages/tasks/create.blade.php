@extends('admin.layouts.app')

@section('main')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Create Task</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.tasks.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-title">Title</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-title2" class="input-group-text"><i class="bx bx-text"></i>
                                    </span>
                                    <input type="text" class="form-control" id="basic-icon-default-title" name="title"
                                        value="{{ old('title') }}" placeholder="Enter title" />
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
                                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                        <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium
                                        </option>
                                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High
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
                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>
                                            Completed</option>
                                    </select>
                                </div>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            @if (auth()->user()->role->name === 'Admin')
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-user_ids">Select User</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-user"></i></span>
                                        <select id="basic-icon-default-user_ids" name="user_id" class="form-control">
                                            <option value="">Select User</option>
                                            @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('user_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @else
                                <div class="mb-3 d-none">
                                    <label class="form-label" for="basic-icon-default-user_id">Title</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-title2" class="input-group-text"><i
                                                class="bx bx-text"></i>
                                        </span>
                                        <input type="text" class="form-control" id="basic-icon-default-user_id"
                                            name="user_id" value="{{ auth()->user()->id }}" placeholder="Enter user id" />
                                    </div>
                                    @error('user_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-deadline">Deadline</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-deadline2" class="input-group-text"><i
                                            class="bx bx-calendar"></i></span>
                                    <input type="date" id="basic-icon-default-deadline" name="deadline"
                                        class="form-control" value="{{ old('deadline') }}" />
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
                                    <textarea id="basic-icon-default-description" name="description" class="form-control" placeholder="Enter description">{{ old('description') }}</textarea>
                                </div>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="document-upload">Upload Document</label>
                                <div id="document-preview" class="document-preview"
                                    onclick="document.getElementById('file-input').click();">
                                    <img id="preview-image" src="https://via.placeholder.com/1200x200"
                                        alt="Document Preview" />
                                    <iframe id="file-preview" style="display: none; width: 100%; height: 200px;"
                                        src="" onclick="document.getElementById('file-input').click();"></iframe>
                                    <input type="file" name="document" id="file-input" style="display:none;"
                                        accept=".pdf, .doc, .docx, .ppt, .pptx, image/*" onchange="previewFile(event)" />
                                </div>
                                <div class="form-text">Supported formats: PDF, DOC, DOCX, PPT, PPTX, and images.</div>
                                @error('document')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
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
    <script src="{{ asset('backend') }}/assets/js/main.js"></script>


    <script>
        function previewFile(event) {
            const file = event.target.files[0];
            const previewImage = document.getElementById('preview-image');
            const filePreview = document.getElementById('file-preview');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const fileType = file.type;
                    const fileURL = e.target.result;

                    if (fileType.startsWith('image/')) {
                        previewImage.src = fileURL;
                        previewImage.style.display = 'block';
                        filePreview.style.display = 'none';
                    } else if (fileType === 'application/pdf') {
                        filePreview.src = fileURL;
                        filePreview.style.display = 'block';
                        previewImage.style.display = 'none';
                    } else if (fileType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ||
                        fileType === 'application/msword') {
                        const blob = new Blob([file], {
                            type: fileType
                        });
                        const url = URL.createObjectURL(blob);
                        filePreview.src = `https://docs.google.com/viewer?url=${url}&embedded=true`;
                        filePreview.style.display = 'block';
                        previewImage.style.display = 'none';
                    } else if (fileType === 'application/vnd.ms-powerpoint' || fileType ===
                        'application/vnd.openxmlformats-officedocument.presentationml.presentation') {
                        const blob = new Blob([file], {
                            type: fileType
                        });
                        const url = URL.createObjectURL(blob);
                        filePreview.src = `https://docs.google.com/viewer?url=${url}&embedded=true`;
                        filePreview.style.display = 'block';
                        previewImage.style.display = 'none';
                    } else {
                        previewImage.style.display = 'none';
                        filePreview.style.display = 'none';
                    }
                };

                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
