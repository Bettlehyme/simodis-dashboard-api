<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masterdata extends Model
{
    use HasFactory;
    protected $table = "masterdata";

    protected $fillable = [
        'nomor_gangguan',
        'penyulang',
        'gardu_induk',
        'area',
        'rayon',
        'tgl_padam',
        'tgl_nyala',
        //sama
        'j_padam',
        'j_nyala',
        'lama_padam',
        'bbn_sebelum',
        'bbn_setelah',

        'arus_ggn_r',
        'arus_ggn_s',
        'arus_ggn_t',
        'arus_ggn_n',
        'ens',
        'indikator_rele',
        'kel_penyebab',
        'kode_gangguan',
        'p_har',
        'titik_pdm',
        'jenis',
        'kategori',
        'keypoint',
        //sama
        'js_padam',
        'js_nyala',
        'lama_padam_sw',
        'bbn_sw_sebelum',
        'bbn_sw_setelah',

        'penyebab_pdm',
        'lokasi_gangguan',
        'trip_tembus',
        'penormalan',
        'kontrol',
        'dispatcher',
        'bulan',
        'hari',
        'pdm_5mnt',
        'menit_pdm',
        'tipe_gangguan'
    ];
}
