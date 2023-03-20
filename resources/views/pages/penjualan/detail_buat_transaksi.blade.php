@extends('layouts.front')
@section('web_title')
    Detail Buat Transaksi
@endsection

@section('content')
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-lg-12">
                <h5 class="text-danger fw-bold">Detail Transaksi No: {{ $transaksi->no_transaksi }}</h5>
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
            <div class="col-lg-12 col-mb-12 col-sm-12 m-1 p-2">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="col-lg-2">
                                <label for="">Pilih Barang</label>
                                <select name="barang_id" id="barangId" class="form-control border">
                                    <option value="">Pilih Barang</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <label for="">Harg Satuan</label>
                                <input type="number" name="harga_satuan" id="hargaSatuan" class="form-control border">
                            </div>
                            <div class="col-lg-2">
                                <input type="number" name="qty" id="qtyBarang" class="form-control border">
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('front_scripts')
    <script src="{{ asset('penjualan_js/buat.js') }}"></script>
@endpush
