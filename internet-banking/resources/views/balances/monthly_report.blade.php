@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Monthly Report</h2>
    <p>Total Income: {{ $totalIncome }}</p>
    <p>Total Expense: {{ $totalExpense }}</p>
    <table class="table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th colspan="3">Incomes</th>
            </tr>
            @foreach($incomes as $income)
            <tr>
                <td>{{ $income->description }}</td>
                <td>{{ $income->amount }}</td>
                <td>{{ $income->date }}</td>
            </tr>
            @endforeach
            <tr>
                <th colspan="3">Expenses</th>
            </tr>
            @foreach($expenses as $expense)
            <tr>
                <td>{{ $expense->description }}</td>
                <td>{{ $expense->amount }}</td>
                <td>{{ $expense->date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <canvas id="balanceChart"></canvas>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('balanceChart').getContext('2d');
    var balanceChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($incomes as $income) 
                '{{ $income->description }}', 
                @endforeach 
                @foreach($expenses as $expense) 
                '{{ $expense->description }}', 
                @endforeach
            ],
            datasets: [{
                label: 'Incomes and Expenses',
                data: [
                    @foreach($incomes as $income) 
                    {{ $income->amount }}, 
                    @endforeach 
                    @foreach($expenses as $expense) 
                    {{ $expense->amount }}, 
                    @endforeach
                ],
                backgroundColor: [
                    @foreach($incomes as $income) 
                    'rgba(54, 162, 235, 0.2)', 
                    @endforeach 
                    @foreach($expenses as $expense) 
                    'rgba(255, 99, 132, 0.2)', 
                    @endforeach
                ],
                borderColor: [
                    @foreach($incomes as $income) 
                    'rgba(54, 162, 235, 1)', 
                    @endforeach 
                    @foreach($expenses as $expense) 
                    'rgba(255, 99, 132, 1)', 
                    @endforeach
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
