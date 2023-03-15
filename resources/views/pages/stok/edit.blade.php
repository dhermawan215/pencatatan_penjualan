@extends('layouts.front')
@section('web_title')
    Edit Stok Barang
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-4">
                <h5 class="text-danger fw-bold">Edit Stok Barang</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-mb-12 col-sm-12 m-1 p-2">
                <div class="card">
                    <div class="card-body">
                        <form action="javascript:;" id="formEditStok" method="post" class="p-1">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="idValue" value="{{ $edit->id }}">
                            <label class="form-label">Barang</label>
                            <div class="input-group input-group-outline mb-3">
                                <select name="barang_id" id="idBarang" class="form-control">
                                    <option value="{{ $edit->barang_id }}">{{ $edit->StokBarang->kode_barang }} |
                                        {{ $edit->StokBarang->nama_barang }}</option>
                                    <option>Pilih Barang</option>
                                    @foreach ($barang as $data)
                                        <option value="{{ $data->id }}">
                                            {{ $data->kode_barang }} | {{ $data->nama_barang }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Qty</label>
                                <input type="number" name="qty_stok" id="qty" class="form-control"
                                    value="{{ $edit->qty_stok }}">
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Tgl Input</label>
                                <input type="date" name="tgl_input" id="tglInput" class="form-control"
                                    value="{{ $edit->tgl_input }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('stok.index') }}" class="btn btn-outline-success ms-1">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('front_scripts')
    <script src="{{ asset('stok_awal/edit.js') }}"></script>
@endpush
