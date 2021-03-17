<?php

namespace Tests\Feature\City;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class ListCityTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $prefectureCode = '34'; // 34: 広島県
        $response = $this->json('get', '/api/cities/34');

        $response->assertStatusCode(200);

        $this->assertTrue(isset($response['cities']));
        $cities = $response['cities'];
        $this->assertNotCount(0, $cities);
        collect($cities)->each(function (array $city) use($prefectureCode): void {
            $this->assertTrue(Str::startsWith($city['city_code'], $prefectureCode));
        });
    }
}
