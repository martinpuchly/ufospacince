<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Player extends Model
{
    use SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'nickname', 'birth_date', 'shirt_number', 'photo', 'about', 
                            'show_first_name', 'show_last_name', 'show_nickname', 'show_birth_date', 
                            'show_shirt_number', 'show_photo', 'show_about', 'show_user', 'user_id', 'show_player', 'slug', 'active'];
    protected $table = 'players';
    protected $appends = ['name'];



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


    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->setName()
        );
    }


    protected function setName(){
        $name = '';
        if($this->first_name) $name.=$this->first_name.' ';
        if($this->nickname) $name.=$this->nickname.' ';
        if($this->last_name) $name.=$this->last_name;
        return trim($name);
    }

    public function scopeShowable($query)
    {
        return $query->whereNotNull('first_name')->whereNotNull('show_first_name')
                        ->orWhereNull('last_name')->whereNotNull('show_nickname')
                        ->orWhereNull('first_name')->whereNotNull('show_last_name');
    }



}
