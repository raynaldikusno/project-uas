<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TurtleBank</title>
    <!-- Include Bootstrap CSS for styling (optional) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .content {
            display: none;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .content.active {
            display: block;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="images/gambar.jpg" style="height: 30px; width: auto;">
        TurtleBank
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#" data-target="home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-target="accounts">Accounts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-target="transactions">Transactions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-target="transfer">Transfer</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <div id="home" class="content active">
        <h3>Welcome to TurtleBank</h3>
        <p>Select an option from the navigation menu to get started.</p>
        <!-- Dashboard Button -->
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
    </div>

    <style>
        .profile-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2pt solid rgb(12, 115, 82);
        }
    </style>
    <div id="accounts" class="content">
        <h3>Account Summary</h3>
        <form method="POST" action="{{ route('profile.update') }}">
        </form>
        
        <!-- Menampilkan gambar profil yang dipilih -->
        <div class="mt-4">
        </div>
        @if ($user->profile_image)
            <img src="{{ asset('images/' . $user->profile_image) }}" alt="Profile Image" class="profile-image" />
        @else
            <img src="{{ asset('images/default.jpg') }}" alt="Profile Image" class="profile-image" />
        @endif
        <p>Name: {{ $user->name }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>Account Number: {{ $user->account_number }}</p>
        <p>Balance: ${{ number_format($user->balance, 2) }}</p>
    </div>

    
                    <!-- Profile Update Form -->


    <div id="transactions" class="content">
        <h3>Recent Transactions</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2024-06-01</td>
                    <td>Deposit</td>
                    <td>$1,000.00</td>
                    <td>$5,000.00</td>
                </tr>
                <tr>
                    <td>2024-05-28</td>
                    <td>Withdrawal</td>
                    <td>-$200.00</td>
                    <td>$4,000.00</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="transfer" class="content">
        <h3>Transfer Funds</h3>
        <form>
            <div class="form-group">
                <label for="transferType">Transfer Type</label>
                <select class="form-control" id="transferType">
                    <option value="account">Transfer with Account Number</option>
                    <option value="electricity">Electricity Bill Payment</option>
                    <option value="water">Water Bill Payment</option>
                    <option value="topUp">Top-up E-Wallet</option>
                    <option value="bpjs">BPJS</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fromAccount">From Account</label>
                <input type="text" class="form-control" id="fromAccount" placeholder="Enter account number">
            </div>
            <div class="form-group">
                <label for="toAccount">To Account</label>
                <input type="text" class="form-control" id="toAccount" placeholder="Enter account number">
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" class="form-control" id="amount" placeholder="Enter amount">
            </div>
            <button type="submit" class="btn btn-primary">Transfer</button>
        </form>
    </div>
</div>

<!-- Include Bootstrap JS and dependencies (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('.nav-link');
        const contents = document.querySelectorAll('.content');

        links.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const target = this.getAttribute('data-target');

                contents.forEach(content => {
                    if (content.id === target) {
                        content.classList.add('active');
                    } else {
                        content.classList.remove('active');
                    }
                });
            });
        });
    });
</script>
</body>
</html>
