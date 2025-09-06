<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'SIPANEN Kolaka' }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #4CAF50; /* hijau padi */
            --text-dark: #2E2E2E;
            --text-muted: #6c757d;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
        }

        /* Navbar */
        .navbar {
            background-color: white !important;
        }
        .navbar-brand, .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
        }
        .nav-link.active, .nav-link:hover {
            color: var(--primary) !important;
        }

        /* Parallax */
        .parallax {
            background-image: url("{{ asset('img/hero.jpg')}}");
            min-height: 100vh;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 0 1rem;
        }

        .parallax h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            text-shadow: 0 4px 10px rgba(0,0,0,0.4);
        }

        .parallax p {
            color: white;
            font-size: 1.1rem;
        }

        /* Card */
        .shadow-card {
            border: none;
            border-radius: 16px;
            padding: 2rem;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
        }

        .shadow-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        /* Section Title */
        h2.section-title {
            font-weight: 600;
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .btn-primary {
            background-color: var(--primary);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #43A047;
        }

        .btn-outline-primary {
            border-color: var(--primary);
            color: var(--primary);
            border-radius: 8px;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary);
            color: white;
        }

        footer {
            background-color: #f8f9fa;
            color: var(--text-muted);
        }
    </style>

</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">SIPANEN Kolaka</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link @if (request()->routeIs('landing'))
    active

                    @endif" href="{{ route('landing')}}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing')}}#about">Tentang</a></li>
                    <li class="nav-item"><a wire:navigate class="nav-link @if (request()->routeIs('login'))
    active

                    @endif" href="{{ route('login')}}">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="mt-5 pt-4">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="py-3 text-center mt-5">
        <small>&copy; {{ date('Y') }} Dinas Pertanian dan Perkebunan Kolaka. Semua Hak Dilindungi.</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
