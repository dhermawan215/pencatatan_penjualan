<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TransaksiDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AdminLaporan extends Controller
{
    public function index()
    {
        return \view('pages.admin_laporan.index');
    }

    public function download($file)
    {
        $file_path = public_path('pdf/' . $file);
        return response()->download($file_path)->deleteFileAfterSend(true);
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
        $fileName = $transaksi[0]->transaksi->no_transaksi . '_' . time() . '_' . $rndm . '.' . 'pdf';
        $pdf->save($path . '/' . $fileName);

        $pdf2 = public_path('pdf/' . $fileName);
        return response()->json($fileName);
        // return response()->download($pdf2)->deleteFileAfterSend(true);
    }

    public function laporanHarian(Request $request)
    {
        $harian = $request->harian;

        $transaksi = Transaksi::whereDate('tanggal', $harian)->get();
        $data = [];
        if (!$transaksi->isEmpty()) {

            foreach ($transaksi as $key => $value) {
                $data['no_trsc'] = $value->no_transaksi;
                $data['tanggal'] = $value->tanggal;
                $data['total'] = $value->total;
                $data['tgl_header'] = Carbon::createFromFormat('Y-m-d', $value->tanggal)->format('d-m-Y');
                $data['relasi'] = TransaksiDetail::with('TransaksiBarang')->where('transaksi_id', $value->id)->get();
                $arr[] = $data;
            }
            // return \view('pages.admin_laporan.harian', ['data' => $arr]);
            $pdf = PDF::loadView('pages.admin_laporan.harian', ['data' => $arr])->setOptions(['defaultFont' => 'sans-serif']);
            $path = public_path('pdf/');
            $rndm = Str::random(5);
            $fileName = "Harian" . '_' . time() . '_' . $rndm . '.' . 'pdf';
            $pdf->save($path . '/' . $fileName);

            $pdf2 = public_path('pdf/' . $fileName);
            return response()->json($fileName);
            // return response()->download($pdf2, $fileName, $headers)->deleteFileAfterSend(true);
        } else {
            $data['response'] = "data kosong";
            return \response()->json($data, 404);
        }
        // \dd($transaksi);

    }

    public function laporanMingguan(Request $request)
    {
        $awal = $request->awal_minggu;
        $akhir = $request->akhir_minggu;

        $transaksi = Transaksi::whereDate('tanggal', '>=', $awal)
            ->whereDate('tanggal', '<=', $akhir)->get();
        $data = [];
        $week = [];
        $week['awal'] = Carbon::createFromFormat('Y-m-d', $awal)->format('d-m-Y');
        $week['akhir'] = Carbon::createFromFormat('Y-m-d', $akhir)->format('d-m-Y');
        if (!$transaksi->isEmpty()) {

            foreach ($transaksi as $key => $value) {
                $data['no_trsc'] = $value->no_transaksi;
                $data['tanggal'] = $value->tanggal;
                $data['total'] = $value->total;
                $data['tgl_header'] = Carbon::createFromFormat('Y-m-d', $value->tanggal)->format('d-m-Y');
                $data['relasi'] = TransaksiDetail::with('TransaksiBarang')->where('transaksi_id', $value->id)->get();
                $arr[] = $data;
            }
            // return \view('pages.admin_laporan.mingguan', ['data' => $arr, 'week' => $week]);
            $pdf = PDF::loadView('pages.admin_laporan.mingguan', ['data' => $arr, 'week' => $week])->setOptions(['defaultFont' => 'sans-serif']);
            $path = public_path('pdf/');
            $rndm = Str::random(5);
            $fileName = "Mingguan_Rentang_" . $week['awal'] . '_sampai_' . $week['akhir'] . '_' . time() . '_' . $rndm . '.' . 'pdf';
            $pdf->save($path . '/' . $fileName);

            $pdf2 = public_path('pdf/' . $fileName);
            return response()->json($fileName);
        } else {
            $data['response'] = "data kosong";
            return \response()->json($data, 404);
        }
    }
}
