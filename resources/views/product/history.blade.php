<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KasirBosQ | Riwayat Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
            <div class="container-fluid">
                <a class="navbar-brand" href="/home">KasirBosQ</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/product">Manajemen Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/product/history">Riwayat Transaksi</a>
                        </li>
                        @if(auth()->user()->is_admin == 1)
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/user">Manajemen Pengguna</a>
                        </li>
                        @endif
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <form action="/logout" method="post">
                                @csrf
                                <button class="btn btn-sm btn-outline-danger fw-bold me-5" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">No. </th>
                    <th scope="col">Nama Pelanggan</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Tanggal Transaksi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $trs)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $trs->customer_name }}</td>
                    <td>{{ $trs->address }}</td>
                    <td>{{ $trs->created_at }}</td>
                    <td>
                        <a href="/invoice/{{ $trs->checkout_code }}" class="btn btn-warning btn-sm" target="_blank">Cetak Invoice</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>