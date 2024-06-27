@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Transfer</h1>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Transfer Form -->
    <form action="{{ route('transfers.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" required>
        </div>

        <div class="form-group">
            <label for="recipient">Recipient</label>
            <input type="text" class="form-control" id="recipient" name="recipient" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
