<div class="container-fluid py-4">

    <div class="row">
        <div class="col-lg-12 col-mb-12 col-sm-12 m-1 p-2">

            <div class="card">
                <div class="row">
                    <div class="col-lg-12 prsection">

                        <div class="card-body mx-4">
                            <div class="container">
                                <p class="my-2 mx-2" style="font-size: 30px;">Laporan Transaksi
                                    {{ $trsc[0]->transaksi->no_transaksi }}</p>

                                <div class="row">
                                    <div class="my-1 mx-1">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">#Kode</th>
                                                    <th scope="col">Barang</th>
                                                    <th scope="col">Harga Barang</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Sub Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($trsc as $row)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $row->transaksi->no_transaksi }}</td>
                                                        <td>{{ $row->TransaksiBarang->nama_barang }}</td>
                                                        <td>{{ $row->harga_satuan ? 'Rp. ' . number_format($row->harga_satuan, 0, ',', '.') : 'Rp. ' . number_format(0) }}
                                                        </td>
                                                        <td>{{ $row->qty }}</td>
                                                        <td>{{ $row->sub_total ? 'Rp. ' . number_format($row->sub_total, 0, ',', '.') : 'Rp. ' . number_format(0) }}
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>



                                <div class="row text-black">

                                    <div class="col-xl-12">
                                        <p class="float-end fw-bold">Total:
                                            {{-- @dd($trsc[0]->id) --}}
                                            {{ $trsc[0]->transaksi->total ? 'Rp. ' . number_format($trsc[0]->transaksi->total, 0, ',', '.') : 'Rp. ' . number_format(0) }}
                                        </p>
                                    </div>
                                    <hr style="border: 2px solid black;">
                                </div>
                                <div class="text-center" style="margin-top: 90px;">


                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@push('front_scripts')
@endpush
