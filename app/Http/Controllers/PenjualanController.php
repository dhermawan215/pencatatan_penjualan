<?php

namespace App\Http\Controllers;

use App\Models\Barang;
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
        $requestall['no_transaksi'] = "TR-" . $dString . "-" .  $stringRandom . "-" . $second;

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
        $transaksi = Transaksi::where('no_transaksi', $id)->first();
        $barang = Barang::all();
        return view('pages.penjualan.detail_buat_transaksi', [
            'transaksi' => $transaksi,
            'barang' => $barang
        ]);
    }

    public function lihatTransaksi()
    {
        return view('pages.penjualan.lihat_transaksi');
    }

    public function transaksiAll(Request $request)
    {
        $requestall = $request->all();

        // dd($requestall);

        $columnsdb = [
            'id',
            'id',
            'no_transaksi',
            'tanggal',
            'pembeli',
            'total'
        ];

        //datatable request
        $draw = $requestall['draw'];
        $offset = $requestall['start'] ? $requestall['start'] : 0;
        $limit = $requestall['length'] ? $requestall['length'] : 5;
        $search = $requestall['search']['value'];
        $direction =  $requestall['order'][0]['dir'];
        $orderBy = $columnsdb[$requestall['order'][0]['column']];

        $searchNoTrsc = $requestall['columns'][2]['search']['value'];
        $searchQty = $requestall['columns'][3]['search']['value'];
        $searchTgl = $requestall['columns'][4]['search']['value'];
        $searchBulan = $request['bulan'];

        $query = Transaksi::select('*');

        if ($search) {
            $query->where('pembeli', 'like', '%' . $search . '%')
                ->orWhere('no_transaksi', 'like', '%' . $search . '%')
                ->orwhere('total', 'like', '%' . $search . '%');
        }

        if ($searchBulan) {
        }


        $recordsFiltered = $query->count();
        $res_data = $query
            ->skip($offset)
            ->take($limit)
            ->orderBy($orderBy, $direction)
            ->get();
        $recordsTotal = $res_data->count();

        $data = [];
        $i = $offset + 1;

        if ($res_data->isEmpty()) {
            $data['cbox'] = '';
            $data['rnum'] = '';
            $data['trno'] = "Data Kosong";
            $data['tgl'] = "Data Kosong";
            $data['pembeli'] = "Data Kosong";
            $data['total'] = "Data Kosong";

            $arr[] = $data;
        } else {
            foreach ($res_data as $key => $value) {
                $data['cbox'] = '<div class="d-flex"><a href="' . route('detail_transaksi', base64_encode($value->no_transaksi)) . '" class="text-primary me-2 ms-2" title="Lihat Data"><i class="fas fa-eye"></i></a ></div>';
                $data['rnum'] = $i;
                $data['trno'] = $value->no_transaksi;
                $data['tgl'] = $value->tanggal;
                $data['pembeli'] = $value->pembeli;
                $data['total'] = $value->total ? number_format($value->total) : number_format(0);


                $arr[] = $data;
                $i++;
            }
        }
        return \response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr,
            'all' => $requestall
        ]);
    }

    public function detailTransaksi($id)
    {
        return base64_decode($id);
    }

    public function transaksiItem(Request $request)
    {
    }
}
