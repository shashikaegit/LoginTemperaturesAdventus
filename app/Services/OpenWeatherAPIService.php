<?php

namespace App\Services;

class OpenWeatherAPIService
{
    /**
     * @param $lat
     * @param $long
     * @return \Psr\Http\Message\StreamInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($lat, $long)
    {
        $http = new \GuzzleHttp\Client();
        $request = $http->get('http://api.openweathermap.org/data/2.5/onecall?lat='.$lat.'&lon='.$long.'&APPID='.config('app.open_weather_key').'&units=metric');
        return $request->getBody();
    }
}
