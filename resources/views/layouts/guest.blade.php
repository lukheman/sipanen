<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tani Pedia - Berita & Video Edukasi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts for modern typography -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f3;
            position: relative;
        }
        .navbar {
            background-color: #435ebe;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .header-section {
            background: linear-gradient(135deg, #435ebe 0%, #1e2f6e 100%);
            color: white;
            padding: 100px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .header-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" opacity="0.1"%3E%3Cpath d="M100 20c-10 0-18 8-18 18s8 18 18 18 18-8 18-18-8-18-18-18zm0 24c-3.3 0-6-2.7-6-6s2.7-6 6-6 6 2.7 6 6-2.7 6-6 6zm50 50c0-10-8-18-18-18s-18 8-18 18 8 18 18 18 18-8 18-18zm-24 0c0-3.3 2.7-6 6-6s6 2.7 6 6-2.7 6-6 6-6-2.7-6-6zm-100 0c0-10 8-18 18-18s18 8 18 18-8 18-18 18-18-8-18-18zm24 0c0 3.3-2.7 6-6 6s-6-2.7-6-6 2.7-6 6-6 6 2.7 6 6zm100 50c-10 0-18 8-18 18s8 18 18 18 18-8 18-18-8-18-18-18zm0 24c-3.3 0-6-2.7-6-6s2.7-6 6-6 6 2.7 6 6-2.7 6-6 6z" fill="%23ffffff"/%3E%3C/svg%3E');
            background-repeat: repeat;
            opacity: 0.1;
        }
        .header-section h1 {
            font-size: 3rem;
            font-weight: 600;
        }
        .news-card, .video-card, .consultation-card {
            transition: transform 0.3s;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .news-card:hover, .video-card:hover, .consultation-card:hover {
            transform: translateY(-10px);
        }
        .news-card img, .video-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .section-title {
            color: #435ebe;
            font-weight: 600;
            margin-bottom: 30px;
        }
        .btn-custom {
            background-color: #435ebe;
            color: white;
            border-radius: 25px;
            padding: 10px 20px;
        }
        .btn-custom:hover {
            background-color: #344a9e;
        }
        footer {
            background-color: #435ebe;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
        .consultation-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>

        @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Tani Pedia</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('landing')}}#berita">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('landing')}}#video">Video Edukasi</a>
                    </li>

                    @if (getActiveGuard())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard')}}">Dashboard</a>
                    </li>

                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login')}}" wire:navigate>Login</a>
                    </li>

                    @endif


                </ul>
            </div>
        </div>
    </nav>


    {{ $slot }}

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 Tani Pedia. Semua hak dilindungi.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
