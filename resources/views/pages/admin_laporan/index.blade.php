@extends('layouts.front')
@section('web_title')
    Admin - Data Laporan Penjualan
@endsection

@section('content')
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-lg-12 col-mb-12 col-sm-12 m-1 p-2">

                <div class="card">

                    <h6 class="h6 fw-bold my-2 py-2 mx-4 px-2">Laporan Penjualan</h6>

                    <div class="card-body">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                    aria-selected="true">No Transaksi</button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                    aria-selected="false">Harian</button>
                                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                                    aria-selected="false">Mingguan</button>
                                <button class="nav-link" id="nav-other-tab" data-bs-toggle="tab" data-bs-target="#nav-other"
                                    type="button" role="tab" aria-controls="nav-contact"
                                    aria-selected="false">Bulanan</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <div class="m-2">
                                    <form action="javascript:;" id="formNoTrsc" class="p-1" method="post">
                                        @csrf
                                        <label for="">Cari berdasarkan nomer transaksi</label>
                                        <div class="input-group">
                                            <select name="no_transaksi" id="noTrsc" class="form-control ">
                                                <option>Pilih No Transaksi</option>
                                            </select>
                                        </div>

                                        <div class="form-group mt-3">
                                            <button type="submit" class="btn mt-2 btn-sm btn-primary">Cetak
                                                Laporan</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="m-2">
                                    <form action="javascript:;" class="p-1" id="formCariHarian" method="post">
                                        <label for="harian">Tanggal Pencarian</label>
                                        <div class="input-group">
                                            <input type="date" name="harian" id="harian" class="form-control border">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn mt-2 btn-sm btn-primary">Cetak
                                                Laporan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="m-2">
                                    <form action="javascript:;" class="p-1" id="formCariMingguan" method="post">
                                        <label for="harian">Tanggal Pencarian Awal</label>
                                        <div class="input-group">
                                            <input type="date" name="awal_minggu" id="awal_minggu"
                                                class="form-control border">
                                        </div>
                                        <label for="harian">Tanggal Pencarian Akhir</label>
                                        <div class="input-group">
                                            <input type="date" name="akhir_minggu" id="akhir_minggu"
                                                class="form-control border">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn mt-2 btn-sm btn-primary">Cetak
                                                Laporan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-other" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="m-2">
                                    <form action="javascript:;" class="p-1" id="formCariHarian" method="post">
                                        <label for="harian">Bulan Pencarian</label>
                                        <div class="input-group">
                                            <select name="pencarian_bulan" id="pencarianBulan"
                                                class="form-control border">
                                                <option>-Pilih Bulan-</option>
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
                                        <label for="harian">Tahun Pencarian</label>
                                        <div class="input-group">
                                            <select name="pencarian_tahun" id="pencarianTahun"
                                                class="form-control border">
                                                <option>-Pilih Tahun-</option>
                                                @for ($i = 2023; $i <= date('Y'); $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn mt-2 btn-sm btn-primary">Cetak
                                                Laporan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('front_scripts')
    <script src="{{ asset('admin_laporan/view.js?n=' . time()) }}"></script>
@endpush
