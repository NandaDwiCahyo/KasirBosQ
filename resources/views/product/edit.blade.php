<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KasirBosQ | Manajemen Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body style="overflow-x: hidden;">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">KasirBosQ</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/product">Manajemen Barang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/product/history">Riwayat Transaksi</a>
                        </li>
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

        @foreach($product as $prod)
        <form method="post" action="/product/edit/{{$prod->id}}">
            @csrf
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="product_name" value="{{$prod->product_name}}">
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok Produk</label>
                <input type="number" class="form-control" id="stok" name="stock" value="{{$prod->stock}}">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga Produk Satuan</label>
                <input type="number" class="form-control" id="harga" name="price" value="{{$prod->price}}">
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Pilih Kategori Produk</label>
                <select class="form-select" id="kategori" name="category" aria-label="Example select with button addon">
                    @foreach($categories as $ctg)
                    <option value="{{$ctg->id}}">{{$ctg->category}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-warning">Ubah Produk</button>
        </form>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>