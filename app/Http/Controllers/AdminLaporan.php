<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TransaksiDetail;
use Barryvdh\DomPDF\Facade\Pdf;


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
        return response()->json($arr, 200);
    }

    public function laporanByTrsc(Request $request)
    {
        $all = $request->all();

        $id = $all['no_transaksi'];
        // $transaksi = Transaksi::with(['Transkasis, Transkasis.TransaksiBarang'])->findOrFail($id);

        $transaksi = TransaksiDetail::with('transaksi', 'TransaksiBarang')->where('transaksi_id', $id)->get();

        $pdf = PDF::loadView('pages.admin_laporan.laporan_tr_pdf', ['trsc' => $transaksi])->setOptions(['defaultFont' => 'sans-serif']);
        $path = public_path('pdf/');
        $rndm = Str::random(5);
        $fileName =  time() . '-' . $rndm . '.' . 'pdf';
        $pdf->save($path . '/' . $fileName);

        $pdf2 = public_path('pdf/' . $fileName);
        return response()->download($pdf2)->deleteFileAfterSend(true);
    }
}
