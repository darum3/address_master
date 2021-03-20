<?php

namespace App\Http\Resources;

use App\Models\Town;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TownInfoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $ret = $this->map(function (Town $x): array {
            return [
                'area_code' => $x->town_code,
                'prefecture_code' => $x->city->prefecture->code,
                'prefecture_name' => $x->city->prefecture->prefecture_name,
                'prefecture_kana' => $x->city->prefecture->prefecture_kana,
                'city_code' => $x->city->city_code,
                'city_name' => $x->city->city_name,
                'city_kana' => $x->city->city_kana,
                'town_name' => $x->town_name,
            ];
        });
        return $ret->toArray();
    }
}
