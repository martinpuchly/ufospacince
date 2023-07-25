<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class PlayerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $level = Auth::check() ? Auth::user()->userLevel : 0;
        return [
            'id' => $this->id,
            'name' =>  $this->name,
            'first_name' => $level >= $this->show_first_name ? $this->first_name : null,
            'last_name' => $level >= $this->show_last_name ? $this->last_name : null,
            'nickname' => $level >= $this->show_nickname ? $this->nickname  : null,
            'birth_date' => $level >= $this->show_birth_date && $this->birth_date ?  date("j.n.Y", strtotime($this->birth_date))  : null,
            'age' => $level >= $this->show_birth_date && $this->birth_date ? $this->age : null,
            'show_shirt_number' => $level >= $this->show_shirt_number ? $this->shirt_number : null,
            'photo' => $level >= $this->show_photo ? $this->full_photo_path : null,
            'about' => $level >= $this->show_about ? $this->about : null,
            'user' => $level >= $this->show_user && $this->user ? $this->user->name : null,
            'slug' => $this->slug,

        ];
    }

}
