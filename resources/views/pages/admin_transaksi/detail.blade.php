@extends('layouts.front')
@section('web_title')
    Admin - Detail Transaksi
@endsection

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-4">
                <a href="{{ route('transaksi.index') }}" class="btn btn-outline-success">Kembali</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">

            </div>
            <div class="col-lg-8 prsection">
                <div class="card ">
                    <div class="card-body mx-4">
                        <div class="container">
                            <p class="my-2 mx-2" style="font-size: 30px;">Detail Transaksi</p>
                            <div class="row">
                                <hr>
                                <h6 class="text-primary ">Detail Pelanggan:</h6>
                                <ul class="list-unstyled">
                                    <li class="text-black fw-bold">{{ $trdata->pembeli }}</li>
                                    <li class="text-muted mt-1"><span class="text-black">Invoice</span>
                                        #{{ $trdata->no_transaksi }}</li>
                                    <li class="text-black mt-1">{{ $trdata->tanggal }}</li>
                                </ul>
                                <hr>
                                <h6 class="text-primary ">Item:</h6>
                            </div>
                            <div class="row">
                                <div class="my-1 mx-1">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Barang</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($trdetail as $valdetail)
                                                <tr class="text-center">
                                                    <th scope="row">{{ $no++ }}</th>
                                                    <td>{{ $valdetail->TransaksiBarang->nama_barang }}</td>
                                                    <td>{{ $valdetail->harga_satuan ? 'Rp. ' . number_format($valdetail->harga_satuan, 0, ',', '.') : 'Rp. ' . number_format(0) }}
                                                    </td>
                                                    <td>{{ $valdetail->qty }}</td>
                                                    <td>{{ $valdetail->sub_total ? 'Rp. ' . number_format($valdetail->sub_total, 0, ',', '.') : 'Rp. ' . number_format(0) }}
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
                                        {{ $trdata->total ? 'Rp. ' . number_format($trdata->total, 0, ',', '.') : 'Rp. ' . number_format(0) }}
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
@endsection

@push('front_scripts')
@endpush
