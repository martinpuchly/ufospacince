<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Post extends Model
{
    use SoftDeletes;
    protected $table = 'posts';

    protected $fillable = ['title', 'slug', 'intro', 'body', 'tags', 'views', 'likes', 'published', 'published_at', 'keywords', 'description', 'user_id'];

    protected $appends = ['readable_published_date', 'humanize_published_date', 'tags_array'];

    protected $casts = [
        'published_at' => 'datetime:Y-m-d H:i',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }



    // ČITATEĽNÝ DÁTUM PUBLIKOVANIA
    protected function readablePublishedDate(): Attribute
    {
        return new Attribute(
            get: fn () => $this->published ? date("j.n.Y H:i", strtotime($this->published_at)) : "-",
        );
    }

    // ČITATEĽNÝ DÁTUM PUBLIKOVANIA
    protected function humanizePublishedDate(): Attribute
    {
        return new Attribute(
            get: fn () => $this->published ? $this->published_at->diffForHumans() : "-",
        );
    }

    // ČITATEĽNÝ DÁTUM PUBLIKOVANIA
    protected function tagsArray(): Attribute
    {
        return new Attribute(
            get: fn () => array_filter(array_map('trim', explode(',', $this->tags)), function($a){ return $a != '';}),
        );
    }


    public function scopePublish($query)
    {
        return $query->where('published', true)->where('published_at', '<', Date("Y-m-d H:i"));
    }





}
