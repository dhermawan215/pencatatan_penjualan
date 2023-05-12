@extends('layouts.front')
@section('web_title')
    Data Transaksi
@endsection

@section('content')
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-lg-12 col-mb-12 col-sm-12 m-1 p-2">
                <a href="{{ route('penjualan_index') }}" class="btn btn-sm btn-outline-success"><i
                        class="fa fa-arrow-left"></i> Kembali</a>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tableTransaksi" class="table table-hover table-striped align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Aksi</th>
                                        <th>No</th>
                                        <th>TR No</th>
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
                                        <td><input type="text" class="form-control tfoot-seacrh border"
                                                placeholder="nomer transaksi" id="tfootTrNo"
                                                data-index="<?php echo $data_index;
                                                $data_index++; ?>">
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
    <script src="{{ asset('penjualan_js/view_transaksi.min.js?q=') . time() }}"></script>
@endpush
