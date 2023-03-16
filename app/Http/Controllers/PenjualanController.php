<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    public function index()
    {
        return view('pages.penjualan.index');
    }

    public function buatTransaksi()
    {
        return view('pages.penjualan.buat_transaksi');
    }

    public function simpan(Request $request)
    {
        $d = Carbon::now();

        $stringRandom = Str::random(7);
        $second = $d->second;

        $requestall = $request->all();
        $dString = $requestall['tanggal'];
        $requestall['no_transaksi'] = "TR-" . $dString . "/" .  $stringRandom . "/" . $second;

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'pembeli' => 'required|string',
            'alamat' => 'required|string',
            'dilayani_oleh' => 'required',
        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors()->all(), 403);
        }

        unset($requestall['_token']);

        $transaksi = Transaksi::create($requestall);

        if ($transaksi->exists) {
            return response()->json($transaksi, 200);
        } else {
            return \response()->json("error", 403);
        }
    }

    public function transaksiDetail($id)
    {
        return $id;
    }
}
