<?php

namespace App\Services;

use App\Services\OpenWeatherAPIService;
use Illuminate\Support\Facades\Auth;
use App\UserTemperature;
use Carbon\Carbon;

class TemperatureService
{
    /**
     * @return void
     */
    public function save()
    {
        $user = Auth::user();
        $citiesTemp = $this->cityTemp();

        // Store temperature to table
        if ($citiesTemp['cityone']['celsius'] != 0 && $citiesTemp['cityone']['fahrenheit'] != 0){
            UserTemperature::create([
                'user_id' => $user->id,
                'city' => $citiesTemp['cityone']['name'],
                'celsius' => $citiesTemp['cityone']['celsius'],
                'fahrenheit' => $citiesTemp['cityone']['fahrenheit'],
            ]);
        }

        if ($citiesTemp['citytwo']['celsius'] != 0 && $citiesTemp['citytwo']['fahrenheit'] != 0){
            UserTemperature::create([
                'user_id' => $user->id,
                'city' => $citiesTemp['citytwo']['name'],
                'celsius' => $citiesTemp['citytwo']['celsius'],
                'fahrenheit' => $citiesTemp['citytwo']['fahrenheit'],
            ]);
        }
    }

    /**
     * @return array|\int[][]
     */
    public function cityTemp()
    {
        $temperature = new OpenWeatherAPIService();

        //Define result array
        $result = array('cityone'=> array('celsius'=>0, 'fahrenheit'=>0, 'name'=>config('app.cityone')['name']), 'citytwo'=> array('celsius'=>0, 'fahrenheit'=>0, 'name'=>config('app.citytwo')['name']));

        $cityOne = json_decode($temperature->send(config('app.cityone')['lat'], config('app.cityone')['long']), true);
        $cityTwo = json_decode($temperature->send(config('app.citytwo')['lat'], config('app.citytwo')['long']), true);

        if (!empty($cityOne)){
            $result['cityone']['celsius'] = (int)$cityOne['current']['temp'];
            $result['cityone']['fahrenheit'] = (int)$this->celsiusToFahrenheit($cityOne['current']['temp']); // convert celsius to fahrenheit
        }

        if (!empty($cityTwo)){
            $result['citytwo']['celsius'] = (int)$cityTwo['current']['temp'];
            $result['citytwo']['fahrenheit'] = (int)$this->celsiusToFahrenheit($cityTwo['current']['temp']); // convert celsius to fahrenheit
        }

        return $result;
    }

    /**
     * @param $value
     * @return float|int
     */
    public function celsiusToFahrenheit($value)
    {
        return $value*9/5+32;
    }

    /**
     * @return mixed
     */
    public function userTemperature()
    {
        $user = Auth::user();
        $list = UserTemperature::where('user_id', $user->id)->orderBy('id','DESC')->get();

        $result = [];
        $a = 0;
        foreach ($list as $key => $value){
            $result[$value->city][$a]['created_at'] = Carbon::parse($value->created_at)->format('M d Y, H:i:s');
            $result[$value->city][$a]['id'] = $value->id;
            $result[$value->city][$a]['celsius'] = $value->celsius;
            $result[$value->city][$a]['fahrenheit'] = $value->fahrenheit;

            $a++;
        }

        return $result;
    }
}
