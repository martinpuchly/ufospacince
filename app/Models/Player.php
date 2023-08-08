<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Player extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'nickname', 'birth_date', 'shirt_number', 'photo', 'about', 
                            'show_first_name', 'show_last_name', 'show_nickname', 'show_birth_date', 'show_age', 
                            'show_shirt_number', 'show_photo', 'show_about', 'show_user', 'user_id', 'show_player', 'slug', 'active'];
    protected $table = 'players';
    protected $appends = ['name', 'full_photo_path'];



    const SHOW_OPTIONS = [
        0 => "všetci",
        1 => "prihlásení používateľia",
        2 => "iní hráči",
        3 => "nikto",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function trainings(){
        return $this->belongsToMany(Training::class);
    }

    protected function name(): Attribute
    {
        $name = '';
        $level = Auth::check() ? Auth::user()->userLevel : 0;

        if($this->first_name && $level >= $this->show_first_name) $name.=$this->first_name.' ';
        if($this->nickname && $level >= $this->show_nickname) $name.=$this->nickname.' ';
        if($this->last_name && $level >= $this->show_last_name) $name.=$this->last_name;

        return new Attribute(
            get: fn () => trim($name),
        );
    }


    public function scopeShowable($query)
    {
        $level = Auth::check() ? Auth::user()->userLevel : 0;
        return $query->whereNotNull('first_name')->where('show_first_name', '<=', $level)
                        ->orWhereNotNull('last_name')->where('show_last_name', '<=', $level)
                        ->orWhereNotNull('nickname')->where('show_nickname', '<=', $level);
    }

    protected function fullPhotoPath(): Attribute
    {
        return new Attribute(
            get: fn () => $this->photo ? asset('storage/players/'.$this->photo) : null,
        );
    }

    protected function age(): Attribute
    {
        $diff = date_diff(date_create($this->birth_date), date_create(date("Y-m-d")));
        return new Attribute(
            get: fn () => $diff->format("%y"),
        );
    }


}
