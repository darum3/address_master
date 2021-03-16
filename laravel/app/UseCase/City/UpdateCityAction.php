<?php
namespace App\UseCase\City;

use App\Models\City;

class UpdateCityAction
{
    public function handle(City $city): City
    {
        if ($city->id !== null) {
            $entity = City::firtsOrNew(['id' => $city->id], $city->toArray());
        } else {
            $entity = City::firstOrNew(['city_code' => $city->city_code], $city->toArray());
        }

        $entity->save();

        return $entity;
    }
}
