<?php

namespace Tests\Feature\Town;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class ListTownTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $cityCode = '34202'; //  広島県呉市
        $response = $this->json('get', "/api/towns/{$cityCode}");

        $response->assertStatusCode(200);

        $this->assertTrue(isset($response['towns']));
        $towns = $response['towns'];
        $this->assertNotCount(0, $towns);
        collect($towns)->each(function (array $town) use($cityCode): void {
            $this->assertTrue(Str::startsWith($town['town_code'], $cityCode));
        });
    }
}
