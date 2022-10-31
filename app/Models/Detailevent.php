<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailevent extends Model
{
    use HasFactory;

    protected $table = "detailevents";

    protected $fillable = [
        'no_lapor', 'kode', 'jenis', 'ulp', 'penyulang', 'tgl_padam', 'jam_padam', 'tgl_nyala', 'jam_nyala', 'pelanggan_padam', 'durasi_padam', 'jam_pelanggan_padam', 'ens', 'SAIDI', 'SAIFI', 'plg_ulp', 'saidi_ulp', 'saifi_ulp'
    ];
}
