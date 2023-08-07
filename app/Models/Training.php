<?php

namespace App\Models;

use Carbon\Carbon;
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

    protected $appends = ['nicer_date_time', 'value_type', 'value_place', 'passed'];

    const TYPES = [
        1 => "bežný tréning",
        2 => "herný tréning",
        3 => "technický tréning",
        4 => "kondičný tréning",
        9 => "iný typ tréningu",
    ];

    const PLACES = [
        1 => "ihrisko Špačince",
        2 => "hala",
        9 => "iné miesto tréningu",
    ];

    public function players(){
        return $this->belongsToMany(Player::class);
    }


    public function playersOn(){
        return $this->belongsToMany(Player::class)->showable()->wherePivot('p_status', 2);
    }
    public function playersOff(){
        return $this->belongsToMany(Player::class)->showable()->wherePivot('p_status', 1);
    }


    // ČITATEĽNÝ DÁTUM 
    protected function nicerDateTime(): Attribute
    {
        return new Attribute(
            get: fn () =>  $this->date_time->format("d.n.Y").' o '.$this->date_time->format("H:i").' hod.',
        );
    }

    protected function valueType(): Attribute
    {
        return new Attribute(
            get: fn () =>  SELF::TYPES[$this->type],
        );
    }

    protected function valuePlace(): Attribute
    {
        return new Attribute(
            get: fn () =>  SELF::PLACES[$this->place],
        );
    }

    protected function passed(): Attribute
    {
        return new Attribute(
            get: fn () =>  $this->date_time->lessThan(Carbon::now())
        );
    }


}
