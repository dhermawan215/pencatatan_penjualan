<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            border-style: solid;
            /* border-color: #000; */
            margin: 10px;
            padding: 2px;
            width: 98%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <h2>Laporan Transaksi Harian {{ $data[0]['tgl_header'] }}</h2>

    @foreach ($data as $key)
        <div style="border-style: solid; margin-bottom: 15px;">
            <div style="margin: 10px">
                <p>No Transaksi:{{ $key['no_trsc'] }} </p>
                <p>Tanggal Transaksi: {{ $key['tanggal'] }}</p>
                <p>Total Bayar: Rp.
                    {{ $key['total'] ? number_format($key['total'], 0, ',', '.') : number_format(0) }}
                </p>
                <p>Detail Transaksi: </p>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Harga Satuan</th>
                        <th>Qty</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($key['relasi'] as $relasitable)
                        <tr>

                            <td> {{ $relasitable->TransaksiBarang->nama_barang }}</td>
                            <td>Rp.
                                {{ $relasitable->harga_satuan ? number_format($relasitable->harga_satuan, 0, ',', '.') : number_format(0) }}
                            </td>
                            <td> {{ $relasitable->qty }} </td>
                            <td>Rp.
                                {{ $relasitable->sub_total ? number_format($relasitable->sub_total, 0, ',', '.') : number_format(0) }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    @endforeach

</body>

</html>
