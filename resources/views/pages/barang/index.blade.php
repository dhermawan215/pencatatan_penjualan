@extends('layouts.front')
@section('web_title')
    Data Barang
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa fa-plus" aria-hidden="true"></i><span>Tambah Barang</span>
                </button>
            </div>
            <div class="col-lg-10">

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-mb-12 col-sm-12 m-1 p-2">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tableBarang" class="table table-hover table-striped align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>No</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder ">
                                            No Barang</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder  ps-2">
                                            Nama</th>
                                        <th class="text-center text-uppercase text-secondary font-weight-bolder ">
                                            Harga</th>
                                        <th class="text-center text-uppercase text-secondary font-weight-bolder ">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><input type="text" class="form-control " placeholder="cari no barang"
                                                id="tfoot-nobarang-search"></td>
                                        <td><input type="text" class="form-control " placeholder="cari nama barang"
                                                id="tfoot-namabarang-search"></td>
                                        <td><input type="text" class="form-control " placeholder="cari harga"
                                                id="tfoot-harga-search"></td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Formulir Tambah Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="p-1">
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Kode Barang</label>
                                <input type="text" name="kode_barang" id="kodeBarang" class="form-control">
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Nama Barang</label>
                                <input type="text" name="nama_barang" id="namaBarang" class="form-control">
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Harga Barang</label>
                                <input type="number" name="harga" id="hargaBarang" class="form-control">
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Didaftarkan Oleh</label>
                                <input type="text" name="didaftarkan_oleh" id="didaftarkanOleh" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
