<?php

namespace Tests\Feature\Town;

use App\Models\Town;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetTownInfoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $townCodes = [
            '342020097001', // 広島県呉市中央一丁目
            '342020097002',
            '342020097003',
        ];
        $query = collect($townCodes)->map(fn (String $x): string => "townCode[]={$x}")
            ->join('&');
        $response = $this->json('get', "/api/town?{$query}");

        $response->assertStatusCode(200);
        // $response->dump();

        $expected = Town::with(['city', 'city.prefecture'])
            ->whereIn('town_code', $townCodes)
            ->get()
            ->map(function (Town $x): array {
                return [
                    "area_code" => $x->town_code,
                    "prefecture_code" => $x->city->prefecture->code,
                    "prefecture_name" => $x->city->prefecture->prefecture_name,
                    "prefecture_kana" => $x->city->prefecture->prefecture_kana,
                    "city_code" => $x->city->city_code,
                    "city_name" => $x->city->city_name,
                    "city_kana" => $x->city->city_kana,
                    "town_name" => $x->town_name,
                ];
            })->toArray();

            $response->assertJsonStrict('data', $expected);
    }
}
