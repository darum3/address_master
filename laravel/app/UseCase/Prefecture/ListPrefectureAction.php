<?php
namespace App\UseCase\Prefecture;

use App\Models\Prefecture;
use Illuminate\Database\Eloquent\Collection;

class ListPrefectureAction
{
    /**
     * @return Collection|Prefecture
     */
    public function __invoke(): Collection
    {
        return Prefecture::get();
    }
}
