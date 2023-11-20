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
                            <a class="nav-link active" aria-current="page" href="/product">Manajemen Produk</a>
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

        <form action="/product/search/" method="post">
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

        <a class="btn btn-success mb-3" href="/product/create">Tambahkan Produk Baru</a>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No. </th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Kategori Produk</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Aksi</th>
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
                                <a href="/product/edit/{{$prod->id}}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="/product/delete/{{$prod->id}}" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>