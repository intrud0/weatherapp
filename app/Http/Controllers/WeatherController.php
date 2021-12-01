<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Api\Weather;
use App\Http\Requests\WeatherPostRequest;

class WeatherController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function getWeather(WeatherPostRequest $request)
    {

        $validated = $request->validated();
        $response = new Weather($request->latitude, $request->longitude);
        return response($response->getCurrentWeather());
    
    }
}
