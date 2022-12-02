<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Verifikasi;
use App\Models\Transaksi;

class VerifikasiController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cekKonfirmasiBayar = Transaksi::find($request->id_transaksi);
        if (!$cekKonfirmasiBayar->konfirmasi_bayar) {
            return ["message" => "Pembayaran Belum Terkonfirmasi"];
        }
        
        $data = new Verifikasi();
        $data->id_user = $request->user()->id;
        $data->id_transaksi = $request->id_transaksi;
        $data->created_at = date('Y-m-d H:i:s');
        $data->kode_verifikasi = rand(1000,9999);
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
        $data = Verifikasi::find($id);
        $transaksi = Transaksi::find($data->id);
        $cekUser = $data->id_user === $transaksi->id_user;  

        if ($cekUser){
            return $data;
        }else{
            return ["message" => "Anda tidak berhak atas verifikasi ini!"];
        }
    }
}
