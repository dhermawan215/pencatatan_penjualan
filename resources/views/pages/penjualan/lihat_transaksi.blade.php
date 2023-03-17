@extends('layouts.front')
@section('web_title')
    Data Transaksi
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <label class="text-primary fw-bold">Pencarian Bulanan</label>
                        <select name="bulan" id="bulanSearch" class="form-control border">
                            <option>Pilih Bulan</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                </div>
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
                            <table id="tableTransaksi" class="table table-hover table-striped align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Aksi</th>
                                        <th>No</th>
                                        <th class="text-center text-uppercase text-secondary font-weight-bolder ">
                                            Tgl</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder ">Pembeli</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder  ps-2">
                                            Total</th>

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
                                        <td><input type="date" class="form-control tfoot-seacrh border"
                                                placeholder="cari tanggal" id="tfootTgl" data-index="<?php echo $data_index;
                                                $data_index++; ?>">
                                        </td>
                                        <td><input type="text" class="form-control tfoot-seacrh border"
                                                placeholder="cari pembeli" id="tfootBarang"
                                                data-index="<?php echo $data_index;
                                                $data_index++; ?>">
                                        </td>
                                        <td><input type="text" class="form-control tfoot-seacrh border"
                                                placeholder="cari total bayar" id="tfootnQty"
                                                data-index="<?php echo $data_index;
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
    <script src="{{ asset('penjualan_js/view_transaksi.js') }}"></script>
@endpush
