<?php

namespace Tests\Feature\Prefecture;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListPrefectureTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/api/prefectures');

        $response->assertStatus(200);

        $this->assertTrue(isset($response['prefectures']));
        $prefectures = $response['prefectures'];
        $this->assertCount(47, $prefectures);
    }
}
