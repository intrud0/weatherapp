<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Api\Weather;
use App\Http\Requests\WeatherPostRequest;
use App\WeatherRepository\WeatherRepository;

class WeatherController extends Controller
{
    public function __construct(WeatherRepository $weatherRepository)
    {
        $this->weatherRepository = $weatherRepository;
    }

    public function index()
    {
        return view('home');
    }

    public function getWeather(WeatherPostRequest $request)
    {

        $validated = $request->validated();
        $response = $this->weatherRepository->getCurrentWeather($request->latitude, $request->longitude);
        return response($response);
    
    }
}
