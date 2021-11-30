<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Api\Weather;

class WeatherController extends Controller
{
    //
    public function getWeather(Request $request){
        $validated = $request->validate([
            'latitude' => 'required',
            'longitude' => 'required'
        ]);
        $response = new Weather($request->latitude, $request->longitude);
        return response($response->getCurrentWeather());
    }
}
