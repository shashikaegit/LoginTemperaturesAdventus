<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Http;
use App\Services\TemperatureService;

class AppController extends Controller
{
    /**
     * @return array
     */
    public function checkUserLoggedIn()
    {
        $result = array('redirect'=> '', 'status' => false);
        if (Auth::user()) {
            $result = array('redirect'=> RouteServiceProvider::HOME, 'status' => true);
        }
        return response()->json($result);
    }

    public function userTemperature()
    {
        // get user temperature
        $temperature = new TemperatureService();
        return response()->json($temperature->userTemperature());
    }
}
