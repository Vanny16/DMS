@extends('templates.backend.layouts.main')

@section('title', 'News Management')

@section('content')

    <style>
        .modal.fade .modal-dialog {
            transform: translateY(-20px);
            transition: transform 0.3s ease-out;
        }

        .modal.show .modal-dialog {
            transform: translateY(0);
        }

        .news-image {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }

        .news-title {
            height: 60px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            text-overflow: ellipsis;
            white-space: normal;
            line-height: 1.2;
        }

        .card,
        .alert,
        .modal-content {
            transition: all 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .see-more {
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .see-more:hover {
            color: #000000ff;
            text-decoration: underline;
        }

        .fade-transition {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .fade-transition.show {
            opacity: 1;
            transform: translateY(0);
        }

        input,
        textarea,
        select {
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #007bff;
            box-shadow: 0 0 4px rgba(0, 123, 255, 0.5);
        }
    </style>

    <section class="content">
        <div class="container-fluid mt-4">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-11 bg-white p-4 rounded shadow-sm" data-aos="fade-up" data-aos-duration="800">
                    <h2 class="text-primary fw-bold" style="font-size: 1.8rem;">
                        <i class="fas fa-newspaper"></i> News
                    </h2>

                    @if(session('success'))
                        <div class="alert alert-success" data-aos="zoom-in">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger" data-aos="zoom-in">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('typ_id') == 1)
                        <div class="card shadow-sm border-0 mb-4" data-aos="fade-up">
                            <div class="card-body">
                                <form method="GET" action="/news" class="row g-3 align-items-center">
                                    <div class="col-12 text-center">
                                        <select name="accID" id="accID" class="form-select select2 w-100 text-center"
                                            onchange="this.form.submit()" required>
                                            <option value="" selected disabled>Choose a school...</option>
                                            @foreach($schools as $school)
                                                <option value="{{ $school->accID }}" {{ request()->input('accID') == $school->accID ? 'selected' : '' }}>
                                                    {{ $school->accName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                    <form method="GET" action="/news" class="d-flex flex-wrap align-items-center gap-2 mb-4 mt-4"
                        data-aos="fade-up">
                        <div class="input-group flex-grow-1 w-100">
                            <input type="text" name="search" class="form-control" placeholder="Search news..."
                                value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Search</button>
                            @if(request('search'))
                                <a href="/news" class="btn btn-outline-secondary ms-2">
                                    <i class="fas fa-times-circle"></i> Reset
                                </a>
                            @endif
                        </div>
                    </form>

                    @if (session('typ_id') == 1 || session('typ_id') == 2)
                        <div class="d-flex justify-content-end mb-3" data-aos="fade-up">
                            <button class="btn btn-success" data-toggle="modal" data-target="#createNewsModal">
                                <i class="fas fa-plus-circle"></i> Create New Article
                            </button>
                        </div>
                    @endif

                    {{-- Create News Modal --}}
                    <div class="modal fade" id="createNewsModal" tabindex="-1" aria-labelledby="createNewsModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="createNewsModalLabel">
                                        <i class="fas fa-plus-circle"></i> Create New Article
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="/news" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="action" value="create">

                                        @if(session('typ_id') == 1)
                                            <div class="form-group mb-3 text-center">
                                                <select class="select3" name="accID" style="width: 100%" required>
                                                    <option value="" selected disabled>Select School</option>
                                                    @foreach($schools as $school)
                                                                                        <option value="{{ $school->accID }}" {{ request('accID') == $school->accID ?
                                                        'selected' : '' }}>
                                                                                            {{ $school->accName }}
                                                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @elseif(session('typ_id') == 2)
                                            <input type="hidden" name="accID" value="{{ session('accID') }}">
                                            <div class="alert alert-info">
                                                You are posting news for: <strong>{{ session('accName') }}</strong>
                                            </div>
                                        @endif

                                        <div class="form-group mb-3">
                                            <label class="fw-semibold">Title</label>
                                            <input type="text" name="title" class="form-control" placeholder="Enter title"
                                                required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="fw-semibold">Content</label>
                                            <textarea name="content" class="form-control" rows="4"
                                                placeholder="Write your article here..." required></textarea>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="fw-semibold">Image</label>
                                            <input type="file" name="image" class="form-control" accept="image/*">
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-check-circle"></i> Add News
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- News Cards --}}
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" data-aos="fade-up">
                        @forelse($news as $index => $item)
                            <div class="col d-flex align-items-stretch">
                                <div class="card shadow-sm border-dark w-100 d-flex flex-column">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="news-title card-title text-dark fw-bold text-center border-bottom pb-2">
                                            {{ $item->nwsTitle }}
                                        </h5>

                                        @if($item->nwsImage)
                                            <img src="{{ asset('uploads/news/' . $item->nwsImage) }}"
                                                class="img-fluid rounded border my-2 mx-auto d-block news-image" alt="News Image">
                                        @endif

                                        <div class="card-text text-justify mb-3 flex-grow-1" style="font-size: 0.95rem;">
                                            @if(strlen($item->nwsContent) > 200)
                                                {{ substr($item->nwsContent, 0, 200) . '...' }}
                                                <button type="button" class="see-more btn btn-link p-0 text-primary"
                                                    data-toggle="modal" data-target="#viewNewsModal{{ $item->nwsID }}">
                                                    See More
                                                </button>
                                            @else
                                                {{ $item->nwsContent }}
                                            @endif
                                        </div>

                                        {{-- Edit/Delete Actions --}}
                                        @if (session('typ_id') == 1 || (session('typ_id') == 2 && session('accID') == $item->accID))
                                            <div class="d-flex justify-content-end gap-2 mt-auto">
                                                <button class="btn btn-sm btn-outline-success" data-toggle="modal"
                                                    data-target="#editNewsModal{{ $item->nwsID }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <form action="/news" method="POST" class="delete-form">
                                                    @csrf
                                                    <input type="hidden" name="action" value="delete">
                                                    <input type="hidden" name="id" value="{{ $item->nwsID }}">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Edit Modal --}}
                            <div class="modal fade" id="editNewsModal{{ $item->nwsID }}" tabindex="-1"
                                aria-labelledby="editNewsModalLabel{{ $item->nwsID }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title" id="editNewsModalLabel{{ $item->nwsID }}">
                                                Edit News: {{ $item->nwsTitle }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="/news" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="action" value="update">
                                            <input type="hidden" name="id" value="{{ $item->nwsID }}">

                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="nwsTitle{{ $item->nwsID }}" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="nwsTitle{{ $item->nwsID }}"
                                                        name="nwsTitle" value="{{ $item->nwsTitle }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="nwsContent{{ $item->nwsID }}" class="form-label">Content</label>
                                                    <textarea class="form-control" id="nwsContent{{ $item->nwsID }}"
                                                        name="nwsContent" rows="5" required>{{ $item->nwsContent }}</textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="nwsImage{{ $item->nwsID }}" class="form-label">Image</label>
                                                    <input type="file" class="form-control" id="nwsImage{{ $item->nwsID }}"
                                                        name="nwsImage" accept="image/*">
                                                    @if($item->nwsImage)
                                                        <div class="mt-2">
                                                            <small class="text-muted">Current image:</small><br>
                                                            <img src="{{ asset('uploads/news/' . $item->nwsImage) }}"
                                                                class="img-thumbnail" style="max-width: 200px;" alt="Current Image">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success">Update News</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted">No news found.</p>
                        @endforelse
                    </div>

                    {{-- View Modals (separated from cards to avoid animation conflicts) --}}
                    @foreach($news as $item)
                        <div class="modal fade" id="viewNewsModal{{ $item->nwsID }}" tabindex="-1"
                            aria-labelledby="viewNewsModalLabel{{ $item->nwsID }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="viewNewsModalLabel{{ $item->nwsID }}">
                                            {{ $item->nwsTitle }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if($item->nwsImage)
                                            <div class="text-center mb-3">
                                                <img src="{{ asset('uploads/news/' . $item->nwsImage) }}"
                                                    class="img-fluid rounded border" alt="News Image for {{ $item->nwsTitle }}"
                                                    style="max-height: 400px;">
                                            </div>
                                        @endif
                                        <div class="text-justify" style="white-space: pre-line;">
                                            {{ $item->nwsContent }}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>














        
    </section>
@endsection

@push('scripts')
    <script>
        $(function () {
            $('.select2').select2();
        });
        $(document).ready(function () {
            $('.modal').on('shown.bs.modal', function () {
                $(this).find('.select3').each(function () {
                    $(this).select2({ dropdownParent: $(this).closest('.modal') });
                });
            });
        });

        function confirmDelete(form) {
            if (confirm("Are you sure you want to delete this news article?")) {
                form.submit();
            }
        }
    </script>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function () {
            $('.select2').select2();
        });

        $(document).ready(function () {
            $('.modal').on('shown.bs.modal', function () {
                $(this).find('.select3').each(function () {
                    $(this).select2({ dropdownParent: $(this).closest('.modal') });
                });
            });

            // SweetAlert delete confirmation
            $('.delete-form').on('submit', function (e) {
                e.preventDefault();
                const form = this;

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush