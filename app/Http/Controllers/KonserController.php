<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use Illuminate\Http\Request;

class KonserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Konser::all();

        return response()->json([
            "message" => "Load Data Succes",
            "data" => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Konser();
        $data->nama_konser = $request->nama_konser;
        $data->tanggal_konser = $request->tanggal_konser;
        $data->jenis_konser = $request->jenis_konser;
        $data->harga_tiket = $request->harga_tiket;
        $data->stok_tiket = $request->stok_tiket;
        $data->save();

        return response()->json([
            "message" => "Store Succes",
            "data" => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Konser::find($id);
        if ($data){
            return $data;
        }else{
            return ["message" => "Data Not Found"];
        }
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
        $data = Konser::find($id);
        if ($data){
            $data->nama_konser = $request->nama_konser ? $request->nama_konser : $data->nama_konser;
            $data->tanggal_konser = $request->tanggal_konser ? $request->tanggal_konser : $data->tanggal_konser;
            $data->jenis_konser = $request->jenis_konser ? $request->jenis_konser: $data->jenis_konser;
            $data->harga_tiket = $request->harga_tiket ? $request->harga_tiket : $data->harga_tiket;
            $data->stok_tiket = $request->stok_tiket ? $request->stok_tiket : $data->stok_tiket;
            $data->save();

            return $data;
        }else{
            return ["message" => "Data Not Found"];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Konser::find($id);
        if ($data){
            $data->delete();
            return ["message" => "Dellete Succes"];
        }else{
            return ["message" => "Data Not Found"];
        }
    }
}
