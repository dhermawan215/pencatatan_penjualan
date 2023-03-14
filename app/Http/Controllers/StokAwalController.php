<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokAwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StokAwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.stok.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::all();
        return view('pages.stok.create', [
            'barang' => $barang
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_request = $request->all();

        $validator = Validator::make($request->all(), [
            'barang_id' => 'required',
            'qty_stok' => 'required|numeric',
            'tgl_input' => 'required'
        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors()->all(), 403);
        }

        unset($data_request['_token']);

        $save = StokAwal::create($data_request);

        if ($save->exists) {
            return \response()->json($save->exists, 200);
        } else {
            return \response()->json("error", 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function getDataStok(Request $request)
    {
        $requestall = $request->all();

        $columnsdb = [
            'id',
            'id',
            'barang_id',
            'qty_stok',
            'tgl_input'
        ];
        $draw = $requestall['draw'];
        $offset = $requestall['start'] ? $requestall['start'] : 0;
        $limit = $requestall['length'] ? $requestall['length'] : 5;
        $search = $requestall['search']['value'];
        $orderBy = $columnsdb[$requestall['order'][0]['column']];
        $direction =  $requestall['order'][0]['dir'];


        $searchBarang = $requestall['columns'][2]['search']['value'];
        $searchQty = $requestall['columns'][3]['search']['value'];
        $searchTgl = $requestall['columns'][4]['search']['value'];

        $queryStok = StokAwal::with('StokBarang')->select('*');

        $where = [];

        $recordsFiltered = $queryStok->count();
        $res_data = $queryStok
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
            $data['barang'] = "Data Kosong";
            $data['qty'] = "Data Kosong";
            $data['tgl'] = "Data Kosong";

            $arr[] = $data;
        } else {
            foreach ($res_data as $key => $value) {
                $data['cbox'] = '<div class="d-flex"><button type="button" class="btndel btn btn-sm btn-danger" id="btndeletes" data-id="' . $value->id . '">Delete</button><a href="' . route('stok.edit', base64_encode($value->id)) . '" class="text-primary me-2 ms-2" title="Edit Data"><i class="fas fa-edit"></i></a ></div>';
                $data['rnum'] = $i;
                // $data['aksi'] = 'p';
                $data['barang'] = $value->StokBarang->nama_barang;
                $data['qty'] = $value->qty_stok;
                $data['tgl'] = $value->tgl_input;


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
