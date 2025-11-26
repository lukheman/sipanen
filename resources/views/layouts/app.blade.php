<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title . ' | SiPanen' ?? 'Sipanen' }}</title>

    <link rel="icon" href="{{ asset('img/logo-aplikasi.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('/assets/compiled/css/table-datatable-jquery.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('/assets/compiled/css/app.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('/assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('/assets/compiled/css/iconly.css') }}">

    <!-- Apexcharts -->
    <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Toastfy -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <style>
        .swal2-popup {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .swal2-title {
            font-family: 'Arial Black', sans-serif;
        }

        #editor {
            height: 500px;
        }

        .logo-aplikasi {
            width: 150px;
            height: 150px;
            object-fit: contain;
        }
    </style>

    @stack('styles')
</head>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    <div id="app">
        <x-sidebar />
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
            </div>
            <div class="row">
<div class="col-6">
@if (Route::currentRouteName() !== 'dashboard')

    <a href="{{ route('dashboard')}}" class="btn btn-primary">Kembali</a>


@endif
</div>

    <div class="col-6">
            <h3 class="float-end">{{ $title ?? '' }}</h3>
    </div>

            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        {{ $slot }}
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>

    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>

    <!-- Toastfy -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('js/script.js') }}"></script>

    @stack('scripts')
</body>

</html>
