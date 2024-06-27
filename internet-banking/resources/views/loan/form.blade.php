@extends('layouts.app')

@section('content')
<div id="loan" class="content">
    <h2>Loan Calculator</h2>
    <form action="{{ route('loan.calculate') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="account_number" class="form-label">Account Number</label>
            <input type="text" class="form-control" id="account_number" name="account_number" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="loan_amount" class="form-label">Jumlah Pinjaman</label>
            <select class="form-control" id="loan_amount" name="loan_amount" required>
                <option value="1000000">1 Juta</option>
                <option value="5000000">5 Juta</option>
                <option value="10000000">10 Juta</option>
                <option value="20000000">20 Juta</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="loan_period" class="form-label">Jangka Waktu Pinjaman</label>
            <select class="form-control" id="loan_period" name="loan_period" required>
                <option value="6">6 Bulan</option>
                <option value="12">12 Bulan</option>
                <option value="24">24 Bulan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Hitung Pinjaman</button>
    </form>
</div>
@endsection
