<?php
namespace App\UseCase\AddressHttp;

use App\Models\AddressHttp;
use App\Models\AddressCsv;
use App\UseCase\City\UpdateCityAction;
use App\UseCase\Prefecture\StorePrefectureAction;
use App\UseCase\Town\UpdateTownAction;
use Illuminate\Support\Collection;

class CsvAction
{
    private AddressHttp $http;
    private StorePrefectureAction $storePrefecture; // TODO
    private UpdateCityAction $updateCity;
    private UpdateTownAction $updateTown;

    public function __construct(
        AddressHttp $http,
        StorePrefectureAction $storePrefecture,
        UpdateCityAction $updateCity,
        UpdateTownAction $updateTown
    ) {
        $this->http = $http;
        $this->storePrefecture = $storePrefecture;
        $this->updateCity = $updateCity;
        $this->updateTown = $updateTown;
    }

    public function handle()
    {
        AddressCsv::loadCsvFile($this->http->csv())->each(function ($item, $key) {
            $prefecture = $this->storePrefecture->handle($item->prefecture);

            $item->city->prefecture_id = $prefecture->id;
            $city = $this->updateCity->handle($item->city);

            $item->town->prefecture_id = $prefecture->id;
            $item->town->city_id = $city->id;
            $this->updateTown->handle($item->town);
        });
    }
}
