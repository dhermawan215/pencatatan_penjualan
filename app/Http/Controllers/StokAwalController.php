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
}
