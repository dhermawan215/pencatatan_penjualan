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
                        <p class="lead fw-bold text-primary">Detail:</p>

                        <div class="row">
                            <div class="col mb-3">
                                <p class="small ">Tanggal</p>
                                <p>{{ $transaksi->tanggal }}</p>
                            </div>
                            <div class="col mb-3">
                                <p class="small  ">Pembeli</p>
                                <p>{{ $transaksi->pembeli }}</p>
                            </div>
                            <div class="col mb-3">
                                <p class="small  ">Alamat</p>
                                <p>{{ $transaksi->alamat }}</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-mb-12 col-sm-12 mt-3">
                <div class="card">
                    <form action="javascript:;" id="formTransaksiDetail" method="post" class="">
                        <div class="card-body">
                            @csrf
                            <h6 class="h6 text-primary mb-1">Tambah Detail Pembelian Barang</h6>
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
                                <div class="col-lg-2 ms-2">
                                    <label class="form-label text-primary fw-bold" for="">Harga Satuan</label>
                                    <input type="number" name="harga_satuan" id="hargaSatuan" class="form-control border"
                                        placeholder="harga satuan">
                                </div>
                                <div class="col-lg-2 ms-2">
                                    <label class="form-label text-primary fw-bold" for="">Qty</label>
                                    <input type="number" name="qty" id="qtyBarang" class="form-control border"
                                        placeholder="qty">
                                </div>
                                <div class="col-lg-2 ms-2">
                                    <label class="form-label text-primary fw-bold" for="">Sub Total</label>
                                    <input type="number" name="sub_total" id="subTotal" class="form-control border"
                                        placeholder="sub total">
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
                            <h6 class="text-primary fw-bold">Item Pembelian</h6>
                            <table id="tableItemTransaksi" class="table table-hover table-striped align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Barang</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-lg-12 col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="text-primary fw-bold">Total Pembayaran</h6>
                        <form action="javascript:;" id="formTransaksiTotal" method="post" class="">
                            @csrf
                            <input type="hidden" id="transaksiId" name="transaksi_id" value="{{ $transaksi->id }}">

                            <div class="row">
                                <div class="d-flex">
                                    <div class="col-lg-10 col-md-10 col-sm-12">
                                        <div class="d-flex">
                                            <label for="total" class="col-form-label">Total: </label>
                                            <input type="number" id="total" class="form-control border ms-2">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12">
                                        <label for=""></label>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('front_scripts')
    <script src="{{ asset('penjualan_js/transaksi_detail.js') }}"></script>
@endpush
