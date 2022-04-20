<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Superhero extends Model
{
    protected $fillable = [
        'id',
        'name',
        'fullname',
        'strength',
        'speed',
        'durability',
        'power',
        'combat',
        'race',
        'height_0',
        'height_1',
        'weight_0',
        'weight_1',
        'eyecolor',
        'haircolor',
        'publisher'
    ];
}
