<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = ['has_admin_link', "user_level"];



    public function groups(): BelongsToMany{
        return $this->belongsToMany(Group::class);
    }


    public function permissions(): BelongsToMany{
        return $this->belongsToMany(Permission::class);
    }

    public function player(): HasOne
    {
        return $this->hasOne(Player::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }



    public function allPermissions()
    {
        if($this->id===1){
            return Permission::pluck('key')->toArray();
        }

        $permmissions = [];
        $groups = $this->groups;
        foreach ($groups as $group) {
            $permmissions = array_merge($permmissions, $group->permissions->pluck('key')->toArray());
        }
        $permmissions = array_merge($permmissions, $this->permissions->pluck('key')->toArray());
        return array_unique($permmissions);
    }

    public function hasPermission($permission_key = ""): bool
    {
        if ($this->id === 1) return true;
        return in_array($permission_key, $this->allPermissions());
    } 


    protected function hasAdminLink(): Attribute
    {
        return new Attribute(
            get: fn () => (count($this->allPermissions()) > 0 || $this->id === 1) ? true : false,
        );
    }




    private function level(){
        if($this->player){
            return 2;
        }
        return 1;
    }
    protected function userLevel(): Attribute
    {
        return new Attribute(
            get: fn () => $this->level(),
        );
    }







}
