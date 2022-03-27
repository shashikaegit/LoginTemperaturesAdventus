<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTemperature extends Model
{
    protected $table = 'user_temperature';
    protected $fillable = ['user_id', 'city', 'celsius', 'fahrenheit'];
}
