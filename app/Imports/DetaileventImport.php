<?php

namespace App\Imports;

use App\Http\Controllers\DetaileventController;
use App\Http\Controllers\UlpController;
use App\Models\Detailevent;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
//use DateTime;


class DetaileventImport implements ToModel, WithCalculatedFormulas
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $datas = DB::table('ulp')->get('jumlah_ulp');
        // dd($datas);
        if (empty($datas[0])) {
            // echo "error! DB Ulp is null";            
            // die;
        } else {
            $ulp_up3 = 'up3 pekanbaru';
            if (DB::table('ulp')->where(strtolower('nama_ulp'), $ulp_up3)->exists() == true) {
                $query = DB::table('ulp')->where(strtolower('nama_ulp'), $ulp_up3)->first();
                $total_plg = $query->jumlah_ulp;
                // dd($total_plg);
                $saidi = $row[12] / $total_plg * 60;
                $saifi = $row[10] / $total_plg;
            } else {
                $total_plg = DB::table('ulp')->sum('jumlah_ulp'); //kalau jumlah plg up3 tidak masuk atau null
                $saidi = $row[12] / $total_plg * 60;
                $saifi = $row[10] / $total_plg;
            }

            $ulp = DB::table('ulp')->where('nama_ulp', $row[4])->get();
            if (isset(json_decode($ulp)[0])) {
                $data_ulp = json_decode($ulp)[0];
                $plg_ulp = $data_ulp->jumlah_ulp;

                $saidi_ulp = $saidi * $total_plg / $plg_ulp;
                $saifi_ulp = $saifi * $total_plg / $plg_ulp;
            } else {
                $plg_ulp = 0;
                $saidi_ulp = 0;
                $saifi_ulp = 0;
            }

            return new Detailevent([
                'no_lapor' => $row[1],
                'kode' => $row[2],
                'jenis' => $row[3],
                'ulp' => $row[4],
                'penyulang' => $row[5],
                'tgl_padam' => date('Y-m-d', strtotime('1899-12-31+' . ($row[6] - 1) . ' days')),
                'jam_padam' => gmdate('H:i:s', ($row[7] - 25569) * 86400),
                'tgl_nyala' => date('Y-m-d', strtotime('1899-12-31+' . ($row[8] - 1) . ' days')),
                'jam_nyala' => gmdate('H:i:s', ($row[9] - 25569) * 86400),
                'pelanggan_padam' => $row[10],
                'durasi_padam' => $row[11],
                'jam_pelanggan_padam' => $row[12],
                'ens' => $row[13],
                'SAIDI' => round($saidi, 2),
                'SAIFI' => round($saifi, 3),
                'plg_ulp' => $plg_ulp,
                'saidi_ulp' => round($saidi_ulp, 2),
                'saifi_ulp' => round($saifi_ulp, 3)
            ]);
        }
    }
}
