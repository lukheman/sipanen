<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laporan')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
        body {
            font-family: serif;
            font-size: 11pt;
            margin: 0;
            padding: 0;
            color: #333;
            background: #fff;
        }

        .navbar {
            width: 100%;
            background: #2c3e50;
            color: #fff;
            padding: 12px 20px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .navbar button.download-btn {
            background: #e74c3c;
            /* merah pdf */
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.25s ease, transform 0.1s ease;
        }

        .navbar button.download-btn:hover {
            background: #c0392b;
        }

        .navbar button.download-btn:active {
            background: #96281b;
            transform: scale(0.96);
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }

        table thead {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        @page {
            size: A4 portrait;
            margin: 18mm;
        }
    </style>
    <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</head>

<body>


    <!-- Konten -->
    <div class="container">


        {{ $slot }}
    </div>
</body>

</html>
