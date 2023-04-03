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

        $query = Transaksi::where('no_transaksi', 'like', '%' . $search . '%')->paginate(10);


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
