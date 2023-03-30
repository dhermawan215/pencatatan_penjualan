<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\TransaksiDetail;

class AdminTransaksi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/admin_transaksi/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ids = \base64_decode($id);

        $transaksiData = Transaksi::where('no_transaksi', $ids)->first();

        $transaksiDetail = TransaksiDetail::with('TransaksiBarang')->where('transaksi_id', $transaksiData->id)->get();
        return \view('pages.admin_transaksi.detail', [
            'trdata' => $transaksiData,
            'trdetail' => $transaksiDetail
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function transactionData(Request $request)
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
                $data['cbox'] = '<div class="d-flex"><a href="' . route('transaksi.show', base64_encode($value->no_transaksi)) . '" class="text-primary me-2 ms-2" title="Lihat Data"><i class="fas fa-eye"></i></a ></div>';
                $data['rnum'] = $i;
                $data['trno'] = $value->no_transaksi;
                $data['tgl'] = $value->tanggal;
                $data['pembeli'] = $value->pembeli;
                $data['total'] = $value->total ? "Rp. " . number_format($value->total, 0, ',', '.') : "Rp. " . number_format(0);


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
}
