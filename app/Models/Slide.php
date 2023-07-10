<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Slide extends Model
{
    use HasFactory;


    protected $fillable = ['title', 'description', 'link', 'picture', 'position', 'active'];

    protected $appends = ['full_picture_path'];

    
    public function scopeActive(Builder $query): void
    {
        $query->where('active', 1);
    }



    protected function fullPicturePath(): Attribute
    {
        return new Attribute(
            get: fn () => asset('storage/slides/'.$this->picture),
        );
    }

    
}
