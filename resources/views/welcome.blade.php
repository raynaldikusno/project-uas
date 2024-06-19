<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TurtleBank</title>
    <!-- Include Bootstrap CSS for styling (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    <style>
        body {
            background-color: var(--bs-body-bg);
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
        .form-group.hidden {
            display: none;
        }
        
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        <img src="images/gambarkura.png" style="height: 30px; width: auto;">
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
    </div>

    <div id="accounts" class="content">
        <h3>Account Summary</h3>
        <p>Account Number: 1234567890</p>
        <p>Balance: $5,000.00</p>
    </div>

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
                    <option value="topUp">Top-up E-Wallet</option>
                    <option value="isiPulsa">Isi Pulsa</option>
                    <option value="virtualAccount">Virtual Account</option>
                </select>
            </div>
            <div class="form-group hidden" id="fromAccountGroup">
                <label for="fromAccount">From Account</label>
                <input type="text" class="form-control" id="fromAccount" placeholder="Enter account number">
            </div>
            <div class="form-group hidden" id="toAccountGroup">
                <label for="toAccount">To Account</label>
                <input type="text" class="form-control" id="toAccount" placeholder="Enter account number">
            </div>
            <div class="form-group hidden" id="amountGroup">
                <label for="amount">Amount</label>
                <input type="number" class="form-control" id="amount" placeholder="Enter amount">
            </div>
            <div class="form-group hidden" id="topUpGroup">
                <label for="ewalletProvider">E-Wallet Provider</label>
                <select class ="form-control" id="ewalletProvider">
                    <option value="gopay">Gopay</option>
                    <option value="dana">Dana</option>
                    <option value="Ovo">Ovo</option>
                    <option value="ShoopePay">ShoopePay</option>
                    <option value="LinkAja">LinkAja</option>
                </select>
                <label for="ewalletAccount">E-Wallet Account</label>
                <input type="text" class="form-control" id="ewalletAccount" placeholder="Enter e-wallet account number">
                <label for="topUpAmount">Top-up Amount</label>
                <input type="number" class="form-control" id="topUpAmount" placeholder="Enter top-up amount">
            </div>
            <div class="form-group hidden" id="isiPulsaGroup">
                <label for="nomorTelepon">Nomor Telepon</label>
                <input type="text" class="form-control" id="nomorTelepon" placeholder="Enter Nomor Telepon">
                <label for="totalPulsa">Total Pulsa</label>
                <input type="number" class="form-control" id="totalPulsa" placeholder="Enter total pulsa">
            </div>
            <div class="form-group hidden" id="virtualAccountGroup">
                <label for="virtualAccount">Virtual Account Number</label>
                <input type="text" class="form-control" id="virtualAccount" placeholder="Enter virtual account number">
            </div>
            <button type="submit" class="btn btn-primary">Transfer</button>
        </form>
    </div>
</div>

<!-- Include Bootstrap JS and dependencies (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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

        const transferType = document.getElementById('transferType');
        const fromAccountGroup = document.getElementById('fromAccountGroup');
        const toAccountGroup = document.getElementById('toAccountGroup');
        const amountGroup = document.getElementById('amountGroup');
        const virtualAccountGroup = document.getElementById('virtualAccountGroup');
        const isiPulsaGroup = document.getElementById('isiPulsaGroup');
        const topUpGroup = document.getElementById('topUpGroup');

        transferType.addEventListener('change', function () {
            fromAccountGroup.classList.add('hidden');
            toAccountGroup.classList.add('hidden');
            amountGroup.classList.add('hidden');
            virtualAccountGroup.classList.add('hidden');
            isiPulsaGroup.classList.add('hidden');
            topUpGroup.classList.add('hidden');

            if (this.value === 'virtualAccount') {
                virtualAccountGroup.classList.remove('hidden');
            } else if(this.value === 'isiPulsa'){
                isiPulsaGroup.classList.remove('hidden');
            } else if(this.value === 'topUp'){
                topUpGroup.classList.remove('hidden');
            } else {
                fromAccountGroup.classList.remove('hidden');
                toAccountGroup.classList.remove('hidden');
                amountGroup.classList.remove('hidden');
            }
        });
        

    });
</script>
</body>
</html>
