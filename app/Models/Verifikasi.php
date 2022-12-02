<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verifikasi extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['id_transaksi', 'id_user', 'kode_verifikasi', 'created_at'];
}
