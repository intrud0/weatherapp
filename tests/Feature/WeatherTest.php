<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WeatherTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_weather_api()
    {
        $this->json('POST', '/api/getWeather', [
            'latitude' => 14.390798, 
            'longitude' => 120.973177
            ])
                ->assertJson([
                    'cod' => 200
                ]);
    }
}
