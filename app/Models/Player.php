<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\Relation;

class Player extends Pivot
{
    

    protected $fillable = ['first_name', 'last_name', 'nickname', 'birst_date', 'shirt_number', 'photo', 'about', 
                            'show_first_name', 'show_last_name', 'show_nickname', 'show_birst_date', 
                            'show_shirt_number', 'show_photo', 'show_about', 'show_user', 'user_id', 'show_player', 'slug'];



    public function user(): Relation
    {
        return $this->belongsTo(User::class);
    }


}
