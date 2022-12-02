<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konser;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transaksi::all();

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
        $data = new Transaksi();
        $data->id_user = $request->user()->id;
        $data->id_konser = $request->id_konser;
        $data->tanggal_transaksi = date('Y-m-d H:i:s');
        $data->jumlah_tiket = $request->jumlah_tiket;
        $data->total_bayar = null;
        $data->konfirmasi_bayar = false;
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
        $data = Transaksi::find($id);
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


    public function bayar(Request $request, $id)
    {
        $data = Transaksi::find($id);
        $konser = Konser::find($request->id_konser);

        if ($data && $konser) {
            $konser->stok_tiket -= $data->jumlah_tiket;
            $konser->save();
            
            $data->total_bayar =  $konser->harga_tiket * $data->jumlah_tiket;
            $data->save();

            return $data;
        }else{
            return ["message" => "Data Not Found"];
        }
    }

    public function konfirmasiBayar(Request $request, $id)
    {
        $data = Transaksi::find($id);

        if($data) {
            $data->konfirmasi_bayar = true;
            $data->save();

            return $data;
        }else {
            return ["message" => "Data Not Found"];
        }
    }
}