<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $primaryKey = 'slug';
    protected $keyType = 'string';
    protected $fillable = [
        'first_name', 'last_name', 'slug', 'nickname', 'shirt_number', 'photo', 'about',
        'sex', 'birth_date', 'team_id', 'user_id', 'show_profile', 'show_birth_date', 'show_photo', 'status', 'created_at', 'updated_at'
    ];

    protected $appends = ['full_name'];

    public const SEX = [
        1     => 'žena',
        2    => 'muž',
        3    => 'ešte som si to nerozmyslelo'
    ];
    public const PRIVACY_OPTIONS = [
        0     => 'nikto',
        1    => 'hráči',
        2    => 'prihlásení užívatelia',
        3    => 'všetci'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


    public function getImgPhotoAttribute()
    {
        if ($this->photo != null or file_exists($this->photo)) {
            return asset('storage/' . $this->photo);
        }
        return asset("storage/images/web/no_photo.png");
    }
}
