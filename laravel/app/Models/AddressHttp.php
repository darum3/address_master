<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;

class AddressHttp
{
    private const addressCsvUrl = 'https://raw.githubusercontent.com/geolonia/japanese-addresses/master/data/latest.csv';

    public function csv(): string
    {
        $response = Http::get(self::addressCsvUrl);

        $tmpfileName = tempnam(sys_get_temp_dir(), 'adr');
        file_put_contents($tmpfileName, $response->body());

        return $tmpfileName;
    }
}
