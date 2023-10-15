<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaporanPesananResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $sisaBayar = $this->total_bayar - $this->pembayaran->sum('jumlah_bayar');
        return [

            "terbaru" => "test"
        ];
    }
}
