@include('templates.backend.partials.auth')
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('templates.backend.partials.head')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        @include('templates.backend.partials.navbar')
        @include('templates.backend.partials.sidebar')
        <div class="content-wrapper">
            @yield('content')
            <a class="btn btn-primary back-to-top d-print-none" id="back-to-top" role="button" aria-label="Scroll to top" href="#">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>
        @include('templates.backend.partials.footer')
        @include('templates.backend.partials.controlSidebar')
        @include('templates.backend.partials.script')

        <style>
            @media (max-width: 768px) {
                .table-responsive {
                    overflow-x: auto;
                }
            }
        </style>
    </div>
</body>

</html>

@stack('scripts')