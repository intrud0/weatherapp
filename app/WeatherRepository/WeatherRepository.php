<?php

namespace App\WeatherRepository;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

Class WeatherRepository
{

  public function getCurrentWeather($latitude, $longitude){
    
    try{
      // get current weather based on coordinates
      $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
        'lon' => $longitude,
        'lat' => $latitude,
        'appid' => env('OPEN_WEATHER_APP_ID'),
        'units' => 'metric']
      );
      log::channel('custom')->info($response);  
    } catch (\Exception $e) {
      return $e->getMessage();
      log::channel('custom')->error($e->getMessage());
    }

    return $response->body();
    
  }
}