<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" target="_blank">
            <span class="ms-1 font-weight-bold text-white">Dashboard</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('/') ? 'bg-gradient-primary' : '' }}" href="/">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <hr>
            <li class="nav-item">
                <p class="nav-link text-sm">Employee Module</p>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('sales*') ? 'bg-gradient-primary' : '' }}"
                    href="{{ route('penjualan_index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Penjualan</span>
                </a>
            </li>
            <hr>
            @if (Auth::user()->roles == 2)
                <li class="nav-item">
                    <p class="nav-link text-sm">Admin Module</p>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->is('admin/barang*') ? 'bg-gradient-primary' : '' }}"
                        href="{{ route('barang.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text ms-1">Data Barang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->is('admin/stok*') ? 'bg-gradient-primary' : '' }}"
                        href="{{ route('stok.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Stok</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->is('admin/transaksi*') ? 'bg-gradient-primary' : '' }} "
                        href="{{ route('transaksi.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">view_in_ar</i>
                        </div>
                        <span class="nav-link-text ms-1">Transaksi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->is('admin/laporan*') ? 'bg-gradient-primary' : '' }} "
                        href="{{ route('admin_laporan_index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">view_in_ar</i>
                        </div>
                        <span class="nav-link-text ms-1">Laporan Pejualan</span>
                    </a>
                </li>
            @else
            @endif


        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
            <a class="btn bg-gradient-primary mt-4 w-100" href="#" type="button">&copy; 2023, All right
                reserved</a>
        </div>
    </div>
</aside>
