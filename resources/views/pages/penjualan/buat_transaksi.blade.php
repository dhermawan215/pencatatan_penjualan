@extends('layouts.front')
@section('web_title')
    Buat Transaksi
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-4">
                <h5 class="text-danger fw-bold">Formulir Buat Transaksi</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-mb-12 col-sm-12 m-1 p-2">
                <div class="card">
                    <div class="card-body">
                        <form action="javascript:;" id="formBuatTransaksi" method="post" class="p-1">
                            @csrf
                            <label class="form-label fw-bold">Tgl Transaksi</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="date" name="tanggal" id="tglTrsc" class="form-control">
                            </div>
                            <label class="form-label fw-bold mt-1">Pembeli</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" name="pembeli" id="pembeli" class="form-control"
                                    placeholder="masukan nama pembeli">
                            </div>
                            <label class="form-label fw-bold mt-1">Alamat</label>
                            <div class="input-group input-group-outline mb-3">
                                <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control"
                                    placeholder="masukan alamat pembeli"></textarea>
                            </div>
                            <label class="form-label fw-bold mt-1">Dilayani oleh</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" name="dilayani_oleh" id="dilayaniOleh" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('penjualan_index') }}" class="btn btn-outline-success ms-1">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('front_scripts')
    <script src="{{ asset('penjualan/buat.js') }}"></script>
@endpush
