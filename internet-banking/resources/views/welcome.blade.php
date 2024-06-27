<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TurtleBank</title>
    <link rel="stylesheet" href="style.css">

    <!-- Include Bootstrap CSS for styling (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Include SweetAlert CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert/dist/sweetalert.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
      <!-- Custom CSS -->
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
           
            <li class="nav-item">
                <a class="nav-link" href="#" data-target="news">News</a>
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
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
        <form method="POST" action="{{ route('profile.topup') }}">
        @csrf
        <label for="topup_amount">Top-up Amount:</label>
        <input type="number" id="topup_amount" name="amount" step="0.01" required>
        <button type="submit" class="btn btn-sm btn-success">
            <i class="mdi mdi-plus"></i> Tambah Uang
        </button>
        </form>
        
        <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        <input type="hidden" name="action" value="withdraw">
        <label for="withdraw_amount">Withdraw Amount:</label>
        <input type="number" id="withdraw_amount" name="amount" step="0.01" required>
        <button type="submit" class="btn btn-sm btn-danger">
            <i class="mdi mdi-minus"></i> Tarik Uang
        </button>
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
        <p>Phone Number: {{ $user->phone }}</p>
        <p>Account Number: {{ $user->account_number }}</p>
        <p>Balance: ${{ number_format($user->balance, 2) }}</p>
    </div>

   

    <div id="transactions" class="content">
    <div class="container mt-4">
        <h3>Transactions</h3>
        <form action="{{ route('transactions') }}" method="POST">
    @csrf

        @if (!empty($transfers) && $transfers->count() > 0)
            <table class="table table-sm table-striped table-bordered">
                <thead>
                    <tr>
                        <th>From Account</th>
                        <th>To Account</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transfers as $transfer)
                        <tr>
                            <td>{{ $transfer->from_account }}</td>
                            <td>{{ $transfer->to_account }}</td>
                            <td>${{ number_format($transfer->amount, 2) }}</td>
                            <td>{{ $transfer->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>
                                
                                <form action="{{ route('transactions.delete', $transfer->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="mdi mdi-delete"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada data transaksi yang tersedia.</p>
        @endif
        
    </div>
</div>

        
    <div id="transfer" class="content">
    <h3>Transfer Funds</h3>
    <form method="POST" action="{{ route('transfer.store') }}">
        @csrf
       
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
        </form>

        <div id="transfer-history" class="mt-4">
    <h3>Transfer History</h3>
    <ul id="transfer-history-list">
        <!-- Transfer history items will be dynamically populated here -->
        <!-- <li data-transfer-id="1"> -->
            <!-- <button class="btn btn-sm btn-danger float-end" onclick="deleteTransaction(1)">
                <i class="mdi mdi-delete"></i> Delete
            </button> -->
        </li>
    </ul>
</div>
    </div>
</div>


        
      
<div id="news" class="content">
    <h2>Latest News</h2>
    <p>Explore our latest news and updates:</p>

    
        <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="https://www.bni.co.id/Portals/1/xNews/uploads/2024/6/20/146242.jpg" class="img-fluid rounded-start" alt="BNI News Image">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">BNI News Article</h5>
                    <p class="card-text">Check out the latest article from BNI:</p>
                    <a href="https://www.bni.co.id/id-id/beranda/kabar-bni/berita/articleid/23497" class="btn btn-primary" target="_blank">Read Article</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="https://images.bisnis.com/posts/2024/06/26/1777344/02052024-bi-bio-24-ihsg_4_1714655020.jpg" class="img-fluid rounded-start" alt="Bisnis.com News Image">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">AMMN-ADMR Report on Jumbo's Stock Transactions</h5>
                    <p class="card-text">Read about the latest stock transaction report and its impact on stock prices.</p>
                    <a href="https://market.bisnis.com/read/20240626/7/1777344/ammn-admr-laporkan-transaksi-saham-jumbo-cek-pengaruh-ke-harga-saham" class="btn btn-primary" target="_blank">Read Article</a>
                </div>
            </div>
        </div>
        <!-- <form id="news-search-form">
            <div class="mb-3">
                <label for="news-search" class="form-label">Search News</label>
                <input type="text" class="form-control" id="news-search" placeholder="Enter keywords">
            </div>
            <button type="button" class="btn btn-primary" onclick="searchNews()">Search</button>
            <button type="button" class="btn btn-secondary" onclick="resetSearch()">Reset</button>
        </form>

        < <div id="news-results">
            <!-- Search results will be displayed here -->
        <!-- </div> 
    </div> -->
</div> 
    </div>
</div>
</div>

<!-- Include jQuery, Bootstrap JS, and SweetAlert JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

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
        let formData = {};
        let isValid = true;

        // Ambil data formulir berdasarkan jenis transfer
        if (transferType.value === 'account') {
            formData = {
                fromAccount: document.getElementById('fromAccount').value.trim(),
                toAccount: document.getElementById('toAccount').value.trim(),
                amount: document.getElementById('amount').value.trim()
            };

            // Periksa apakah nomor akun telah diisi
            if (formData.fromAccount === '' || formData.toAccount === '') {
                isValid = false;
            }
        } else if (transferType.value === 'topUp') {
            formData = {
                ewalletAccount: document.getElementById('ewalletAccount').value.trim(),
                topUpAmount: document.getElementById('topUpAmount').value.trim()
            };
            // Periksa apakah nomor akun e-wallet telah diisi
            if (formData.ewalletAccount === '') {
                isValid = false;
            }
        } else if (transferType.value === 'isiPulsa') {
            formData = {
                nomorTelepon: document.getElementById('nomorTelepon').value.trim(),
                totalPulsa: document.getElementById('totalPulsa').value.trim()
            };
            // Periksa apakah nomor telepon dan total pulsa telah diisi
            if (formData.nomorTelepon === '' || formData.totalPulsa === '') {
                isValid = false;
            }
        } else if (transferType.value === 'virtualAccount') {
            formData = {
                virtualAccount: document.getElementById('virtualAccount').value.trim()
            };
            // Periksa apakah virtual account telah diisi
            if (formData.virtualAccount === '') {
                isValid = false;
            }
        }

        // Jika data tidak valid, tampilkan pesan kesalahan
        if (!isValid) {
            swal('Error', 'Silakan lengkapi semua kolom yang diperlukan.', 'error');
            return;
        }
        

        // Kirim data ke server menggunakan Axios jika valid
        axios.post('{{ route('transfer.store') }}', formData)
            .then(function(response) {
                // Tanggapan dari server (opsional)
                console.log(response.data);

                const currentDate = new Date();
                const createdAt = currentDate.toLocaleString();
                const transferHistoryList = document.getElementById('transfer-history-list');
        const newTransferItem = document.createElement('li');
        newTransferItem.textContent = `Transfer ${formData.amount} to ${formData.toAccount} pada ${createdAt}`;
        transferHistoryList.appendChild(newTransferItem);
                // Tampilkan notifikasi sukses kepada pengguna
                swal({
                    title: 'Sukses',
                    text: 'Transaksi berhasil disimpan.',
                    icon: 'success'
                }).then((value) => {
                    // Lakukan pengalihan halaman atau tindakan lain jika diperlukan
                    window.location.href = '{{ route('transfer.store') }}'; // Ganti dengan URL tujuan
                    // window.location.href = '{{ route('transactions') }}'; // Ganti dengan route untuk menampilkan transaksi

                });
            })
            .catch(function(error) {
                // Tanggapan jika terjadi kesalahan
                console.error(error);
                swal('Error', 'Terjadi kesalahan saat melakukan transfer.', 'error');
            });
    } else {
        swal('Terjadi kesalahan!');
    }
   
   
}

</script>
</body>
</html>
