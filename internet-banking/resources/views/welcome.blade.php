<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TurtleBank</title>
    <!-- Include Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Include SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert/dist/sweetalert.css">
    <style>
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
        <!-- Dashboard Button -->
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
    </div>

    <div id="accounts" class="content">
        <h3>Account Summary</h3>
        <p>Account Number: 1234567890</p>
        <p>Balance: $5,000.00</p>
    </div>

    <div id="transactions" class="content">
        <h3>Transactions</h3>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
            <thead>
                <tr>
                        <th>Project Name</th>
                        <th>Client Name</th>
                        <th>Payment Type</th>
                        <th>Paid Date</th>
                    <th>Amount</th>
                        <th>Transaction</th>
                        <th>Tambah Uang</th> <!-- Kolom baru untuk opsi "Tambah Uang" -->

                </tr>
            </thead>
            <tbody>
                <tr>
                        <td>Product Development</td>
                        <td><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="thumb-sm rounded-circle mr-2" style="width: 30px; height: auto;"> Kevin Heal</td>
                        <td>Gopay</td>
                        <td>5/8/2018</td>
                        <td>$15,000</td>
                        <td><span class="badge badge-boxed badge-soft-warning text-dark" >Pending</span></td>
                        <td><button class="btn btn-sm btn-success"><i class="mdi mdi-plus"></i> Tambah Uang</button></td>

                </tr>
                <tr>
                        <td>New Office Building</td>
                        <td><img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" class="thumb-sm rounded-circle mr-2" style="width: 30px; height: auto;"> Frank M. Lyons</td>
                        <td>Gopay</td>
                        <td>15/7/2018</td>
                        <td>$35,000</td>
                        <td><span class="badge badge-boxed badge-soft-warning text-dark" >Success</span></td>
                        <td><button class="btn btn-sm btn-success"><i class="mdi mdi-plus"></i> Tambah Uang</button></td>

                    </tr>
                  
                    <tr>
                        <td>Market Research</td>
                        <td><img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="" class="thumb-sm rounded-circle mr-2" style="width: 30px; height: auto;"> Angelo Butler</td>
                        <td>Gopay</td>
                        <td>30/9/2018</td>
                        <td>$45,000</td>
                        <td><span class="badge badge-boxed badge-soft-warning text-dark">Panding</span></td>
                        <td><button class="btn btn-sm btn-success"><i class="mdi mdi-plus"></i> Tambah Uang</button></td>

                    </tr>
                    <tr>
                        <td>Website &amp; Blog</td>
                        <td><img src="https://bootdey.com/img/Content/avatar/avatar4.png" alt="" class="thumb-sm rounded-circle mr-2" style="width: 30px; height: auto;"> Phillip Morse</td>
                        <td>Gopay</td>
                        <td>2/6/2018</td>
                        <td>$70,000</td>
                        <td><span class="badge badge-boxed badge-soft-warning text-dark ">Success</span></td>
                        <td><button class="btn btn-sm btn-success"><i class="mdi mdi-plus"></i> Tambah Uang</button></td>

                </tr>
                    <tr>
                    <td>
                    <!-- Add more rows as needed -->
            </tbody>
        </table>
        </div>
        <!--end table-responsive-->
        <div class="pt-3 border-top text-right"><a href="#" class="text-dark">View all <i class="mdi mdi-arrow-right"></i></a></div>
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
                <select class="form-control" id="ewalletProvider">
                    <option value="gopay">Gopay</option>
                    <option value="dana">Dana</option>
                    <option value="Ovo">Ovo</option>
                    <option value="ShoopePay">ShoopePay</option>
                    <option value="LinkAja">LinkAja</option>
                </select>
                <label for="ewalletAccount">E-Wallet Account</label>
                <input type="text" class="form-control" id="ewalletAccount"  placeholder="Enter e-wallet account number">
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

                <button type="button" class="btn btn-outline-success" onclick="showSwal('success-message')">Transfer</button>
            </div>
        </form>
    </div>
</div>

<!-- Include jQuery, Bootstrap JS, and SweetAlert JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert/dist/sweetalert.min.js"></script>

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
    
    function showSwal(type) {
    'use strict';
    if (type === 'success-message') {
        // Check if required fields are filled
        if (transferType.value === 'account') {
            // If transferring with account number, check if account fields are filled
            const fromAccount = document.getElementById('fromAccount').value.trim();
            const toAccount = document.getElementById('toAccount').value.trim();
            const amount = document.getElementById('amount').value.trim();

            if (fromAccount === '' || toAccount === '' || amount === '') {
                swal("Error", "Please fill in all account details.", "error");
                return;
            }
        } else if (transferType.value === 'topUp') {
            // If topping up e-wallet, check if e-wallet fields are filled
            const ewalletAccount = document.getElementById('ewalletAccount').value.trim();
            const topUpAmount = document.getElementById('topUpAmount').value.trim();

            if (ewalletAccount === '' || topUpAmount === '') {
                swal("Error", "Please fill in all e-wallet details.", "error");
                return;
            }
        } else if (transferType.value === 'isiPulsa') {
            // If topping up mobile credit, check if mobile credit fields are filled
            const nomorTelepon = document.getElementById('nomorTelepon').value.trim();
            const totalPulsa = document.getElementById('totalPulsa').value.trim();

            if (nomorTelepon === '' || totalPulsa === '') {
                swal("Error", "Please fill in all mobile credit details.", "error");
                return;
            }
        } else if (transferType.value === 'virtualAccount') {
            // If using virtual account, check if virtual account field is filled
            const virtualAccount = document.getElementById('virtualAccount').value.trim();

            if (virtualAccount === '') {
                swal("Error", "Please fill in the virtual account number.", "error");
                return;
            }
        }

        // If all checks pass, show success message
        swal({
            title: 'Selamat',
            text: 'Transaksi Anda berhasil',
            icon: 'success',
            button: {
                text: "Continue",
                value: true,
                visible: true,
                className: "btn btn-primary"
            }
        });
    } else {
        swal("Error occurred!");
    }
}
</script>
</body>
</html>
