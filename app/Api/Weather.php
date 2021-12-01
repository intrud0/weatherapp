<?php

namespace App\Api;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

Class Weather{
  private $latitude;
  private $longitude;
  
  public function __construct($latitude, $longitude)
  {
    $this->latitude = $latitude;
    $this->longitude = $longitude;
  }

  public function getCurrentWeather(){
    
    try{
      // get current weather based on coordinates
      $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
        'lon' => $this->longitude,
        'lat' => $this->latitude,
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