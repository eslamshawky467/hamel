<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScotterResource extends JsonResource
{
    public function toArray($request)
    {
            return [
                'id'=>$this->id,
                'location' => $this->location,
                'lang' => $this->lang,
                'lat' => $this->lat,
                'qrcode' => $this->qrcode
            ];
        }

}
