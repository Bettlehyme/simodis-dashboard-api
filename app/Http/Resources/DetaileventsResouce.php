<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DetaileventsResouce extends JsonResource
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
            'no_lapor' => $this->no_lapor,
            'kode' => $this->kode,
            'jenis' => $this->jenis,
            'ulp' => $this->ulp,
            'penyulang' => $this->penyulang,
            'tgl_padam' => $this->tgl_padam,
            'jam_padam' => $this->jam_padam,
            'tgl_nyala' => $this->tgl_nyala,
            'jam_nyala' => $this->jam_nyala,
            'pelanggan_padam' => $this->pelanggan_padam,
            'durasi_padam' => $this->durasi_padam,
            'jam_pelanggan_padam' => $this->jam_pelanggan_padam,
            'ens' => $this->ens,
            'SAIDI' => $this->SAIDI,
            'SAIFI' => $this->SAIFI,
            'plg_ulp' => $this->plg_ulp,
            'saidi_ulp' => $this->saidi_ulp,
            'saifi_ulp' => $this->saifi_ulp,
        ];
    }
}
