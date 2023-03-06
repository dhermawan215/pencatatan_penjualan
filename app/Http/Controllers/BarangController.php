<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.barang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'kode_barang' => 'required|string|max:255|unique:barang',
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'didaftarkan_oleh' => 'required'
        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors()->all(), 403);
        }
        unset($data_request['_token']);

        $barang = Barang::create($data_request);

        if ($barang->exists) {
            return \response()->json($barang->exists, 200);
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
        return base64_decode($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return base64_decode($id);
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

    public function getDataBarang()
    {
        // \dd(\request()->all());
        $columns = [
            'id',
            'id',
            'kode_barang',
            'nama_barang',
            'harga'
        ];

        $offset = \request()->input("start") ? \request()->input("start") : 0;
        $limit = \request()->input("length") ? \request()->input("length") : 5;
        $global_search = \request()->input("search.value");
        $kode_barang_search = \request()->input("columns.2.search.value");
        $nama_barang_search = \request()->input("columns.3.search.value");
        $harga_barang_search = \request()->input("columns.4.search.value");
        $orderBy = $columns[\request()->input("order.0.column")];


        $queryBarang = Barang::select('*');
        // \dd($queryBarang);
        //global search

        if ($kode_barang_search) {
            $queryBarang->where('kode_barang', $kode_barang_search);
        }

        if ($nama_barang_search) {
            $queryBarang->where('nama_barang', 'like', '%' . $nama_barang_search . '%');
            // $queryBarang = Barang::Where('nama_barang', $nama_barang_search)->get();
            // \dd($queryBarang);
        }
        if ($harga_barang_search) {
            $queryBarang->where('harga', $harga_barang_search);
        }

        // $queryBarang = DB::table('barang')->where($where);
        // \dd($nama_barang_search);
        // $queryBarang->where($where);

        if ($global_search) {
            // $queryBarang->whereRaw("(lokasi LIKE '%{$global_search}%' OR name LIKE '%{$$global_search}%')");
            $queryBarang->where(function ($query) {
                $query->whereRaw('LOWER(kode_barang) like ?', ['%' . \strtolower(\request()->input("search.value")) . '%'])
                    ->orWhereRaw('LOWER(nama_barang) like ?', ['%' . \strtolower(\request()->input("search.value")) . '%']);
            });
        }

        $recordsFiltered = $queryBarang->count();
        $res_data = $queryBarang
            ->skip($offset)
            ->take($limit)
            ->orderBy($orderBy, \request()->input("order.0.dir"))
            ->get();
        $recordsTotal = $res_data->count();

        $data = [];
        $i = $offset + 1;

        if ($res_data->isEmpty()) {
            $data['cbox'] = '';
            $data['rnum'] = '';
            $data['kode_barang'] = "Data Kosong";
            $data['nama_barang'] = "Data Kosong";
            $data['harga'] = "Data Kosong";

            $arr[] = $data;
        } else {
            foreach ($res_data as $key => $value) {
                $data['cbox'] = '<div class="d-flex"><input type="checkbox" class="data-barang-cbox ms-2" value="' . $value->id . '"><a href="' . route('barang.edit', base64_encode($value->id)) . '" class="text-primary ms-2" title="Edit Data"><i class="fas fa-edit"></i></a ><a href="' . route('barang.show', base64_encode($value->id)) . '" class="text-success ms-1" title="Detail Data"><i class="fa fa-info-circle" aria-hidden="true"></i></a></div>';
                $data['rnum'] = $i;
                // $data['aksi'] = 'p';
                $data['kode_barang'] = $value->kode_barang;
                $data['nama_barang'] = $value->nama_barang;
                $data['harga'] = $value->harga;


                $arr[] = $data;
                $i++;
            }
        }
        return \response()->json([
            'draw' => \request()->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr,
            'filter' => $harga_barang_search,
            'request' => \request()->all(),
        ]);
    }
}
