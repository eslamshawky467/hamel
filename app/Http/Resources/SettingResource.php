<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{

    public function toArray($request)
    {
        if (isset($request->lang) && $request->lang == 'en') {
            return [
                'title' => $this->title_en,
                'description' => $this->description_en,
                'type'=> $this->type,
            ];
        } else {
            return [
                'title' => $this->title_ar,
                'description' => $this->description_ar,
                'type'=> $this->type,
            ];
        }
    }
}
