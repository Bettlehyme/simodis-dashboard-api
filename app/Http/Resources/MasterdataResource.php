<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MasterdataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
        'nomor_gangguan' => $this->nomor_gangguan,
        'penyulang' => $this->penyulang,
        'gardu_induk' => $this->gardu_induk,
        'area' => $this->area,
        'rayon' => $this->rayon,
        'tgl_padam' => $this->tgl_padam,
        'tgl_nyala' => $this->tgl_nyala,
        //sama
        'j_padam' => $this->j_padam,
        'j_nyala' => $this->j_nyala,
        'lama_padam' => $this->lama_padam,
        'bbn_sebelum' => $this->bbn_sebelum,
        'bbn_setelah' => $this->bbn_setelah,

        'arus_ggn_r' => $this->arus_ggn_r,
        'arus_ggn_s' => $this->arus_ggn_s,
        'arus_ggn_t' => $this->arus_ggn_t,
        'arus_ggn_n' => $this->arus_ggn_n,
        'ens' => $this->ens,
        'indikator_rele' => $this->indikator_rele,
        'kel_penyebab' => $this->kel_penyebab,
        'kode_gangguan' => $this->kode_gangguan,
        'p_har' => $this->p_har,
        'titik_pdm' => $this->titik_pdm,
        'jenis' => $this->jenis,
        'kategori' => $this->kategori,
        'keypoint' => $this->keypoint,
        //sama
        'js_padam' => $this->js_padam,
        'js_nyala' => $this->js_nyala,
        'lama_padam_sw' => $this->lama_padam_sw,
        'bbn_sw_sebelum' => $this->bbn_sw_sebelum,
        'bbn_sw_setelah' => $this->bbn_sw_setelah,

        'penyebab_pdm' => $this->penyebab_pdm,
        'lokasi_gangguan' => $this->lokasi_gangguan,
        'trip_tembus' => $this->trip_tembus,
        'penormalan' => $this->penormalan,
        'kontrol' => $this->kontrol,
        'dispatcher' => $this->dispatcher,
        'bulan' => $this->bulan,
        'hari' => $this->hari,
        'pdm_5mnt' => $this->pdm_5mnt,
        'menit_pdm' => $this->menit_pdm,
        'tipe_gangguan' => $this->tipe_gangguan,
        ];
    }
}
