@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Loan Calculation Result</h2>
    <p>Nama: {{ $name }}</p>
    <p>Nomor Rekening: {{ $account_number }}</p>
    <p>Nomor Telepon: {{ $phone }}</p>
    <p>Alamat: {{ $address }}</p>
    <p>Jumlah Pinjaman: {{ number_format($loan_amount, 0, ',', '.') }} IDR</p>
    <p>Waktu Pinjaman: {{ $loan_duration }} bulan</p>
    <p>Total Pembayaran: {{ number_format($total_payable, 0, ',', '.') }} IDR</p>
</div>
@endsection
