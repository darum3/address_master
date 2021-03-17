<?php
namespace App\UseCase\Town;

use App\Models\Town;

class UpdateTownAction
{
    public function handle(Town $town): Town
    {
        if ($town->id !== null) {
            $entity = Town::firstOrNew(['id' => $town->id], $town->toArray());
        } else {
            $entity = Town::firstOrNew(['town_code' => $town->town_code], $town->toArray());
        }

        $entity->save();

        return $entity;
    }
}
