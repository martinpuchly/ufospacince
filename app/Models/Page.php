<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'slug', 'body', 'accessLevel', 'description', 'views', 'user_id'];

    const SHOW_OPTIONS = [
        0 => "všetci",
        1 => "prihlásení používateľia",
        2 => "iní hráči",
        3 => "nikto",
    ];

    protected $appends = ['humanize_update_date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function humanizeUpdateDate(): Attribute
    {
        return Attribute::make(
            get: fn () => date("j.n.Y" ,strtotime($this->updated_at))
        );
    }

}
