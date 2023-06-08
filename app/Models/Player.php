<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Pivot
{
    use SoftDeletes;


    protected $fillable = ['first_name', 'last_name', 'nickname', 'birst_date', 'shirt_number', 'photo', 'about', 
                            'show_first_name', 'show_last_name', 'show_nickname', 'show_birst_date', 
                            'show_shirt_number', 'show_photo', 'show_about', 'show_user', 'user_id', 'show_player', 'slug', 'active'];
    protected $table = 'players';


    const SHOW_OPTIONS = [
        0 => "nikto",
        1 => "iný hráči",
        2 => "prihlásený používateľia",
        3 => "všetci",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
