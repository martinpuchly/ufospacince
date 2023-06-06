<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];
    public $timestamps = false;


    public function users(): BelongsToMany{
        return $this->belongsToMany(User::class);
    }

    public function permissions(): BelongsToMany{
        return $this->belongsToMany(Permission::class);
    }

}
