@extends('layouts.front')
@section('web_title')
    Data Stok Barang
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-2">
                <!-- Button trigger modal -->
                <a href="{{ route('stok.create') }}" class="btn btn-sm btn-primary"> <i class="fa fa-plus"
                        aria-hidden="true"></i><span>Tambah Stok Barang</span></a>
            </div>
            {{-- <div class="col-lg-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning btn-sm">
                    <i class="fa fa-plus" aria-hidden="true"></i><span>Edit Barang</span>
                </button>
            </div> --}}

            <div class="col-lg-6">

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-mb-12 col-sm-12 m-1 p-2">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tableStokBarang" class="table table-hover table-striped align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Aksi</th>
                                        <th>No</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder ">
                                            Barang</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder  ps-2">
                                            Qty</th>
                                        <th class="text-center text-uppercase text-secondary font-weight-bolder ">
                                            Tgl</th>
                                    </tr>
                                </thead>
                                <?php $data_index = 0; ?>
                                <tfoot>
                                    <tr>
                                        <td>
                                            <input type="hidden" data-index="<?php echo $data_index;
                                            $data_index++;
                                            ?>">
                                        </td>
                                        <td>
                                            <input type="hidden" data-index="<?php echo $data_index;
                                            $data_index++;
                                            ?>">
                                        </td>
                                        <td><input type="text" class="form-control tfoot-seacrh"
                                                placeholder="cari barang" id="tfootBarang" data-index="<?php echo $data_index;
                                                $data_index++; ?>">
                                        </td>
                                        <td><input type="text" class="form-control tfoot-seacrh"
                                                placeholder="cari qty stok" id="tfootnQty" data-index="<?php echo $data_index;
                                                $data_index++; ?>">
                                        </td>
                                        <td><input type="date" class="form-control tfoot-seacrh"
                                                placeholder="cari tanggal" id="tfootTgl" data-index="<?php echo $data_index;
                                                $data_index++; ?>">
                                        </td>
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

@push('front_scripts')
    <script src="{{ asset('stok_awal/view.js') }}"></script>
@endpush
