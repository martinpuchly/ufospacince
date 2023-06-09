<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
=======
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
>>>>>>> 8d81def651ce0eec050579a1d9db074c59e25c82
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Player extends Model
{
    use SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'nickname', 'birth_date', 'shirt_number', 'photo', 'about', 
                            'show_first_name', 'show_last_name', 'show_nickname', 'show_birth_date', 
                            'show_shirt_number', 'show_photo', 'show_about', 'show_user', 'user_id', 'show_player', 'slug', 'active'];
    protected $table = 'players';


    const SHOW_OPTIONS = [
        0 => "nikto",
        1 => "iní hráči",
        2 => "prihlásení používatelia",
        3 => "všetci",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    

}
