<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Carbon\Carbon;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
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
            return \response()->json("error", 500);
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
        $searchTotal = $requestall['columns'][5]['search']['value'];
        $searchPembeli = $requestall['columns'][4]['search']['value'];
        $searchTgl = $requestall['columns'][3]['search']['value'];

        $query = Transaksi::select('*');

        if ($search) {
            $query->where('pembeli', 'like', '%' . $search . '%')
                ->orWhere('no_transaksi', 'like', '%' . $search . '%')
                ->orwhere('total', 'like', '%' . $search . '%');
        }

        if ($searchNoTrsc) {
            $query->where('no_transaksi', $searchNoTrsc);
        }

        if ($searchTgl) {
            $query->whereDate('tanggal', $searchTgl);
        }

        if ($searchPembeli) {
            $query->where('pembeli', $searchPembeli);
        }

        if ($searchTotal) {
            $query->where('total', $searchTotal);
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
        ]);
    }

    public function detailTransaksi($id)
    {
        return base64_decode($id);
    }

    public function transaksiItem(Request $request)
    {
        $requestall = $request->all();

        // \dd($requestall);

        $columnsdb = [
            'id',
            'barang_id',
            'harga_satuan',
            'qty',
            'sub_total'
        ];

        $trId = $requestall['trId'];
        $draw = $requestall['draw'];
        $offset = $requestall['start'] ? $requestall['start'] : 0;
        $limit = $requestall['length'] ? $requestall['length'] : 5;
        $search = $requestall['search']['value'];
        $direction =  $requestall['order'][0]['dir'];
        $orderBy = $columnsdb[$requestall['order'][0]['column']];

        $query = TransaksiDetail::with('TransaksiBarang')->select('*');
        $query->where('transaksi_id', $trId);

        $recordsFiltered = $query->count();
        $res_data = $query
            ->skip($offset)
            ->take($limit)
            ->orderBy($orderBy, $direction)
            ->get();
        $recordsTotal = $res_data->count();

        $dataSum = $query->sum('sub_total');

        $data = [];
        $i = $offset + 1;

        if ($res_data->isEmpty()) {
            $data['cbox'] = '';
            $data['barang'] = "Data Kosong";
            $data['harga'] = "Data Kosong";
            $data['qty'] = "Data Kosong";
            $data['subtotal'] = "Data Kosong";

            $arr[] = $data;
        } else {
            foreach ($res_data as $key => $value) {
                $data['cbox'] = '<div class="d-flex"><button type="button" class="btndel btn btn-sm btn-danger" id="btndeletes" data-id="' . $value->id . '">Delete</button><p class="ms-1 fw-bold">' . $i . '</p></div>';
                $data['barang'] = $value->TransaksiBarang->nama_barang;
                $data['harga'] = $value->harga_satuan ? "Rp." . \number_format($value->harga_satuan, 0, ',', '.') : "Rp." . \number_format(0);
                $data['qty'] = $value->qty;
                $data['subtotal'] = $value->sub_total ? "Rp." . number_format($value->sub_total, 0, ',', '.') : "Rp." . number_format(0);

                $arr[] = $data;
                $i++;
            }
        }
        return \response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr,
            'sum' => $dataSum
        ]);
    }

    public function barang(Request $request)
    {
        $requestall = $request->all();

        $id = $requestall['idvalue'];

        $barang = Barang::findOrFail($id);

        return \response()->json($barang, 200);
    }

    public function simpanTrDetail(Request $request)
    {
        $requestall = $request->all();

        $validator = Validator::make($request->all(), [
            'transaksi_id' => 'required',
            'barang_id' => 'required',
            'harga_satuan' => 'required|numeric',
            'qty' => 'required|numeric',
            'sub_total' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors()->all(), 403);
        }

        unset($requestall['_token']);

        $trDetail = TransaksiDetail::create($requestall);

        if ($trDetail->exists) {
            return response()->json("success", 200);
        } else {
            return \response()->json("error", 500);
        }
    }

    public function deleteItemTr($id)
    {
        $ItemTr = TransaksiDetail::findOrFail($id);
        $deleted = $ItemTr->delete();

        if ($deleted) {
            return response()->json("succes", 200);
        } else {
            return response()->json("error", 500);
        }
    }

    public function submitTotal(Request $request)
    {
        $requestall = $request->all();

        $idTr = $requestall['transaksi_id'];

        $validator = Validator::make($request->all(), [
            'total' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors()->all(), 403);
        }

        unset($requestall['_token']);
        // dd($requestall);

        $transaksiTotal = Transaksi::findOrFail($idTr);

        $updated = $transaksiTotal->update($requestall);

        if ($updated) {
            return \response()->json(\base64_encode($transaksiTotal->no_transaksi), 200);
        } else {
            return \response()->json("gagal", 500);
        }
    }

    public function success($id)
    {
        $ids = \base64_decode($id);

        $transaksiData = Transaksi::where('no_transaksi', $ids)->first();

        $transaksiDetail = TransaksiDetail::with('TransaksiBarang')->where('transaksi_id', $transaksiData->id)->get();
        return \view('pages.penjualan.success', [
            'trdata' => $transaksiData,
            'trdetail' => $transaksiDetail
        ]);
    }
}
