<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Training extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'place', 'description', 'date_time'];

    protected $casts = [
        'date_time' => 'datetime:Y-m-d H:i',
    ];

    protected $appends = ['nicer_date_time'];

    const TYPES = [
        1 => "bežný",
        2 => "herný",
        3 => "technický",
        4 => "kondičný",
        9 => "iný - uvedený v popise",
    ];

    const PLACES = [
        1 => "ihrisko Špačince",
        2 => "hala",
        9 => "iný - uvedený v popise",
    ];


    // ČITATEĽNÝ DÁTUM 
    protected function nicerDateTime(): Attribute
    {
        return new Attribute(
            get: fn () =>  $this->date_time->format("d.n.Y").' o '.$this->date_time->format("H:i").' hod.',
        );
    }


}
