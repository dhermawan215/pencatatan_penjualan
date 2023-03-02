@extends('layouts.front')
@section('web_title')
    Data Barang
@endsection

@section('content')
    <div class="container-fluid py-4">
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
    </div>
@endsection
