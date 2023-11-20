<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KasirBosQ Invoice</title>
    <style>
        body {
            background-color: #F6F6F6;
            margin: 0;
            padding: 0;
            font-family: 'Tahoma';
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
            padding: 0;
        }

        p {
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }

        .brand-section {
            background-color: #0d1033;
            padding: 10px 40px;
        }

        .logo {
            width: 50%;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-6 {
            width: 50%;
            flex: 0 0 auto;
        }

        .text-white {
            color: #fff;
        }

        .company-details {
            float: right;
            text-align: right;
        }

        .body-section {
            padding: 16px;
            border: 1px solid gray;
        }

        .heading {
            font-size: 20px;
            margin-bottom: 08px;
        }

        .sub-heading {
            color: #262626;
            margin-bottom: 05px;
        }

        table {
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }

        table thead tr {
            border: 1px solid #111;
            background-color: #f2f2f2;
        }

        table td {
            vertical-align: middle !important;
            text-align: center;
        }

        table th,
        table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }

        .table-bordered {
            box-shadow: 0px 0px 5px 0.5px gray;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .text-right {
            text-align: end;
        }

        .w-20 {
            width: 20%;
        }

        .float-right {
            float: right;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="brand-section">
            <div class="row">
                <div class="col-6">
                    <h1 class="text-white">KasirBosQ</h1>
                </div>
            </div>
        </div>

        <div class="body-section">
            <div class="row">
                <div class="col-6">
                    <h2 class="heading">Invoice No.: {{ $transactions[0]->id }}</h2>
                    <p class="sub-heading">Kode Checkout: {{ $transactions[0]->checkout_code }} </p>
                    <p class="sub-heading">Tanggal Transasksi: {{ $transactions[0]->created_at }} </p>
                </div>
                <div class="col-6">
                    <p class="sub-heading">Full Name: {{ $transactions[0]->customer_name }}</p>
                    <p class="sub-heading">Address: {{ $transactions[0]->address }}</p>
                </div>
            </div>
        </div>

        <div class="body-section">
            <h3 class="heading">Detail Pesanan</h3>
            <br>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th class="w-20">Kategori</th>
                        <th class="w-20">Harga Satuan</th>
                        <th class="w-20">Kuantitas</th>
                        <th class="w-20">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @php($total = 0)
                    @foreach($transactions as $trs)
                    <tr>
                        <td>{{ $trs->product_name }}</td>
                        <td>{{ $trs->category }}</td>
                        <td>Rp {{ number_format($trs->price) }}</td>
                        <td>{{ $trs->quantity }}</td>
                        <td>Rp {{ number_format($trs->price * $trs->quantity) }}</td>
                        @php($total += $trs->price * $trs->quantity)
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-right"><b>Total Keseluruhan</b></td>
                        <td>Rp {{ number_format($total) }}</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <h3 class="heading">Admin yang Bertugas: {{ $transactions[0]->name }}</h3>
        </div>

        <div class="body-section">
            <p>&copy; Copyright 2023 - KasirBosQ. All rights reserved.
                <a href="/" class="float-right">www.kasirbosq.com</a>
            </p>
        </div>
    </div>

</body>

</html>