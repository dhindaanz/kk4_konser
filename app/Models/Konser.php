<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konser extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = ['nama_konser', 'tanggal_konser', 'jenis_konser', 'harga_tiket', 'stok_tiket'];
}