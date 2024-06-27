<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .result-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .result-container p {
            margin-bottom: 15px;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        @if (session('global_status'))
        <x-alert type="success">
            {{ session('global_status') }}
        </x-alert>
        @endif

        <!-- Page Content -->
        <main>
            <div class="result-container">
                <h2 class="text-center mb-4">Loan Calculation Result</h2>
                <p><strong>Nama:</strong> {{ $name }}</p>
                <p><strong>Nomor Rekening:</strong> {{ $account_number }}</p>
                <p><strong>Nomor Telepon:</strong> {{ $phone }}</p>
                <p><strong>Alamat:</strong> {{ $address }}</p>
                <p><strong>Jumlah Pinjaman:</strong> {{ number_format($loan_amount, 0, ',', '.') }} IDR</p>
                <p><strong>Waktu Pinjaman:</strong> {{ $loan_duration }} bulan</p>
                <p><strong>Total Pembayaran:</strong> {{ number_format($total_payable, 0, ',', '.') }} IDR</p>
            </div>
        </main>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
