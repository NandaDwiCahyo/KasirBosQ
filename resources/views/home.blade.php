<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KasirBosQ | Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body style="overflow-x: hidden;">
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
                            <a class="nav-link active" aria-current="page" href="/home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/product">Manajemen Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/product/history">Riwayat Transaksi</a>
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

        <form action="/home/search/" method="post">
            @csrf
            <div class="input-group w-25 mb-5">
                <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" name="category">
                    <option selected>Pilih kategori ...</option>
                    @foreach($categories as $ctg)
                    <option value="{{$ctg->id}}">{{$ctg->category}}</option>
                    @endforeach
                </select>
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </form>

        <div class="row">
            <div class="col-md-8">
                <form action="/home" method="post">
                    @csrf
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No. </th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Harga Satuan</th>
                                <th scope="col">Kuantitas Pembelian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $prod)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$prod->product_name}}</td>
                                <td>{{$prod->category}}</td>
                                <td>{{$prod->stock}}</td>
                                <td>Rp {{number_format($prod->price)}}</td>
                                <td>
                                    <input type="hidden" value="{{$prod->id}}" name="product_id[{{$loop->iteration}}]">
                                    <input type="hidden" value="{{$prod->category_id}}" name="category_id[{{$loop->iteration}}]">
                                    <input type="number" class="form-control w-50" value="0" name="quantity[{{$loop->iteration}}]">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <button class="btn btn-primary w-100 mb-3" type="submit">Konfirmasi Pesanan</button>
                </form>
            </div>

            <div class="col-md-4">
                <form action="/home/transaction" method="post">
                    @csrf
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="customer_name">Nama anda: </span>
                        <input type="text" class="form-control" aria-describedby="customer_name" name="customer_name">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="customer_address">Alamat anda: </span>
                        <input type="text" class="form-control" aria-describedby="customer_address" name="address">
                    </div>
                    <div class="card">
                        <div class="card-header">
                            Keranjang Belanja
                            <span>
                                <a href="/home/clearcart" class="btn btn-sm btn-danger float-end" type="submit">Bersihkan Keranjang</a>
                            </span>
                        </div>
                        <ul class="list-group list-group-flush">
                            @php($total = 0)
                            @foreach($carts as $crt)
                            <li class="list-group-item">{{ $crt->product_name }} <span class="badge text-bg-success float-end mx-1">Rp {{ number_format($crt->quantity * $crt->price) }}</span> <span class="badge text-bg-primary float-end">{{ $crt->quantity }}</span></li>
                            @php($total += $crt->quantity * $crt->price)
                            @endforeach
                            <li class="list-group-item"><b>Total Pembayaran</b> <span class="badge text-bg-success float-end mx-1"><b>Rp {{ number_format($total) }}</b></span></li>
                        </ul>
                    </div>
                    <button class="btn btn-success w-100 mt-3" type="submit">Checkout</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>