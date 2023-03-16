@extends('layouts.front')
@section('web_title')
    Data Barang - Edit
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">

            <div class="col-lg-4">

                <h5 class="text-danger fw-bold">Edit Barang {{ $data->kode_barang }}</h5>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-mb-12 col-sm-12 m-1 p-2">
                <div class="card">
                    <div class="card-body">
                        <form action="javascript:;" id="formEditBarang" method="post" class="p-1">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="idValue" value="{{ $data->id }}">
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Kode Barang</label>
                                <input type="text" name="kode_barang" id="kodeBarang" class="form-control"
                                    value="{{ $data->kode_barang }}">
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Nama Barang</label>
                                <input type="text" name="nama_barang" id="namaBarang" class="form-control"
                                    value="{{ $data->nama_barang }}">
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Harga Barang</label>
                                <input type="number" name="harga" id="hargaBarang" class="form-control"
                                    value="{{ $data->harga }}">
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Didaftarkan Oleh</label>
                                <input type="text" name="didaftarkan_oleh" id="didaftarkanOleh" class="form-control"
                                    value="{{ $data->didaftarkan_oleh }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('barang.index') }}" class="btn btn-outline-success ms-1">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('front_scripts')
    <script src="{{ asset('data_barang/edit.js') }}"></script>
@endpush
