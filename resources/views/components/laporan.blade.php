<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laporan')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            font-size: 11pt;
            margin: 0;
            padding: 0;
            color: #333;
            background: #fff;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        .kop-surat {
            text-align: center;
            padding-bottom: 12px;
            border-bottom: 2px solid #000;
            margin-bottom: 25px;
        }
        .kop-surat h6 {
            font-weight: 700;
            margin: 0;
            font-size: 1.6rem;
            letter-spacing: 1px;
        }
        .kop-surat p {
            margin: 3px 0;
            font-size: 0.95rem;
            color: #666;
        }
        .report-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 6px;
            text-transform: uppercase;
        }
        .report-date {
            font-size: 0.95rem;
            color: #777;
            margin-bottom: 18px;
        }
        table#petani {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
            margin-bottom: 15px;
        }
        table#petani th, table#petani td {
            border: 1px solid #ddd;
            padding: 8px 10px;
        }
        table#petani th {
            background: #f1f1f1;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            color: #222;
        }
        table#petani tbody tr:nth-child(even) {
            background: #fafafa;
        }
        .total {
            margin-top: 15px;
            font-weight: 600;
            text-align: right;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .signature p {
            margin: 2px 0;
            font-size: 0.95rem;
        }
        .signature .ttd {
            margin-top: 50px;
            font-weight: 600;
        }
        .signature .nip {
            border-top: 1px solid #000;
            display: inline-block;
            padding-top: 3px;
            margin-top: 5px;
        }
        @page {
            size: A4 portrait;
            margin: 18mm;
        }
    </style>
</head>
<body>
    <div class="container">
        {{ $slot }}
    </div>
</body>
</html>
