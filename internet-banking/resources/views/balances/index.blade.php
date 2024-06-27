@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All Balances</h2>
    <a href="{{ route('balances.create') }}" class="btn btn-primary">Add Balance</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
                <th>Type</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($balances as $balance)
            <tr>
                <td>{{ $balance->description }}</td>
                <td>{{ $balance->amount }}</td>
                <td>{{ ucfirst($balance->type) }}</td>
                <td>{{ $balance->date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
