@extends('layouts.front')
@section('web_title')
    Detail Buat Transaksi
@endsection

@section('content')
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-lg-12">
                <h5 class="text-danger fw-bold">Detail Transaksi No: {{ $transaksi->no_transaksi }}</h5>
                <a href="{{ route('penjualan_index') }}" class="btn btn-sm btn-outline-success"><i
                        class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-mb-12 col-sm-12 mt-3">
                <div class="card">
                    <form action="javascript:;" id="formTransaksiDetail" method="post" class="">
                        <div class="card-body">
                            <div class="d-flex">
                                <input type="hidden" id="transaksiId" name="transaksi_id" value="{{ $transaksi->id }}">
                                <div class="col-lg-3">
                                    <label class="form-label text-primary fw-bold" for="">Barang</label>
                                    <select name="barang_id" id="barangId" class="form-control border">
                                        <option>Pilih Barang</option>
                                        @foreach ($barang as $value)
                                            <option value="{{ $value->id }}">
                                                {{ $value->kode_barang }} - {{ $value->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3 ms-2">
                                    <label class="form-label text-primary fw-bold" for="">Harga Satuan</label>
                                    <input type="number" name="harga_satuan" id="hargaSatuan" class="form-control border"
                                        placeholder="harga satuan">
                                </div>
                                <div class="col-lg-3 ms-2">
                                    <label class="form-label text-primary fw-bold" for="">Qty</label>
                                    <input type="number" name="qty" id="qtyBarang" class="form-control border"
                                        placeholder="qty">
                                </div>
                                <div class="col-lg-2 ms-2 ps-3 px-3 mt-1 ">
                                    <div class="row">
                                        <label class="form-label text-primary fw-bold" for="">Aksi</label>
                                        <button type="submit" class="btn btn-sm btn-outline-success">+ Tambah</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <p class="text-primary fw-normal">Item Pembelian</p>
                            <table id="tableItemTransaksi" class="table table-hover table-striped align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Aksi</th>
                                        <th>No</th>
                                        <th>Barang</th>
                                        <th>
                                            Harga</th>
                                        <th>Qty</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('front_scripts')
    <script src="{{ asset('penjualan_js/transaksi_detail.js') }}"></script>
@endpush
