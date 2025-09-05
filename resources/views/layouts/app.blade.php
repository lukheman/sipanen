<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Page Title' }}</title>

    <link rel="icon" href="{{ asset('img/logo-tanipedia.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" crossorigin href="{{ asset('/assets/compiled/css/table-datatable-jquery.css')}}">
    <link rel="stylesheet" crossorigin href="{{ asset('/assets/compiled/css/app.css')}}">
    <link rel="stylesheet" crossorigin href="{{ asset('/assets/compiled/css/app-dark.css')}}">
    <link rel="stylesheet" crossorigin href="{{ asset('/assets/compiled/css/iconly.css')}}">

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

        .logo-tanipedia {
            width: 150px;
            height: 150px;
            object-fit: contain;
        }
    </style>

    @stack('styles')
</head>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js')}}"></script>
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
            <h3>{{ $title ?? '' }}</h3>
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        {{ $slot }}
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/static/js/components/dark.js')}}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('assets/compiled/js/app.js')}}"></script>

    <script src="{{ asset('assets/extensions/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{ asset('assets/static/js/pages/datatables.js')}}"></script>

    <!-- Toastfy -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(window).on('livewire:initialized', () => {
            Livewire.on('openModal', ({ id }) => {
                $('#' + id).modal('show');
            });

            Livewire.on('closeModal', ({ id }) => {
                $('#' + id).modal('hide');
            });

            Livewire.on('deleteConfirmation', ({ message }) => {
                Swal.fire({
                    title: message,
                    icon: "warning",
                    showCancelButton: true,
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-danger'
                    },
                    confirmButtonText: "Ya, Hapus",
                    showClass: {
                        popup: `
                            animate__animated
                            animate__fadeIn
                            animate__faster`
                    },
                    hideClass: {
                        popup: `
                            animate__animated
                            animate__fadeOut
                            animate__faster`
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('deleteConfirmed');
                    }
                });
            });

            Livewire.on('toast', ({ message, variant, reload }) => {
                if (reload) {
                    sessionStorage.setItem('reload', 'true');
                    sessionStorage.setItem('variant', variant);
                    sessionStorage.setItem('message', message);
                }

                const borderColors = {
                    success: "#435ebe",
                    warning: "#ffc107",
                    error: "#dc3545"
                };

                Toastify({
                    text: message,
                    duration: 3000,
                    close: false,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    style: {
                        background: "#ffffff",
                        border: `2px solid ${borderColors[variant] || "#374151"}`,
                        color: "#111827",
                        borderRadius: "15px"
                    },
                }).showToast();
            });
        });

        // setelah halaman dimuat ulang, periksa apakah ada notifikasi
        $(window).on('load', function() {
            if (sessionStorage.getItem('reload') === 'true') {
                message = sessionStorage.getItem('message');
                variant = sessionStorage.getItem('variant');

                const borderColors = {
                    success: "#435ebe",
                    warning: "#ffc107",
                    error: "#dc3545"
                };

                Toastify({
                    text: message,
                    duration: 3000,
                    close: false,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    style: {
                        background: "#ffffff",
                        border: `2px solid ${borderColors[variant] || "#374151"}`,
                        color: "#111827",
                        borderRadius: "15px"
                    },
                }).showToast();

                sessionStorage.removeItem('reload');
                sessionStorage.removeItem('message');
                sessionStorage.removeItem('variant');
            }
        });

    </script>

    @stack('scripts')
</body>

</html>
