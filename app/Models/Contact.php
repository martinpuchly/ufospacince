<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Contact extends Model
{
    use HasFactory;


    protected $fillable = ['text', 'email', 'status'];
    protected $appends = ['human_create_date'];

    const STATUS = [
        1 => "neprečítané",
        2 => "nevyriešené",
        3 => "vyriešené",
        4 => "na vymazanie",
    ];


    protected function humanCreateDate(): Attribute
    {
        return new Attribute(
            get: fn () => date("j.n.Y H:m",strtotime($this->created_at)),
        );
    }


}
