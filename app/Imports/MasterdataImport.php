<?php

namespace App\Imports;

use App\Models\Masterdata;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class MasterdataImport implements ToModel, WithCalculatedFormulas
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Masterdata([
            'nomor_gangguan' => $row[1],
            'penyulang' => $row[2],
            'gardu_induk' => $row[3],
            'area' => $row[4],
            'rayon' => $row[5],
            'tgl_padam' => $row[6],
            'tgl_nyala' => $row[7],
            //sama
            'j_padam' => $row[8],
            'j_nyala' => $row[9],
            'lama_padam' => $row[10],
            'bbn_sebelum' => $row[11],
            'bbn_setelah' => $row[12],

            'arus_ggn_r' => $row[13],
            'arus_ggn_s' => $row[14],
            'arus_ggn_t' => $row[15],
            'arus_ggn_n' => $row[16],
            'ens' => $row[17],
            'indikator_rele' => $row[19],
            'kel_penyebab' => $row[20],
            'kode_gangguan' => $row[21],
            'p_har' => $row[22],
            'titik_pdm' => $row[23],
            'jenis' => $row[24],
            'kategori' => $row[25],
            'keypoint' => $row[26],
            //sama
            'js_padam' => $row[27],
            'js_nyala' => $row[28],
            'lama_padam_sw' => $row[29],
            'bbn_sw_sebelum' => $row[30],
            'bbn_sw_setelah' => $row[31],

            'penyebab_pdm' => $row[32],
            'lokasi_gangguan' => $row[33],
            'trip_tembus' => $row[34],
            'penormalan' => $row[35],
            'kontrol' => $row[36],
            'dispatcher' => $row[37],
            'bulan' => $row[38],
            'hari' => $row[39],
            'pdm_5mnt' => $row[40],
            'menit_pdm' => $row[41],
            'tipe_gangguan' => $row[42],
        ]);
    }
}
