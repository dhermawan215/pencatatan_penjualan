<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class AdminLaporan extends Controller
{
    public function index()
    {
        return \view('pages.admin_laporan.index');
    }

    public function dataTransaksi(Request $request)
    {
        $requestall = $request->all();
        $search = $request->search;
        if ($search != \null) {
            $query = Transaksi::select('id', 'no_transaksi')->where('no_transaksi', 'like', '%' . $search . '%')->get();
        } else {
            $query = Transaksi::orderBy('no_transaksi', 'asc')->select('id', 'no_transaksi')->paginate(10);
        }

        $data = [];
        foreach ($query as $key => $value) {
            $data['id'] = $value->id;
            $data['no_transaksi'] = $value->no_transaksi;
            $arr[] = $data;
        }

        // \dd($query);
        return response()->json($arr, 200);
    }
}
