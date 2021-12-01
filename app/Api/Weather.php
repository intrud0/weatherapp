<?php

namespace App\Api;

use Illuminate\Support\Facades\Http;

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
      $c1 = $response->failed();
      $c2 = $response->clientError();
      $c3 = $response->serverError();
      if($c2 || $c3 || $c1){
        return $response->throw();
      }

      return $response->body();
    } catch (\Illuminate\Http\Client\ConnectionException $e) {
      return $e->getMessage();
    }
    
  }
}